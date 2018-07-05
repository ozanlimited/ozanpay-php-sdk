<?php

namespace Ozan;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Ozan\Common\OzanUserAgent;
use Ozan\Request\PaymentRequest;
use Ozan\Exceptions\OzanResponseException;
use Ozan\Exceptions\OzanSDKException;

class Ozan
{
    /**
     * @const string SDK name of the Ozan Pay PHP SDK.
     */
    const SDK_NAME = 'Ozan Pay PHP SDK';
    /**
     * @const string Version number of the Ozan Pay PHP SDK.
     */
    const SDK_VERSION = '1.0.0';
    /**
     * @const string The live base authorization URL.
     */
    const BASE_API_URL_LIVE = 'https://ozan.com/api/';
    /**
     * @const string The sandbox base authorization URL.
     */
    const BASE_API_URL_SANDBOX = 'https://sandbox.ozan.com/api/';
    /**
     * @const string The token url.
     */
    const TOKEN_URL = 'oauth/token?grant_type=client_credentials';
    /**
     * @const string The token url.
     */
    const PAYMENT_URL = 'payments';
    /**
     * @const int Unknown error code.
     */
    const UNKNOWN_ERROR_CODE = 1000;
    /**
     * @const string Unknown error description.
     */
    const UNKNOWN_ERROR_DESCRIPTION = 'Unknown error from Ozan API';

    /**
     * @var  string The api key provided by Ozan.
     */
    protected $apiKey;
    /**
     * @var  string The secret key provided by Ozan.
     */
    protected $secretKey;
    /**
     * @var bool Sandbox/Live mode.
     */
    protected $isLive = false;
    /**
     * @var Client The Ozan Guzzle client service.
     */
    protected $guzzleClient;

    /**
     * Instantiates a new Ozan super-class object.
     *
     * @param array $config
     *
     * @throws OzanSDKException
     */
    public function __construct(array $config = [])
    {
        if (!isset($config['api_key'])) {
            throw new OzanSDKException('Required "api_key" key not supplied in config and could not find fallback environment variable.');
        }
        if (!isset($config['secret_key'])) {
            throw new OzanSDKException('Required "secret_key" key not supplied in config and could not find fallback environment variable.');
        }
        if (!isset($config['is_live'])) {
            throw new OzanSDKException('Required "is_live" key not supplied in config and could not find fallback environment variable.');
        }
        $this->apiKey = $config['api_key'];
        $this->secretKey = $config['secret_key'];
        $this->isLive = $config['is_live'];
        $this->guzzleClient = new Client(['base_uri' => $this->isLive ? static::BASE_API_URL_LIVE : static::BASE_API_URL_SANDBOX]);
    }

    /**
     * Creates a payment.
     *
     * @param PaymentRequest $paymentRequest
     *
     * @return \OzanResponse
     *
     * @throws OzanResponseException
     * @throws OzanSDKException
     */
    public function createPayment($paymentRequest)
    {
        $accessToken = $this->getAccessToken();
        try {
            $response = $this->guzzleClient->post(static::PAYMENT_URL, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $accessToken,
                    'User-Agent' => OzanUserAgent::getValue(static::SDK_NAME, static::SDK_VERSION),
                    'Content-Type' => 'application/json'
                ],
                'json' => $paymentRequest->getJsonObject()
            ]);
            $paymentResponse = new OzanResponse($response->getBody(), $response->getStatusCode(), $response->getHeaders());
            return $paymentResponse;
        } catch (RequestException $e) {
            $response = $e->getResponse();
            throw OzanResponseException::create($response);
        } catch (\Exception $e) {
            return new OzanSDKException(static::UNKNOWN_ERROR_DESCRIPTION, static::UNKNOWN_ERROR_CODE);
        }
    }

    /**
     * Retrieves access token.
     *
     * @return string
     * @throws OzanSDKException
     * @throws OzanResponseException
     */
    private function getAccessToken()
    {
        $credentials = base64_encode($this->apiKey . ':' . $this->secretKey);
        try {
            $response = $this->guzzleClient->post(static::TOKEN_URL, [
                'headers' => [
                    'Authorization' => 'Basic ' . $credentials,
                    'User-Agent' => OzanUserAgent::getValue(static::SDK_NAME, static::SDK_VERSION)
                ]
            ]);
            $tokenResponse = new OzanResponse($response->getBody(), $response->getStatusCode(), $response->getHeaders());
            return $tokenResponse->getField('access_token');
        } catch (RequestException $e) {
            $response = $e->getResponse();
            throw OzanResponseException::create($response);
        } catch (\Exception $e) {
            return new OzanSDKException(static::UNKNOWN_ERROR_DESCRIPTION, static::UNKNOWN_ERROR_CODE);
        }
    }
}
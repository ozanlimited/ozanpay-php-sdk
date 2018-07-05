<?php

namespace Ozan;

use Ozan\Model\Mapper\PaymentMapper;
use Ozan\Model\Payment;


class OzanResponse
{
    /**
     * @var int The HTTP status code response from Ozan API.
     */
    protected $httpStatusCode;
    /**
     * @var array The headers returned from Ozan API.
     */
    protected $headers;
    /**
     * @var string The raw body of the response from Ozan API.
     */
    protected $body;
    /**
     * @var array The decoded body of the Ozan response.
     */
    protected $decodedBody = [];
    /**
     * @var array The response data body of the Ozan response.
     */
    protected $responseData = [];

    /**
     * Creates a new OzanResponse entity.
     *
     * @param string|null $body
     * @param int|null $httpStatusCode
     * @param array|null $headers
     */
    public function __construct($body = null, $httpStatusCode = null, array $headers = [])
    {
        $this->body = $body;
        $this->httpStatusCode = $httpStatusCode;
        $this->headers = $headers;
        $this->decodeBody();
        $this->responseData = $this->decodedBody['data'];
    }

    /**
     * Returns a value from the response data.
     *
     * @param string $field The property to retrieve.
     * @param mixed $default The default to return if the property doesn't exist.
     *
     * @return mixed
     */
    public function getField($field, $default = null)
    {
        if (isset($this->responseData[$field])) {
            return $this->responseData[$field];
        }
        return $default;
    }

    /**
     * Returns payment object.
     *
     * @return Payment
     */
    public function getPayment()
    {
        return PaymentMapper::create($this->body)->jsonDecode()->mapPayment(new Payment());
    }

    /**
     * Return the decoded body response.
     *
     * @return array
     */
    public function getDecodedBody()
    {
        return $this->decodedBody;
    }

    private function decodeBody()
    {
        $this->decodedBody = json_decode($this->body, true);
        if ($this->decodedBody === null) {
            $this->decodedBody = [];
            parse_str($this->body, $this->decodedBody);
        }

        if (!is_array($this->decodedBody)) {
            $this->decodedBody = [];
        }
    }
}
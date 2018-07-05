<?php

namespace Ozan\Exceptions;

use Psr\Http\Message\ResponseInterface;

class OzanResponseException extends OzanSDKException
{
    /**
     * @const int Unknown error code.
     */
    const UNKNOWN_ERROR_CODE = 1000;
    /**
     * @const string Unknown error description.
     */
    const UNKNOWN_ERROR_DESCRIPTION = 'Unknown error from Ozan API';
    /**
     * @var int Error code.
     */
    protected $errorCode;
    /**
     * @var string Error description.
     */
    protected $errorDescription;

    /**
     * Creates a OzanResponseException.
     *
     * @param int $errorCode The exception error code.
     * @param string $errorDescription The exception error description.
     */
    public function __construct($errorCode, $errorDescription)
    {
        $this->errorCode = $errorCode;
        $this->errorDescription = $errorDescription;
        parent::__construct($this->errorDescription, $this->errorCode);
    }


    /**
     * A factory for creating the appropriate exception based on the response from Ozan API.
     *
     * @param ResponseInterface $response The response that threw the exception.
     *
     * @return OzanResponseException
     */
    public static function create(ResponseInterface $response)
    {
        // TODO: We can throw different exception types
        $responseData = json_decode($response->getBody(), true);
        if ($responseData === null) {
            return new static(static::UNKNOWN_ERROR_CODE, static::UNKNOWN_ERROR_DESCRIPTION);
        }
        if (isset($responseData['error'])) {
            $errorCode = $responseData['error']['code'];
            $errorDescription = $responseData['error']['description'];
            return new static($errorCode, $errorDescription);
        }
        if (isset($responseData['data'])) {
            $errorDescription = $responseData['data']['message'];
            return new static(static::UNKNOWN_ERROR_CODE, $errorDescription);
        }
        return new static(static::UNKNOWN_ERROR_CODE, static::UNKNOWN_ERROR_DESCRIPTION);
    }

    /**
     * @return int
     */
    public function getErrorCode()
    {
        return $this->errorCode;
    }

    /**
     * @return string
     */
    public function getErrorDescription()
    {
        return $this->errorDescription;
    }
}
<?php

namespace Ozan\Request;

use Ozan\JsonBuilder;
use Ozan\OzanRequest;

class PaymentRequest extends OzanRequest
{

    /**
     * @var string $checkoutToken Checkout token provided by Ozan Pay JS SDK
     */
    private $checkoutToken;

    /**
     * @var double $amount Basket amount
     */
    private $amount;

    /**
     * @var string $currency 3-letter ISO-4217 Currency Code
     */
    private $currency;
    /**
     * @var string $reference Merchant reference number
     */
    private $reference;

    /**
     * @return string
     */
    public function getCheckoutToken()
    {
        return $this->checkoutToken;
    }

    /**
     * @param string $checkoutToken
     */
    public function setCheckoutToken($checkoutToken)
    {
        $this->checkoutToken = $checkoutToken;
    }

    /**
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    /**
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @param string $reference
     */
    public function setReference($reference)
    {
        $this->reference = $reference;
    }

    /**
     * PaymentRequest constructor.
     */
    public function __construct()
    {
    }

    public function getJsonObject()
    {
        return JsonBuilder::fromJsonObject(parent::getJsonObject())
            ->add("checkoutToken", $this->getCheckoutToken())
            ->add("reference", $this->getReference())
            ->addArray("amount", ["value" => $this->getAmount(), "currency" => $this->getCurrency()])
            ->getObject();
    }
}
<?php

namespace Ozan\Model;

class Payment
{

    /**
     * @var string $paymentId The entity id of the payment.
     */
    private $paymentId;
    /**
     * @var string $transactionId The unique identifier of the transaction.
     */
    private $transactionId;
    /**
     * @var string $instructionType The type of the instruction [PAYMENT].
     */
    private $instructionType;
    /**
     * @var string $status The status of the payment [COMPLETED, FAILED].
     */
    private $status;
    /**
     * @var double $amount The amount of the payment.
     */
    private $amount;
    /**
     * @var string $currency The currency of the payment amount.
     */
    private $currency;
    /**
     * @var string $reference The reference number provided by the merchant.
     */
    private $reference;
    /**
     * @var string $merchantId The entity id of the merchant.
     */
    private $merchantId;
    /**
     * @var string $checkoutToken The token of the payment transaction.
     */
    private $checkoutToken;
    /**
     * @var string $customerMobile The mobile number of the customer.
     */
    private $customerMobile;

    /**
     * @return string
     */
    public function getPaymentId()
    {
        return $this->paymentId;
    }

    /**
     * @param string $paymentId
     */
    public function setPaymentId($paymentId)
    {
        $this->paymentId = $paymentId;
    }

    /**
     * @return string
     */
    public function getTransactionId()
    {
        return $this->transactionId;
    }

    /**
     * @param string $transactionId
     */
    public function setTransactionId($transactionId)
    {
        $this->transactionId = $transactionId;
    }

    /**
     * @return string
     */
    public function getInstructionType()
    {
        return $this->instructionType;
    }

    /**
     * @param string $instructionType
     */
    public function setInstructionType($instructionType)
    {
        $this->instructionType = $instructionType;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
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
     * @return string
     */
    public function getMerchantId()
    {
        return $this->merchantId;
    }

    /**
     * @param string $merchantId
     */
    public function setMerchantId($merchantId)
    {
        $this->merchantId = $merchantId;
    }

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
     * @return string
     */
    public function getCustomerMobile()
    {
        return $this->customerMobile;
    }

    /**
     * @param string $customerMobile
     */
    public function setCustomerMobile($customerMobile)
    {
        $this->customerMobile = $customerMobile;
    }
}
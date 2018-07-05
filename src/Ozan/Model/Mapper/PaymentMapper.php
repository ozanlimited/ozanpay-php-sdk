<?php

namespace Ozan\Model\Mapper;

use Ozan\JsonBuilder;
use Ozan\Model\Payment;

class PaymentMapper
{

    protected $rawResult;
    protected $jsonObject;

    public function __construct($rawResult)
    {
        $this->rawResult = $rawResult;
    }

    public static function create($rawResult = null)
    {
        return new PaymentMapper($rawResult);
    }

    public function mapPaymentFrom(Payment $payment, $jsonObject)
    {
        if (isset($jsonObject->data->id)) {
            $payment->setPaymentId($jsonObject->data->id);
        }
        if (isset($jsonObject->data->transactionId)) {
            $payment->setTransactionId($jsonObject->data->transactionId);
        }
        if (isset($jsonObject->data->instructionType)) {
            $payment->setInstructionType($jsonObject->data->instructionType);
        }
        if (isset($jsonObject->data->status)) {
            $payment->setStatus($jsonObject->data->status);
        }
        if (isset($jsonObject->data->amount)) {
            $payment->setAmount($jsonObject->data->amount->value);
            $payment->setCurrency($jsonObject->data->amount->currency);
        }
        if (isset($jsonObject->data->reference)) {
            $payment->setReference($jsonObject->data->reference);
        }
        if (isset($jsonObject->data->merchantId)) {
            $payment->setMerchantId($jsonObject->data->merchantId);
        }
        if (isset($jsonObject->data->customerIdentifier)) {
            $payment->setCustomerMobile($jsonObject->data->customerIdentifier->fullNumber);
        }
        if (isset($jsonObject->data->checkoutToken)) {
            $payment->setCheckoutToken($jsonObject->data->checkoutToken);
        }
        return $payment;
    }

    public function mapPayment(Payment $payment)
    {
        return $this->mapPaymentFrom($payment, $this->jsonObject);
    }

    public function jsonDecode()
    {
        $this->jsonObject = JsonBuilder::jsonDecode($this->rawResult);
        return $this;
    }
}
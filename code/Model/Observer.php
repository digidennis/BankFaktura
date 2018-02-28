<?php

class Digidennis_BankFaktura_Model_Observer
{

    public function onPaymentPlaceEnd($observer)
    {
        $payment = $observer->getPayment();
        $predata = $payment->getAdditionalInformation();
        $data = Mage::helper('digidennis_bankfaktura')->getConfigedData();
        $payment->setAdditionalInformation(array_merge($data,$predata));
        $payment->save();
    }

}
<?php
class Digidennis_BankFaktura_Model_Bank extends Mage_Payment_Model_Method_Abstract
{
    protected $_code = 'digidennis_bankfaktura';
    protected $_formBlockType = 'digidennis_bankfaktura/payment_form';
    protected $_infoBlockType = 'digidennis_bankfaktura/info_info';

    protected $_canCapture              = true;
    protected $_canRefund               = true;
    protected $_canUseCheckout          = false;
    protected $_canRefundInvoicePartial = true;
    protected $_canUseForMultishipping  = false;


    public function getCheckout()
    {
        return Mage::getSingleton('checkout/session');
    }

    public function getQuote()
    {
        return $this->getCheckout()->getQuote();
    }

    /**
     * Capture payment abstract method
     *
     * @param Varien_Object $payment
     * @param float $amount
     *
     * @return Mage_Payment_Model_Abstract
     */
    public function capture(Varien_Object $payment, $amount)
    {
        if (!$this->canCapture()) {
            Mage::throwException(Mage::helper('payment')->__('Capture action is not available.'));
        }

        return $this;
    }
}

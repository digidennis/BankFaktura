<?php
class Digidennis_BankFaktura_Block_Info_Info extends Mage_Payment_Block_Info
{
    protected $_invoice;
    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('digidennis/bankfaktura/info/info.phtml');
    }

    public function getInvoice()
    {
        if($this->_invoice)
            return $this->_invoice;

        if( key_exists('invoice_id', $this->getRequest()->getParams()) )
        {
            $this->_invoice = Mage::getModel('sales/order_invoice')->load($this->getRequest()->getParams()['invoice_id']);
            return $this->_invoice;
        }
        return false;
    }

    public function getForfald($numdays)
    {
        if( !$this->getInvoice() )
            return;
        $date = new Zend_Date($this->getInvoice()->getCreatedAt());
        $date->add($numdays,Zend_Date::DAY);
        return Mage::helper('core')->formatDate($date, 'long', false);

    }

    protected function _prepareSpecificInformation($transport = null)
    {
        if (null !== $this->_paymentSpecificInformation)
            return $this->_paymentSpecificInformation;

        $data = array();
        $_terms = Mage::getStoreConfig('payment/digidennis_bankfaktura/termstext', Mage::app()->getStore()->getStoreId() );
        $_forfald = Mage::getStoreConfig('payment/digidennis_bankfaktura/forfald', Mage::app()->getStore()->getStoreId() );
        $_regnr = Mage::getStoreConfig('payment/digidennis_bankfaktura/regnr', Mage::app()->getStore()->getStoreId() );
        $_konto = Mage::getStoreConfig('payment/digidennis_bankfaktura/kontonr', Mage::app()->getStore()->getStoreId() );
        $_bank = Mage::getStoreConfig('payment/digidennis_bankfaktura/bank', Mage::app()->getStore()->getStoreId() );

        if (!is_null($_terms)){
            $data[$this->__('Betalingsbetingelser')] = $_terms;
        }
        if (!is_null($_forfald)){
            $data[$this->__('Forfaldsdato')] =  $this->getForfald($_forfald);
        }
        if (!is_null($_bank)){
            $data[$this->__('Bank')] = $_bank;
        }
        if (!is_null($_regnr)){
            $data[$this->__('Reg.nr')] = $_regnr;
        }
        if (!is_null($_konto)){
            $data[$this->__('Konto')] = $_konto;
        }

        $transport = new Varien_Object($data);
        return $transport;
    }

}

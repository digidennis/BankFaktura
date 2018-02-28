<?php
class Digidennis_BankFaktura_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * @param Mage_Sales_Model_Order_Invoice $invoice
     * @return Zend_Date
     * @throws Mage_Core_Model_Store_Exception
     * @throws Zend_Date_Exception
     */
    public function getMaturityDate($createdate)
    {
        $configMaturity = Mage::getStoreConfig(
            'payment/digidennis_bankfaktura/forfald',
            Mage::app()->getStore()->getStoreId()
        );
        $createdAt =  new Zend_Date($createdate);
        if( is_numeric($configMaturity) ){
            $createdAt->add($configMaturity, Zend_Date::DAY);
        }
        return $createdAt;
    }

    public function getConfigedData()
    {
        $data = array();
        $data['terms'] = Mage::getStoreConfig('payment/digidennis_bankfaktura/termstext', Mage::app()->getStore()->getStoreId() );
        $data['bankid'] = Mage::getStoreConfig('payment/digidennis_bankfaktura/regnr', Mage::app()->getStore()->getStoreId() );
        $data['accountid'] = Mage::getStoreConfig('payment/digidennis_bankfaktura/kontonr', Mage::app()->getStore()->getStoreId() );
        $data['bankname'] = Mage::getStoreConfig('payment/digidennis_bankfaktura/bank', Mage::app()->getStore()->getStoreId() );
        $data['maturitydate'] = Mage::helper('core')->formatDate($this->getMaturityDate(now()), 'long');
        return $data;
    }
}

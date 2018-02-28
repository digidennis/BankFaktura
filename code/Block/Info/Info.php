<?php
class Digidennis_BankFaktura_Block_Info_Info extends Mage_Payment_Block_Info
{
    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('digidennis/bankfaktura/info/info.phtml');
    }

    public function getAdditionalInformation()
    {
        $data = array();
        $info = $this->getInfo();

        $data['terms'] =  $info->getAdditionalInformation('terms');
        $data['maturitydate'] =  $info->getAdditionalInformation('maturitydate');
        $data['bankname'] = $info->getAdditionalInformation('bankname');
        $data['bankid'] = $info->getAdditionalInformation('bankid');
        $data['accountid'] = $info->getAdditionalInformation('accountid');

        return $data;
    }

    protected function _prepareSpecificInformation($transport = null)
    {
        if (null !== $this->_paymentSpecificInformation )
            return $this->_paymentSpecificInformation;

        $data = array();
        $info = $this->getInfo();

        $data[$this->__('Betalingsbetingelser')] =  $info->getAdditionalInformation('terms');
        $data[$this->__('Forfaldsdato')] =  $info->getAdditionalInformation('maturitydate');
        $data[$this->__('Bank')] = $info->getAdditionalInformation('bankname');
        $data[$this->__('Reg.nr')] = $info->getAdditionalInformation('bankid');
        $data[$this->__('Konto')] = $info->getAdditionalInformation('accountid');;

        $transport = new Varien_Object($data);
        return $transport;
    }
}

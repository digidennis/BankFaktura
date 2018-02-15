<?php
class Digidennis_BankFaktura_Block_Info_Info extends Mage_Payment_Block_Info
{
    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('digidennis/bankfaktura/info/info.phtml');
    }

}

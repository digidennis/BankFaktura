<?php
class Digidennis_BankFaktura_Block_Payment_Form extends Mage_Payment_Block_Form
{

    protected function _construct()
    {
        $this->setTemplate('digidennis/bankfaktura/payment/form.phtml');
        parent::_construct();
    }

}

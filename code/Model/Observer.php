<?php

class Digidennis_BankFaktura_Model_Observer
{

    public function completeOrderAction($observer)
    {
        $block = $observer->getEvent()->getBlock();
        $order = Mage::registry('current_order');

        if ($order &&
            $order->getPayment()->getMethodInstance()->getCode() == 'digidennis_bankfaktura' &&
            $block instanceof Mage_Adminhtml_Block_Sales_Order_View
        ) {
            $message = Mage::helper('sales')->__('Are you sure you want to Change Status?');
            $block->addButton('digidennis_bankfaktura',
                array( 'label' => Mage::helper('sales')->__('Complete'),
                    'onclick' => "confirmSetLocation('{$message}', '{$block->getUrl('bankfaktura/adminhtml_index/complete')}')", 'class' => 'go' ));
        }
    }
}
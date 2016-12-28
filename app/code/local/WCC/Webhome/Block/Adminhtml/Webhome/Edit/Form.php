<?php

/**
 * Created by PhpStorm.
 * User: liuguijia
 * Date: 15/11/5
 * Time: 下午1:50
 */

class WCC_Webhome_Block_Adminhtml_Webhome_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('webhome_form');
        $this->setTitle($this->__('Webhome data'));
    }

    protected function _prepareForm()
    {
        $data = Mage::registry('webhome')->getData();
        $form = new Varien_Data_Form(array(
            'id'        => 'edit_form',
            'action'    => '',
            'method'    => 'post',
            'enctype' => 'multipart/form-data'
        ));

        $fieldset = $form->addFieldset('webhome_manager1', array(
            'legend'    => Mage::helper('webhome')->__('Order Information'),
            'class'     => 'fieldset-wide',
        ));
        $fieldset->addField('reserved_order_id', 'text', array(
            'label'     => Mage::helper('webhome')->__('Order #'),
            'name'      => 'reserved_order_id',
        ));
        $fieldset->addField('created_at', 'text', array(
            'label'     => Mage::helper('webhome')->__('Order Date'),
            'name'      => 'created_at',
        ));
        $fieldset->addField('remote_ip', 'text', array(
            'label'     => Mage::helper('webhome')->__('Placed from IP'),
            'name'      => 'remote_ip',
        ));


        $fieldset = $form->addFieldset('webhome_manager2', array(
            'legend'    => Mage::helper('webhome')->__('Account Information'),
            'class'     => 'fieldset-wide',
        ));
        $fieldset->addField('customer_firstname', 'text', array(
            'label'     => Mage::helper('webhome')->__('customer firstname'),
            'name'      => 'customer_firstname',
        ));
        $fieldset->addField('customer_middlename', 'text', array(
            'label'     => Mage::helper('webhome')->__('customer middlename'),
            'name'      => 'customer_middlename',
        ));
        $fieldset->addField('customer_lastname', 'text', array(
            'label'     => Mage::helper('webhome')->__('customer lastname'),
            'name'      => 'customer_lastname',
        ));
        $fieldset->addField('customer_email', 'text', array(
            'label'     => Mage::helper('webhome')->__('Email'),
            'name'      => 'customer_email',
        ));

        $fieldset = $form->addFieldset('webhome_manager3', array(
            'legend'    => Mage::helper('webhome')->__('Billing Address'),
            'class'     => 'fieldset-wide',
        ));
        $fieldset->addField('billing_address', 'textarea', array(
            'label'     => Mage::helper('webhome')->__('billing address'),
            'name'      => 'billing_address',
        ));

        $fieldset = $form->addFieldset('webhome_manager4', array(
            'legend'    => Mage::helper('webhome')->__('Shipping Address'),
            'class'     => 'fieldset-wide',
        ));
        $fieldset->addField('shipping_address', 'textarea', array(
            'label'     => Mage::helper('webhome')->__('shipping address'),
            'name'      => 'shipping_address',
        ));

        $fieldset = $form->addFieldset('webhome_manager5', array(
            'legend'    => Mage::helper('webhome')->__('Payment Information'),
            'class'     => 'fieldset-wide',
        ));
        $fieldset->addField('payment', 'text', array(
            'label'     => Mage::helper('webhome')->__('payment method'),
            'name'      => 'payment',
        ));
        $fieldset->addField('quote_currency_code', 'text', array(
            'label'     => Mage::helper('webhome')->__('currency'),
            'name'      => 'quote_currency_code',
        ));

        $fieldset = $form->addFieldset('webhome_manager7', array(
            'legend'    => Mage::helper('webhome')->__('Items Ordered'),
            'class'     => 'fieldset-wide',
        ));
        for($i=0;$i<$data['items_count'];$i++){
            $fieldset->addField('items'.$i, 'textarea', array(
                'label'     => Mage::helper('webhome')->__('Item'),
                'name'      => 'items'.$i,
            ));
        }

        $fieldset = $form->addFieldset('webhome_manager8', array(
            'legend'    => Mage::helper('webhome')->__('Order Totals'),
            'class'     => 'fieldset-wide',
        ));
        $fieldset->addField('subtotal', 'text', array(
            'label'     => Mage::helper('webhome')->__('Subtotal'),
            'name'      => 'subtotal',
        ));

        $form->setValues($data);
        $form->setUseContainer(true);
        $this->setForm($form);
        return parent::_prepareForm();
    }
}
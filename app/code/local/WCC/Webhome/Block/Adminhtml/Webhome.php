<?php

/**
 * Created by PhpStorm.
 * User: liuguijia
 * Date: 15/11/5
 * Time: 下午1:36
 */

class WCC_Webhome_Block_Adminhtml_Webhome extends Mage_Adminhtml_Block_Widget_Grid_Container
{

    public function __construct()
    {
        $this->_blockGroup = 'webhome';
        $this->_controller = 'adminhtml_webhome';
        $this->_headerText = $this->__('未支付订单');
        parent::__construct();
        $this->_removeButton('add');
    }

}
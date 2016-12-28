<?php

/**
 * Created by PhpStorm.
 * User: liuguijia
 * Date: 15/11/5
 * Time: 下午1:41
 */

class WCC_Webhome_Block_Adminhtml_Webhome_Edit  extends Mage_Adminhtml_Block_Widget_Form_Container
{
    /**
     * Init class
     */

    public function __construct()
    {
        $this->_blockGroup = 'webhome';
        $this->_controller = 'adminhtml_webhome';
        parent::__construct();
        $this->removeButton('back');
        $this->removeButton('reset');
        $this->removeButton('delete');
        $this->removeButton('save');
    }

    /**
     * Get Header text
     *
     * @return string
     */
    public function getHeaderText()
    {
        return $this->__('详情');
    }

}
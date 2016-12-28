<?php

/**
 * Created by PhpStorm.
 * User: liuguijia
 * Date: 16/3/16
 * Time: 上午11:25
 */
class WCC_Webhome_Model_Resource_Webhome_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{

    public function _construct()
    {
        $this->_init('webhome/webhome');
    }


}
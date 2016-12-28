<?php
class WCC_Webhome_Model_Resource_Webhome extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct(){
        $this->_init('webhome/webhome', 'id');
    }
}
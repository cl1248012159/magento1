<?php

/**
 * Created by PhpStorm.
 * User: liuguijia
 * Date: 16/6/29
 * Time: 下午4:13
 */
class WCC_Webhome_Block_Adminhtml_Renderer_Image extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract

{

    public function render(Varien_Object $row)
    {
        $imageUrl = $this->getMediaUrl(
                $row->getData($this->getColumn()->getIndex())
            );

        $html = '<img ';
        $html .= 'src="' . $imageUrl . '" ';
        $html .= 'height="50px" ';
        $html .= 'class="grid-image ' . $this->getColumn()->getInlineCss() . '"/>';
        return $html;
    }

    public function getMediaUrl($file)
    {
        $file = $this->_prepareFileForUrl($file);

        if(substr($file, 0, 1) == '/') {
            return $this->getBaseMediaUrl() . $file;
        }

        return $this->getBaseMediaUrl() . '/' . $file;
    }

    protected function _prepareFileForUrl($file)
    {
        return str_replace(DS, '/', $file);
    }

    public function getBaseMediaUrl()
    {
        return Mage::getBaseUrl('media') . 'homeV2';
    }

}
<?php

/**
 * Created by PhpStorm.
 * User: liuguijia
 * Date: 15/11/5
 * Time: 下午1:24
 */

class WCC_Webhome_Adminhtml_WebhomeController extends Mage_Adminhtml_Controller_Action
{

    protected function _initAction()
    {
        return $this;
    }

    protected function _isAllowed(){
        return Mage::getSingleton('admin/session')->isAllowed('webhome/webhome');
    }

    public function indexAction(){
        $this->_initAction()
            ->loadLayout()
            ->renderLayout();
    }

    public function editAction(){
        $this->_initAction();
        $this->loadLayout();
        $id = (int) $this->getRequest()->getParam('id');

        $model = Mage::getModel('webhome/webhome')->load($id,'entity_id');
        if(!$model->getEntityId()) {
            $this->_getSession()->addError($this->__('This order no longer exists.'));
            $this->_redirect('*/*/');
            $this->setFlag('', self::FLAG_NO_DISPATCH, true);
            return false;
        }
        $quotedata = $model->getData();


        //address
        $address = Mage::getModel('sales/quote_address')->getCollection()
            ->addFieldToFilter('quote_id',$id);
        foreach($address as $ads){
            $adstreet_str = '';
            foreach($ads->getStreet() as $adstreet){
                $adstreet_str .= $adstreet.' ';
            }
            $address_str = $ads->getFirstname().' '.$ads->getMiddlename().' '.$ads->getLastname() . "\r\n".
                $ads->getCompany(). "\r\n".
                $adstreet_str. "\r\n".
                $ads->getCity(). 'City, '.$ads->getRegion().', '.$ads->getPostcode() . "\r\n".
                $ads->getCountryId(). "\r\n".
                'T:'. $ads->getTelephone(). "\r\n".
                'F:'. $ads->getFax(). "\r\n";
            switch($ads->getAddressType()){
                case 'billing':
                    $quotedata['billing_address'] = $address_str;
                    break;
                case 'shipping':
                    $quotedata['shipping_address'] = $address_str;
                    break;
                default:break;
            }
        }

        //payment
        $quotedata['payment'] = Mage::getModel('sales/quote_payment')->load($id,'quote_id')->getMethod();

        //items

        $items =  Mage::getModel('sales/quote_item')->getCollection()
                ->addFieldToFilter('quote_id',$id);

        //$quotedata['items'] = array();
        $i=0;
        foreach($items as $item){
            $info_buyrequest = unserialize(Mage::getModel('sales/quote_item_option')->getCollection()
                ->addFieldToFilter('item_id',$item->getItemId())
                ->addFieldToFilter('code','info_buyRequest')
                ->getFirstItem()
                ->getValue());
            $read= Mage::getSingleton('core/resource')->getConnection('core_read');
            $options = '';
            foreach($info_buyrequest['options'] as $opk=>$option){
                $results = $read->fetchAll("select cpo.option_id,cpo.product_id,cpo.type,cpot.title from  catalog_product_option as cpo
                                            left join catalog_product_option_title as cpot on cpo.`option_id`=cpot.`option_id`
                                            where cpo.`option_id`='".$opk."'");
                if($option){
                    foreach ($results as $row) {
                        switch($row['type']){
                            case 'field':
                                $options .= '----'.$row['title'].' : '.$option . "\r\n";
                                break;
                            case 'drop_down':
                                $value_results = $read->fetchAll("select sku from catalog_product_option_type_value where `option_type_id`='".$option."' and `option_id`='".$opk."'");
                                foreach($value_results as $vr){
                                    $options .= '----'.$row['title'].' : '.$vr['sku'] . "\r\n";
                                }
                                break;
                            default:
                                break;
                        }
                    }
                }
            }

            $quotedata['items'.$i] = 'Product Name : '.$item->getName() . "\r\n".
                                    'Sku : '.         $item->getSku()  . "\r\n".
                                    $options .
                                    'Price : '.$item->getPrice(). "\r\n".
                                    'Qty : '.$item->getQty(). "\r\n".
                                    'Total : ' . $item->getRowTotal() . "\r\n". "\r\n";
            $i++;
        }

        $model->setData($quotedata);

        Mage::register('webhome', $model);
        Mage::register('current_webhome', $model);
        $data = Mage::getSingleton('adminhtml/session')->getMessageData(true);
        if($data){
            $model->setData($data);
            Mage::register('current_webhome', $model);
        }
        $this->_title(sprintf("#%s", $model->getReservedOrderId()));
        $this->_setActiveMenu('webhome/webhome');
        $this->renderLayout();
    }


}
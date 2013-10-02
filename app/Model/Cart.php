<?php
App::uses('AppModel', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class Cart extends AppModel
{
    public $actsAs = array('Containable');

    public $belongsTo = array('Product');

    function isProductExist($pid, $uid)
    {
        $data = $this->find('first', array('conditions' => array('Cart.product_id' => $pid, 'Cart.user_id' => $uid)));
        if ($data) {
            return array('status' => true, 'cart_id' => $data['Cart']['id']);
        } else {
            return array('status' => false);
        }
    }

    function isCartEmpty($uid)
    {
        $data = $this->find('first', array('conditions' => array('Cart.user_id' => $uid)));
        if ($data) {
            return true;
        } else {
            return false;
        }
    }


    function addToCart($pid, $qty, $uid)
    {
        $result = $this->isProductExist($pid, $uid);
        if ($result['status']) {
            $this->updateCart($result['cart_id'], $qty);
        } else {
            $this->data['Cart']['product_id'] = $pid;
            $this->data['Cart']['qty'] = $qty;
            $this->data['Cart']['user_id'] = $uid;
            $this->save($this->data);
        }
    }

    function updateCart($cid, $qty)
    {
        $this->data['Cart']['id'] = $cid;
        $this->data['Cart']['qty'] = $qty;
        $this->save($this->data);
    }

    function deleteProduct($cid = null)
    {
        if ($cid) {
            $this->delete($cid);
        }
    }

    function cleanUp()
    {
        $twoDaysAgo = date('Y-m-d H:i:s', mktime(0, 0, 0, date('m'), date('d') - 2, date('Y')));
        $delete_condition = "Cart.modified < '" . $twoDaysAgo . "'";
        $this->deleteAll($delete_condition);
    }

    function getCart($uid){
        $this->recursive = 2;
        $data = $this->find('all',array('conditions'=>array('Cart.user_id'=>$uid)));
        return $data;
    }
}

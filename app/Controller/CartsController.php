<?php
/**
 * Cart Operation controller.
 *
 * This file will render views from views/carts/
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class CartsController extends AppController
{

    public $uses = array();

    public function addToCart($matnr, $qty, $loc)
    {
        $this->checkFrontUserSession();
        $this->layout = false;
        $this->loadModel('Product');
        $product = $this->Product->find('first', array('conditions' => array('Product.matnr' => $matnr), 'contain' => false));
        if ($product) {
            $this->Cart->addToCart($product['Product']['id'], $qty, $loc, $this->Session->read('uid'));
            echo json_encode(array('status' => true, 'msg' => 'Product has been added successfully'));
            exit;
        } else {
            echo json_encode(array('status' => false, 'msg' => 'Product can not be added at the moment. Please try again.'));
            exit;
        }
    }


    public function view()
    {
        $this->checkFrontUserSession();
        $this->set('data', $this->Cart->getCart($this->Session->read('uid')));
    }

    public function update()
    {
        $this->checkFrontUserSession();
        $this->Cart->updateCart($this->request->data['Cart']['id'], $this->request->data['Cart']['qty']);
        $this->Session->setFlash("Cart has been updated successfully", 'default', array(), 'success');
        $this->redirect(array('controller' => 'carts', 'action' => 'view'));
    }


    public function deleteProduct($cid)
    {
        $this->checkFrontUserSession();
        $this->Cart->deleteProduct($cid);
        $this->Session->setFlash("Cart has been updated successfully", 'default', array(), 'success');
        $this->redirect(array('controller' => 'carts', 'action' => 'view'));
    }


    public function address()
    {
        $this->checkFrontUserSession();
        if ($this->Cart->isCartEmpty($this->Session->read('uid'))) {
            $this->Session->setFlash("You have empty cart", 'default', array(), 'failure');
            $this->redirect(array('controller' => 'carts', 'action' => 'view'));
            exit();
        } else {
            $this->loadModel('User');
            $billing = $this->User->find('first', array('conditions' => array('User.id' => $this->Session->read('uid')), 'contain' => array('Customer' => array('Country', 'State'))));
            $this->loadModel('Address');
            $shippingAddressList = $this->Address->find('list', array('fields' => array('Address.id', 'Address.address_list')));
            //pr($billing);
            $this->set('billing', $billing);
            $this->set('shippingAddressList', $shippingAddressList);

            App::import('model', 'Location');
            $country = new Location();
            $countries = $country->find('list', array('fields' => array('land1', 'landx')));
            $this->set('countries', $countries);
        }
    }

    public function orderReview()
    {
        $this->checkFrontUserSession();
        $this->Session->write('ship_id', 2);
        if ($this->Cart->isCartEmpty($this->Session->read('uid'))) {
            $this->Session->setFlash("You have empty cart", 'default', array(), 'failure');
            $this->redirect(array('controller' => 'carts', 'action' => 'view'));
            exit();
        } elseif (!$this->Session->read('ship_id')) {
            $this->Session->setFlash("Please select shipping address for you order", 'default', array(), 'failure');
            $this->redirect(array('controller' => 'carts', 'action' => 'address'));
            exit();
        } else {
            //Setting up billing and shipping address
            $this->loadModel('User');
            $billing = $this->User->find('first', array('conditions' => array('User.id' => $this->Session->read('uid')), 'contain' => array('Customer' => array('Country', 'State'))));
            $this->loadModel('Address');
            $shipping = $this->Address->find('first', array('conditions' => array('Address.id' => $this->Session->read('ship_id'))));
            $this->set('billing', $billing);
            $this->set('shipping', $shipping);

            // Finding tax for shipping postal code or setting it to 0
            $this->loadModel('Tax');
            $taxes = $this->Tax->find('first', array('conditions' => array('Tax.pstlz' => $shipping['Address']['postl_cod1'])));
            if ($taxes) {
                $this->set('tax', $taxes['Tax']['kbetr_st']);
            } else {
                $this->set('tax', 0);
            }

            //Get cart content
            $cart = $this->Cart->getCart($this->Session->read('uid'));
            $this->set('cart', $cart);

            // Setting postal code of plant and shipping to calculate shipping.
            $this->loadModel('Plant');
            $origin = $this->Plant->find('first', array('conditions' => array('Plant.id' => $cart[0]['Cart']['ship_location'])));
            $this->set('origin', $origin['Plant']['pstlz']);
            $this->set('destination', $shipping['Address']['postl_cod1']);
        }
    }
}

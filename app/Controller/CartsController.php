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


    //Commented by Developer Starts
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

            $this->set('states', array());

            if ($this->request->data) {
                $this->request->data['Address']['user_id'] = $this->Session->read('uid');
                $this->request->data['Address']['kunnr'] = $this->Session->read('kunnr');
                if ($this->Address->save($this->request->data)) {
                    $this->Session->setFlash('Address has been saved successfully.', 'default', array(),
                        'success');
                    $this->redirect(array('controller' => 'users', 'action' => 'addressBook'));
                } else {
                    $this->Session->setFlash('Address can not be saved. Please try again.', 'default', array(),
                        'failure');
                }
            }
        }
    }

    public function getAddress($id = null)
    {
        $this->checkFrontUserSession();
        $this->loadModel('Address');

        $this->layout = null;

        App::import('model', 'Location');
        $country = new Location();
        $countries = $country->find('list', array('fields' => array('land1', 'landx')));
        $cnt = '';
        $cnt .= "<option value=\"\">--Select Country--</option>";
        foreach ($countries as $key => $value) {
            $cnt .= "<option value=\"$key\">" . $value . "</option>";
        }
        if ($id != null) {
            $data = $this->Address->read('', $id);
            if ($data) {
                $states = $country->find('list', array('conditions' => array('Location.bland' => $data['Address']['bland']),
                    'fields' => array('bland', 'bezei')));
                $a = '';
                $a .= "<option value=\"\">--Select State--</option>";
                foreach ($states as $key => $value) {
                    $a .= "<option value=\"$key\">" . $value . "</option>";
                }

                $passData = array();
                $passData['listCountries'] = $cnt;
                $passData['listStates'] = $a;

                $ptn = "/_[a-z]?/";
                foreach ($data['Address'] as $sdKey => $singleData) {
                    $result = $this->underscore2Camelcase($sdKey);
                    $passData['Address' . $result] = $singleData;
                }
                //pr($passData); die;
                echo json_encode($passData);
            }
        }
        die;
    }

    function underscore2Camelcase($str)
    {
        // Split string in words.
        $words = explode('_', strtolower($str));

        $return = '';
        foreach ($words as $word) {
            $return .= ucfirst(trim($word));
        }

        return $return;
    }

    //Commented by Developer Ends

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
            $billing = $this->User->find('first', array('conditions' => array('User.id' => $this->Session->read('uid')
            ), 'contain' => array('Customer' => array('Country', 'State'))));
            $this->loadModel('Address');
            $shipping = $this->Address->find('first', array('conditions' => array('Address.id' => $this->Session->read('ship_id'))));
            $this->set('billing', $billing);
            $this->set('shipping', $shipping);

            // Finding tax for shipping postal code or setting it to 0
            $this->loadModel('Tax');
            $taxes = $this->Tax->find('first', array('conditions' => array('Tax.pstlz' => $shipping['Address']['postl_cod1'])));
            if ($taxes) {
                $this->set('tax', $taxes['Tax']['kbetr_gross']);
            } else {
                $this->set('tax', 0);
            }

            //Get cart content
            $cart = $this->Cart->getCart($this->Session->read('uid'));
            $this->set('cart', $cart);

            // Setting postal code of plant and shipping to calculate shipping.
            $this->loadModel('Plant');
            $origin = $this->Plant->find('first', array('conditions' => array('Plant.werks' => $cart[0]['Cart']['ship_location'])));
            $this->set('origin', $origin['Plant']['pstlz']);
            $this->set('destination', $shipping['Address']['postl_cod1']);
        }
    }


    public function payment()
    {
        $this->checkFrontUserSession();
        if ($this->Cart->isCartEmpty($this->Session->read('uid'))) {
            $this->Session->setFlash("You have empty cart", 'default', array(), 'failure');
            $this->redirect(array('controller' => 'carts', 'action' => 'view'));
            exit();
        }
        if ($this->request->data['is_ship']) {
            if (!$this->Session->read('ship_id')) {
                $this->Session->setFlash("Please select Shipping address first", 'default', array(), 'failure');
                $this->redirect(array('controller' => 'carts', 'action' => 'address'));
                exit();
            }
            $this->set('is_ship',$this->request->data['is_ship']);
        } else {
            $this->Session->setFlash("Please select order delivery method", 'default', array(), 'failure');
            $this->redirect(array('controller' => 'carts', 'action' => 'orderReview'));
            exit();
        }
    }


    public function calculateDiscount($total = 0, $ship_location = 1101)
    {
        $this->loadModel('Discount');
        $discount = $this->Discount->find('first', array('conditions' => array('Discount.werks' => $ship_location, 'Discount.konda' => 'RL', 'Discount.vkorg' => '1100', 'Discount.kstbw <=' => $total), 'fields' => array('Discount.kbetr'), 'order' => 'Discount.kbetr DESC'));
        if ($discount) {
            $this->Session->write('RL_discount', $discount['Discount']['kbetr']);
            return $discount['Discount']['kbetr'];
        }
    }


    public function calculateShipping($fromZip = 0, $toZip = 0, $weight = 0)
    {
        App::import('Vendor', 'Ups');
        $upsAccessnumber = "4CBE3F3AFCC21495";
        $upsUsername = " UnbrakoAlvin";
        $upsPassword = "abc@USA123";
        $upsShippernumber = "";
        $ups = new Ups($upsAccessnumber, $upsUsername, $upsPassword, $upsShippernumber);
        $serviceMethod = "03"; //"Ground"=>"03"
        $length = "0";
        $width = "0";
        $height = "0";
        $response = $ups->getRate($serviceMethod, $fromZip, $toZip, $length, $width, $height, $weight);
        if ($response['response']['code'] == 100) {
            $grand_total = $this->Session->read('subtotal') + $response['response']['rate'];
            $this->Session->write('shipping_charge', $response['response']['rate']);
            $this->Session->write('grand_total', $grand_total);
            echo json_encode(array('status' => true, 'shipping_charge' => $response['response']['rate'], 'grand_total' => $grand_total));
            exit;
        } else {
            echo json_encode(array('status' => false, 'msg' => $response['response']['errorMessage']));
            exit;
        }
        exit();
    }


    public function processPayment()
    {
        //App::import('Component', 'AuthorizeNet');
        $loginId = "3Ax3yP4Y";
        $transactionKey = "96Ppj29RSdHb66e9";
        //$serviceUrl = "https://test.authorize.net/gateway/transact.dll";
        $serviceUrl = "https://secure.authorize.net/gateway/transact.dll"; //For LIVE
        // You would need to add in necessary information here from your data collector
        $billinginfo = array("fname" => "First",
            "lname" => "Last",
            "address" => "123 Fake St. Suite 0",
            "city" => "City",
            "state" => "ST",
            "zip" => "90210",
            "country" => "USA");

        $shippinginfo = array("fname" => "First",
            "lname" => "Last",
            "address" => "123 Fake St. Suite 0",
            "city" => "City",
            "state" => "ST",
            "zip" => "90210",
            "country" => "USA");
        $isLive = false; //true when live
        $amount = 110;
        $tax = 5;
        $shipping = 5;

        $response = $this->AuthorizeNet->chargeCard($serviceUrl, $loginId, $transactionKey, '4111111111111111', '01', '2015', '123', $isLive, $amount, $tax, $shipping, "Purchase of Goods", $billinginfo, "gargharish85@gmail.com", "555-555-5555", $shippinginfo);

        echo "<pre>";
        print_r($response);
        die;
    }
}

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

    public $uses = array('Cart');
    public $components = array('AuthorizeNet');

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
        $this->layout = null;
        $this->checkFrontUserSession();
        if ((int)$this->request->data['Cart']['qty'] > 0) {
            $this->Cart->updateCart($this->request->data['Cart']['id'], $this->request->data['Cart']['qty']);
            $this->Session->setFlash("Cart has been updated successfully", 'default', array(), 'success');
        } else {
            $this->Session->setFlash("Please enter the valid quantity to update.", 'default', array(), 'failure');
        }

        $this->redirect(array('controller' => 'carts', 'action' => 'view'));
        exit();
    }


    public function deleteProduct($cid)
    {
        $this->layout = null;
        $this->checkFrontUserSession();
        $this->Cart->deleteProduct($cid);
        $this->Session->setFlash("Cart has been updated successfully", 'default', array(), 'success');
        $this->redirect(array('controller' => 'carts', 'action' => 'view'));
        exit();
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
                    exit();
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

                $states = $country->find('list', array('conditions' => array('Location.land1' => $data['Address']['country']),
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
        if ($this->Cart->isCartEmpty($this->Session->read('uid'))) {
            $this->Session->setFlash("You have empty cart", 'default', array(), 'failure');
            $this->redirect(array('controller' => 'carts', 'action' => 'view'));
            exit();
        } elseif (!$this->Session->read('ship_id')) {
            $this->Session->setFlash("Please select shipping address for you order", 'default', array(), 'failure');
            $this->redirect(array('controller' => 'carts', 'action' => 'address'));
            exit();
        } else {
            if ($this->request->data) {
                $this->Session->write('is_ship', $this->request->data['is_ship']);
                $this->redirect(array('controller' => 'carts', 'action' => 'payment'));
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
    }


    public function payment()
    {
        $this->checkFrontUserSession();
        if ($this->Cart->isCartEmpty($this->Session->read('uid'))) {
            $this->Session->setFlash("You have empty cart", 'default', array(), 'failure');
            $this->redirect(array('controller' => 'carts', 'action' => 'view'));
            exit();
        }
        if ($this->Session->read('is_ship')) {
            if (!$this->Session->read('ship_id')) {
                $this->Session->setFlash("Please select Shipping address first", 'default', array(), 'failure');
                $this->redirect(array('controller' => 'carts', 'action' => 'address'));
                exit();
            }
            $this->set('is_ship', $this->Session->read('is_ship'));
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
        } else {
            $this->Session->write('RL_discount', 0);
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
        $this->checkFrontUserSession();
        if ($this->Cart->isCartEmpty($this->Session->read('uid'))) {
            $this->Session->setFlash("You have empty cart", 'default', array(), 'failure');
            $this->redirect(array('controller' => 'carts', 'action' => 'view'));
            exit();
        } else {
            if (!$this->Session->read('ship_id')) {
                $this->Session->setFlash("Please select Shipping address first", 'default', array(), 'failure');
                $this->redirect(array('controller' => 'carts', 'action' => 'address'));
                exit();
            } else {
                if ($this->request->data) {
//                pr($this->request->data);die;
                    if ($this->request->data['Cart']['is_ship'] == 1 || $this->request->data['Cart']['is_ship'] == 0) {
                        if ($this->request->data['Cart']['is_credit'] == 0) {
                            $loginId = "3Ax3yP4Y";
                            $transactionKey = "96Ppj29RSdHb66e9";
                            //$serviceUrl = "https://test.authorize.net/gateway/transact.dll";
                            $serviceUrl = "https://secure.authorize.net/gateway/transact.dll"; //For LIVE

                            // You would need to add in necessary information here from your data collector
                            $this->loadModel('User');
                            $this->User->recursive = 2;
                            $user = $this->User->find('first', array('conditions' => array('User.id' => $this->Session->read('uid'))));
                            $billinginfo = array("fname" => $user['Customer']['firstname'],
                                "lname" => $user['Customer']['lastname'],
                                "address" => $user['Customer']['street'],
                                "city" => $user['Customer']['city'],
                                "state" => $user['Customer']['State']['bland'],
                                "zip" => $user['Customer']['postl_cod1'],
                                "country" => $user['Customer']['State']['landx']);

                            $this->loadModel('Address');
                            $address = $this->Address->find('first', array('conditions' => array('Address.user_id' => $this->Session->read('uid'), 'Address.id' => $this->Session->read('ship_id'))));

                            $shippinginfo = array("fname" => $address['Address']['firstname'],
                                "lname" => $address['Address']['lastname'],
                                "address" => $address['Address']['street'],
                                "city" => $address['Address']['city'],
                                "state" => $address['State']['bland'],
                                "zip" => $address['Address']['postl_cod1'],
                                "country" => $address['Country']['landx']);
                            $isLive = false; //true when live
                            $amount = $this->Session->read('grand_total');
                            $tax = $this->Session->read('tax');
                            if ($this->request->data['Cart']['is_ship'] == 1) {
                                if ($this->Session->read('shipping_charge')) {
                                    $shipping = $this->Session->read('shipping_charge');
                                } else {
                                    $shipping = 0;
                                }
                            } else {
                                $shipping = 0;
                            }
                            $response = $this->AuthorizeNet->chargeCard($serviceUrl, $loginId, $transactionKey, $this->request->data['Cart']['cc_number'], $this->request->data['Cart']['exp_mon'], date('Y') + $this->request->data['Cart']['exp_yr'], $this->request->data['Cart']['cvv'], $isLive, $amount, $tax, $shipping, "Purchase of Goods", $billinginfo, $this->Session->read('e_mail'), $user['Customer']['mob_number'], $shippinginfo);
                            if ($response['response']['code'] != 100) {
                                $master_order_data['Order']['erdat'] = date('Y-m-d');
                                $master_order_data['Order']['kunnr'] = $this->Session->read('cid');
                                $master_order_data['Order']['werks'] = $this->Session->read('ship_location');
                                if ($this->Session->read('is_ship') == 1) {
                                    $master_order_data['Order']['werks'] = 'UPS';
                                    $master_order_data['Order']['kwert_freight'] = $this->Session->read('shipping_charge');
                                } else {
                                    $master_order_data['Order']['werks'] = 'BY HAND';
                                }
                                $master_order_data['Order']['kwert_gross'] = $this->Session->read('total');
                                if ($this->Session->read('konda') == 'RL') {
                                    $master_order_data['Order']['kwert_trade'] = $this->Session->read('trade_discount');
                                }
                                $master_order_data['Order']['grand_total'] = $this->Session->read('grand_total');
                                if ($this->request->data['Cart']['is_credit'] == 0) {
                                    $master_order_data['Order']['dmbtr'] = $this->Session->read('grand_total');
                                }
                                $master_order_data['Order']['ship_to'] = $this->Session->read('ship_id');
//                                pr($master_order_data);die;
                                $this->loadModel('Order');
                                if ($this->Order->save($master_order_data)) {
                                    $order_id = $this->Order->id;
                                    $carts = $this->Cart->getCart($this->Session->read('uid'));
//                                pr($carts);die;
                                    foreach ($carts as $cart) {
                                        $order_line_items['Order']['por_ref_doc'] = $order_id;
                                        $order_line_items['Order']['erdat'] = date('Y-m-d');
                                        $order_line_items['Order']['matnr'] = $cart['Product']['matnr'];
                                        $order_line_items['Order']['kwmeng'] = $cart['Cart']['qty'];
                                        $order_line_items['Order']['kbetr_mrp'] = $cart['Product']['ProductAvailability']['kbetr'];
                                        $order_line_items['Order']['kwert_odis'] = $cart['Product']['ProductAvailability']['kbetr'] * ONLINE_DISCOUNT / 100;
                                        $this->Order->id = null;
                                        $this->Order->save($order_line_items);
                                        $this->Cart->deleteAll(array('Cart.user_id' => $this->Session->read('uid')), false);
                                        $this->Session->delete("ship_id", NULL);
                                        $this->Session->delete("total", NULL);
                                        $this->Session->delete("tax", NULL);
                                        $this->Session->delete("RL_discount", NULL);
                                        $this->Session->delete("trade_discount", NULL);
                                        $this->Session->delete("shipping_charge", NULL);
                                        $this->Session->delete("grand_total", NULL);
                                    }
                                }
                                $this->redirect(array('controller' => 'carts', 'action' => 'orderSuccess'));
                                exit();
                            } else {
                                $this->Session->setFlash($response['response']['message'], 'default', array(), 'failure');
                                $this->redirect(array('controller' => 'carts', 'action' => 'payment'));
                                exit();
                            }
                        } else {
                            $master_order_data['Order']['erdat'] = date('Y-m-d');
                            $master_order_data['Order']['kunnr'] = $this->Session->read('cid');
                            $master_order_data['Order']['werks'] = $this->Session->read('ship_location');
                            if ($this->Session->read('is_ship') == 1) {
                                $master_order_data['Order']['werks'] = 'UPS';
                                $master_order_data['Order']['kwert_freight'] = $this->Session->read('shipping_charge');
                            } else {
                                $master_order_data['Order']['werks'] = 'BY HAND';
                            }
                            $master_order_data['Order']['kwert_gross'] = $this->Session->read('total');
                            if ($this->Session->read('konda') == 'RL') {
                                $master_order_data['Order']['kwert_trade'] = $this->Session->read('trade_discount');
                            }
                            $master_order_data['Order']['grand_total'] = $this->Session->read('grand_total');
                            if ($this->request->data['Cart']['is_credit'] == 0) {
                                $master_order_data['Order']['dmbtr'] = $this->Session->read('grand_total');
                            }
                            $master_order_data['Order']['ship_to'] = $this->Session->read('ship_id');
//                                pr($master_order_data);die;
                            $this->loadModel('Order');
                            if ($this->Order->save($master_order_data)) {
                                $order_id = $this->Order->id;
                                $carts = $this->Cart->getCart($this->Session->read('uid'));
//                                pr($carts);die;
                                foreach ($carts as $cart) {
                                    $order_line_items['Order']['por_ref_doc'] = $order_id;
                                    $order_line_items['Order']['erdat'] = date('Y-m-d');
                                    $order_line_items['Order']['matnr'] = $cart['Product']['matnr'];
                                    $order_line_items['Order']['kwmeng'] = $cart['Cart']['qty'];
                                    $order_line_items['Order']['kbetr_mrp'] = $cart['Product']['ProductAvailability']['kbetr'];
                                    $order_line_items['Order']['kwert_odis'] = $cart['Product']['ProductAvailability']['kbetr'] * ONLINE_DISCOUNT / 100;
                                    $this->Order->id = null;
                                    $this->Order->save($order_line_items);
                                    $this->Cart->deleteAll(array('Cart.user_id' => $this->Session->read('uid')), false);
                                    $this->Session->delete("ship_id", NULL);
                                    $this->Session->delete("total", NULL);
                                    $this->Session->delete("tax", NULL);
                                    $this->Session->delete("RL_discount", NULL);
                                    $this->Session->delete("trade_discount", NULL);
                                    $this->Session->delete("shipping_charge", NULL);
                                    $this->Session->delete("grand_total", NULL);
                                }
                            }
                            $this->redirect(array('controller' => 'carts', 'action' => 'orderSuccess'));
                            exit();
                        }
                    } else {
                        $this->Session->setFlash("Please select order delivery method.", 'default', array(), 'failure');
                        $this->redirect(array('controller' => 'carts', 'action' => 'payment'));
                        exit();
                    }
                } else {
                    $this->Session->setFlash("Please fill in the correct payment information.", 'default', array(), 'failure');
                    $this->redirect(array('controller' => 'carts', 'action' => 'payment'));
                    exit();
                }
            }
        }
    }

    public function createUpdateAddress($id = null)
    {
        $this->checkFrontUserSession();
        $this->loadModel('Address');

        App::import('model', 'Location');

        if ($this->request->data) {
            $this->request->data['Address']['user_id'] = $this->Session->read('uid');
            $this->request->data['Address']['kunnr'] = $this->Session->read('kunnr');
            if (isset($this->request->data['input3'])) {
                $this->Address->create();
                unset($this->request->data['Address']['id']);
            }

            if ($this->Address->save($this->request->data)) {
                $ship_id = (isset($this->request->data['Address']['id']) ? $this->request->data['Address']['id'] : $this->Address->getLastInsertId());
                $this->Session->write('ship_id', $ship_id);
                $this->Session->setFlash('Address has been saved successfully.', 'default', array(),
                    'success');
            } else {
                $this->Session->setFlash('Address can not be saved. Please try again.', 'default', array(),
                    'failure');
            }
            $this->redirect(array('controller' => 'carts', 'action' => 'orderReview'));
            exit();
        } else {
            $this->set('edit', false);
            if ($id != null) {
                $data = $this->Address->read('', $id);
                if ($data) {
                    $this->request->data = $data;
                    $this->set('edit', true);
                    $this->set('states', $country->find('list', array('conditions' => array('Location.bland' => $data['Address']['bland']), 'fields' => array('bland', 'bezei'))));
                }
            }
        }
    }

    public function orderSuccess()
    {
        $this->checkFrontUserSession();
    }
}
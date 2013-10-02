<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
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
class UsersController extends AppController
{
    public $uses = array('User');

    /**
     * Display Login form and validate a person for login
     *
     */
    public function login()
    {
        if (!$this->Session->read("uid")) {
            if ($this->request->data) {
                $this->User->set($this->request->data);
                if ($this->User->validates()) {
                    $this->User->recursive = 2;
                    $data = $this->User->find('first', array('conditions' => array('User.e_mail' => $this->request->data['User']['e_mail'], 'User.password' => $this->request->data['User']['password'], 'Customer.konda != ' => 'AD', 'Customer.status ' => '1')));
                    if ($data) {
                        $this->Session->write('uid', $data['User']['id']);
                        $this->Session->write('e_mail', $data['User']['e_mail']);
                        $this->Session->write('type', $data['Customer']['konda']);
                        $this->Session->write('kunnr', $data['Customer']['kunnr']);
                        $this->Session->write('fname', $data['Customer']['firstname']);
                        $this->Session->write('lname', $data['Customer']['lastname']);
                        if ($data['Customer']['pltyp'] == null || $data['Customer']['pltyp'] == '') {
                            $this->Session->write('discount', 0);
                        } else {
                            $this->Session->write('discount', $data['Customer']['Discount']['discount']);
                        }
                        $this->redirect(array('controller' => 'users', 'action' => 'myAccount'));
                        exit();
                    } else {
                        $this->Session->setFlash('The user could not be found. Please fill the correct information.', 'default', array(), 'failure');
                    }
                }
            }
        } else {
            $this->redirect(array('controller' => 'users', 'action' => 'myAccount'));
            exit();
        }
    }

    public function index()
    {
        $this->redirect(array('controller' => 'users', 'action' => 'login'));
        exit();
    }

    public function logout()
    {
        $this->Session->delete("uid", NULL);
        $this->Session->delete('e_mail', NULL);
        $this->Session->delete('type', NULL);
        $this->Session->delete('kunnr', NULL);
        $this->Session->delete('fname', NULL);
        $this->Session->delete('lname', NULL);
        $this->Session->delete('ship_location', NULL);
        $this->Session->setFlash("You have logout successfully", 'default', array(), 'success');
        $this->redirect(array('controller' => 'users', 'action' => 'login'));
        exit();
    }

    public function myAccount()
    {
        $this->checkFrontUserSession();
    }

    public function forgotPassword()
    {
        if (!$this->Session->read("uid")) {
            if ($this->request->data) {
                $this->User->set($this->request->data);
                if ($this->User->validates()) {
                    $data = $this->User->find('first', array('conditions' => array('User.e_mail' => $this->request->data['User']['e_mail'], 'Customer.konda !=' => 'AD', 'Customer.status ' => '1')));
                    if ($data) {
                        // @todo: Setup the email correctly
                        $msg = "<html><body>Hello " . ucfirst($data['Customer']['firstname']) . ' ' . ucfirst($data['Customer']['lastname']) . ",<br/><br/> Please find below your account password. <br/><br/> Password: <b>" . $data['User']['password'] . "</b>
                            <br/>
                            <br/>
                            We advise you to change your account password frequently to keep your account secure.
                            <br/>
                            <br/>
                            Thanks & Regards,
                            <br/> Support Team,
                            <br/>
                            Unbrako</body></html>";
                        CakeEmail::deliver($data['User']['e_mail'], 'Forgot Password', $msg, array('from' => array('support@unbrako.com' => 'Support Unbrako'), 'emailFormat' => 'html'));
                        $this->Session->setFlash('An email containing your password has been sent to your email address.', 'default', array(), 'success');
                        $this->redirect(array('controller' => 'users', 'action' => 'login'));
                        exit();
                    } else {
                        $this->Session->setFlash('Please enter the correct Email to retrieve the password', 'default', array(), 'failure');
                        $this->redirect(array('controller' => 'users', 'action' => 'login'));
                        exit();
                    }
                } else {
                    $this->redirect(array('controller' => 'users', 'action' => 'login'));
                    exit();
                }
            } else {
                $this->redirect(array('controller' => 'users', 'action' => 'login'));
                exit();
            }
        } else {
            $this->redirect(array('controller' => 'users', 'action' => 'myAccount'));
            exit();
        }
    }

    public function registerStep1()
    {
        if ($this->Session->read("uid")) {
            $this->redirect(array('controller' => 'users', 'action' => 'myAccount'));
            exit();
        }
    }

    public function wholesalerTerms()
    {
        if ($this->Session->read("uid")) {
            $this->redirect(array('controller' => 'users', 'action' => 'myAccount'));
            exit();
        }
    }

    public function register($type = null)
    {
        App::import('model', 'Location');
        $country = new Location();
        $countries = $country->find('list', array('fields' => array('land1', 'landx')));
        $this->set('countries', $countries);
        App::import('model', 'BusinessType');
        $btypes = new BusinessType();
        $business_types = $btypes->find('list', array('fields' => array('brsch', 'brtxt')));
        $this->set('business_types', $business_types);
        $this->set('states', array());
        $this->set('cities', array());
        if (!$this->Session->read("uid")) {
            if ($this->request->data) {
                $this->request->data['User']['e_mail'] = $this->request->data['Customer']['e_mail'];
                $user_type = $this->request->data['User']['user_type'];
                $this->set('user_type', $user_type);
                $error = false;
                $oem_error = false;
                if ($user_type == 1) {
                    $this->request->data['Customer']['konda'] = 'RL';
                    $this->request->data['Customer']['verify_status'] = '2';
                    unset($this->request->data['Customer']['stceg']);
                } elseif ($user_type == 2) {
                    $this->request->data['Customer']['konda'] = 'DR';
                    $cust_errors = array();
                    $file_type = array();
                    if (!empty($this->request->data['Customer']['stceg']['name'])) {
                        $file_type = explode('/', $this->request->data['Customer']['stceg']['type']);
                        $file_type = $file_type[1];
                    }
                    if (empty($this->request->data['Customer']['brsch'])) {
                        $error = true;
                        $cust_errors['brsch'][0] = 'Please select the Business type';
                    }
                    if (empty($this->request->data['Customer']['year_estd'])) {
                        $error = true;
                        $cust_errors['year_estd'][0] = 'Please enter the year of establishment';
                    }
                    if (empty($this->request->data['Customer']['stceg']['name'])) {
                        $error = true;
                        $cust_errors['stceg'][0] = 'Please select the copy of license';
                    } elseif ($this->request->data['Customer']['stceg']['error'] != 0) {
                        $error = true;
                        $cust_errors['stceg'][0] = 'Problem uploading file. Try again';
                    } elseif (!in_array($file_type, array('doc', 'docx', 'pdf', 'png', 'jpg', 'jpeg', 'ppt', 'pptx', 'bmp', 'gif'))) {
                        $error = true;
                        $cust_errors['stceg'][0] = 'Please select the right file type';
                    } else {
                        if (!$error) {
                            $filename = time() . '.' . $file_type;
                            move_uploaded_file($this->data['Customer']['stceg']['tmp_name'], WWW_ROOT . 'files' . DS . $filename);
                            $this->request->data['Customer']['stceg'] = $filename;
                        }
                    }
                } elseif ($user_type == 3) {
                    $this->request->data['Customer']['konda'] = 'OE';
                    $cust_errors = array();
                    if (!empty($this->request->data['Customer']['stceg']['name'])) {
                        $file_type = explode('/', $this->request->data['Customer']['stceg']['type']);
                        $file_type = $file_type[1];
                        if (empty($this->request->data['Customer']['brsch'])) {
                            $oem_error = true;
                            $cust_errors['brsch'][0] = 'Please select the Business type';
                        }
                        if (empty($this->request->data['Customer']['year_estd'])) {
                            $oem_error = true;
                            $cust_errors['year_estd'][0] = 'Please enter the year of establishment';
                        }
                        if ($this->request->data['Customer']['stceg']['error'] != 0) {
                            $oem_error = true;
                            $cust_errors['stceg'][0] = 'Problem uploading file. Try again';
                        } elseif (!in_array($file_type, array('doc', 'docx', 'pdf', 'png', 'jpg', 'jpeg', 'ppt', 'pptx', 'bmp', 'gif'))) {
                            $oem_error = true;
                            $cust_errors['stceg'][0] = 'Please select the right file type';
                        } else {
                            if (!$oem_error) {
                                $filename = time() . '.' . $file_type;
                                move_uploaded_file($this->data['Customer']['stceg']['tmp_name'], WWW_ROOT . 'files' . DS . $filename);
                                $this->request->data['Customer']['stceg'] = $filename;
                            }
                        }
                    }
                } elseif ($user_type == 4) {
                    $this->request->data['Customer']['konda'] = 'GV';
                    $this->request->data['Customer']['pltyp'] = 16;
                    unset($this->request->data['Customer']['stceg']);
                }
                if (!$error && !$oem_error) {
                    if ($this->User->saveAssociated($this->request->data, array('deep' => true, 'validate' => 'first'))) {
                        // @todo Set up the proper success message and send email
                        if ($user_type == 1) {
                            $msg = "<html><body>Hello " . ucfirst($this->request->data['Customer']['firstname']) . ' ' . ucfirst($this->request->data['Customer']['lastname']) . ",<br/><br/> Thanks for registering with us. Please click on below link  to activate your account. Activating your account will help you to enjoy our services without any interruption. <br/><br/> <a href='unbrako.us/jkt/estore/users/changeStatus/" . base64_encode($this->User->Customer->id) .
                                "'>Verify
                        Your Account</a>
                        <br/>
                        <br/>
                        Thanks & Regards,
                        <br/> Support Team,
                        <br/>
                        Unbrako</body></html>";
                            CakeEmail::deliver($this->request->data['User']['e_mail'], 'Thanks for Registration', $msg, array('from' => array('support@unbrako.com' => 'Support Unbrako'), 'emailFormat' => 'html'));
                            $this->Session->setFlash('Thanks for registering with us. A verification email has been sent for account activation. Please activate your account and enjoy our services.', 'default', array(), 'success');
                        } else {
                            $msg = "<html><body>Hello " . ucfirst($this->request->data['Customer']['firstname']) . ' ' . ucfirst($this->request->data['Customer']['lastname']) . ",<br/><br/> Thanks for registering with us. Our team will verify your account and update you with in 48 hrs. Thanks for your patience. <br/>
                        <br/>
                        Thanks & Regards,
                        <br/> Support Team,
                        <br/>
                        Unbrako</body></html>";
                            CakeEmail::deliver($this->request->data['User']['e_mail'], 'Thanks for Registration', $msg, array('from' => array('support@unbrako.com' => 'Support Unbrako'), 'emailFormat' => 'html'));
                            $this->Session->setFlash('Thanks for registering with us. An email has been sent to you. Your account will be verified soon.', 'default', array(), 'success');
                        }
                        $this->redirect(array('controller' => 'users', 'action' => 'login'));
                        exit();
                    }
                } else {
                    $this->User->set($this->request->data);
                    $this->User->validates();
                    $this->User->Customer->set($this->request->data);
                    $this->User->Customer->validates();
                    $this->User->Customer->validationErrors = array_merge($this->User->Customer->validationErrors, $cust_errors);
                }
            } else {
                if ($type == 1 || $type == 2 || $type == 3 || $type == 4) {
                    $this->set('user_type', $type);
                } else {
                    $this->Session->setFlash('Please select the right user type to get registered', 'default', array(), 'failure');
                    $this->redirect(array('controller' => 'users', 'action' => 'registerStep1'));
                    exit();
                }
            }
        } else {
            $this->redirect(array('controller' => 'users', 'action' => 'myAccount'));
            exit();
        }
    }


    public function changeStatus($customer_id = null)
    {
        $this->layout = null;
        $this->loadModel('Customer');
        $customer = $this->Customer->find('first', array('conditions' => array('Customer.id' => base64_decode($customer_id), 'Customer.link_expire' => 0)));
        if ($customer) {
            $this->Customer->id = base64_decode($customer_id);
            $data['Customer']['status'] = 1;
            $data['Customer']['link_expire'] = 1;
            $data['Customer']['deactive_reason'] = null;
            $this->Customer->validate = array();
            if ($this->Customer->save($data)) {
                $this->Session->setFlash('You have successfully verified your account. Please login below with your credentials.', 'default', array(), 'success');
                $this->redirect(array('controller' => 'users', 'action' => 'login'));
            } else {
                pr($this->Customer->validationErrors);
                die;
                $this->Session->setFlash('Account can not be verified. Please try again.', 'default', array(), 'failure');
                $this->redirect(array('controller' => 'users', 'action' => 'login'));
            }
        } else {
            $this->Session->setFlash('Account can not be verified. Please try again.', 'default', array(), 'failure');
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
    }


    public function getStates($countryID = null)
    {
        $this->layout = null;
        $this->loadModel('Location');
        $states = $this->Location->find('list', array('conditions' => array('Location.land1' => $countryID), 'fields' => array('bland', 'bezei')));
        $a = '';
        $a .= "<option value=\"\">--Select State--</option>";
        foreach ($states as $key => $value) {
            $a .= "<option value=\"$key\">" . $value . "</option>";
        }
        echo $a;
        exit();
    }

    public function getCities($countryID = null, $stateID = null)
    {
        $this->layout = null;
        $this->loadModel('Location');
        $cities = $this->Location->find('list', array('conditions' => array('Location.bland' => $stateID, 'Location.land1' => $countryID), 'fields' => array('ort01', 'bezei_city')));
        $a = '';
        $a .= "<option value=\"\">--Select City--</option>";
        foreach ($cities as $key => $value) {
            $a .= "<option value=\"$key\">" . $value . "</option>";
        }
        echo $a;
        exit();
    }

    public function getProductLocations($countryID = null)
    {
        $this->layout = null;
        $this->loadModel('Plant');
        $locations = $this->Plant->find('list', array('conditions' => array('Plant.land1' => $countryID), 'fields' => array('regio', 'bezei')));
        $a = '';
        $a .= "<option value=\"\">--Select Location--</option>";
        foreach ($locations as $key => $value) {
            $a .= "<option value=\"$key\">" . $value . "</option>";
        }
        echo $a;
        exit();
    }

    public function productConfirmation()
    {
    }

    public function chooseLocation()
    {
        $this->checkFrontUserSession();
        $this->loadModel('Plant');
        $plants = $this->Plant->find('list', array('conditions' => array('land1' => 'USA'), 'fields' => array('werks', 'ort01')));
        $this->set('plants', $plants);
        if ($this->request->data) {
            if (empty($this->request->data['User']['location'])) {
                $this->Session->setFlash('Please select the nearest location to place order.', 'default', array(), 'failure');
            } else {
                $location = $this->Plant->find('first', array('conditions' => array('Plant.werks' => $this->request->data['User']['location'])));
                if ($location) {
                    $this->Session->write('ship_location', $location['Plant']['werks']);
                    $this->redirect(array('controller' => 'users', 'action' => 'productFamily'));
                    exit();
                } else {
                    $this->Session->setFlash('Please select the nearest plant location to place order.', 'default', array(), 'failure');
                }
            }
        }
    }

    public function productFamily()
    {
        $this->checkFrontUserSession();
        $this->__isLocationSelected();
        $this->loadModel('ProductGroup');
        $this->set('product_groups', $this->ProductGroup->find('all'));
    }

    function __isLocationSelected()
    {
        if (!$this->Session->read('ship_location')) {
            $this->Session->setFlash('Please select the nearest plant location to place order.', 'default', array(), 'failure');
            $this->redirect(array('controller' => 'users', 'action' => 'chooseLocation'));
            exit();
        }
    }

    public function productCategory($group_id = null)
    {
        $this->checkFrontUserSession();
        $this->__isLocationSelected();
        $this->loadModel('ProductType');
        $this->set('product_types', $this->ProductType->find('all', array('conditions' => array('ProductType.parentgroupid' => $group_id))));
        $this->set('group_id', $group_id);
    }


    public function productDetail($type_id = null)
    {
        $this->checkFrontUserSession();
        $this->__isLocationSelected();
        $this->loadModel('Product');
        $productsL = $this->Product->find('all', array('conditions' => array('Product.matkl' => $type_id), 'group' => array('Product.mvgr2', 'Product.mvgr3', 'Product.mvgr4')));
		
		$criteria='';
		//Show fields listing in the left Panel
		$gradeList = array();
		$finishingList = array();
		$threadList = array();
		$standardList = array();
		if(isset($productsL) && !empty($productsL)){
			foreach($productsL as $singleProduct){
				
				//Grade/Quality
				if(!in_array($singleProduct['Product']['wgbez60-mvgr3'],$gradeList)){
					$gradeList[$singleProduct['Product']['wgbez60-mvgr3']] = $singleProduct['Product']['wgbez60-mvgr3'];
				}
				
				//Surface Finish/Coating
				if(!in_array($singleProduct['Product']['wgbez60-mvgr4'],$finishingList)){
					$finishingList[$singleProduct['Product']['wgbez60-mvgr4']] = $singleProduct['Product']['wgbez60-mvgr4'];
				}
				
				//Thread
				if(!in_array($singleProduct['Product']['wgbez60-mvgr2'],$threadList)){
					$threadList[$singleProduct['Product']['wgbez60-mvgr2']] = $singleProduct['Product']['wgbez60-mvgr2'];
				}
				
				//Standard
				if(!in_array($singleProduct['Product']['wgbez60-mvgr5'],$standardList)){
					$standardList[$singleProduct['Product']['wgbez60-mvgr5']] = $singleProduct['Product']['wgbez60-mvgr5'];
				}
			}
		}
		$this->set(compact('gradeList','finishingList','threadList','standardList'));
		//Show fields listing in the left Panel
		
		
		
		
		$urlString = "/";
      	if(isset($this->params['pass'][0]) && !empty($this->params['pass'][0])){
			$urlString.= $this->params['pass'][0]."/";
		}
		$criteria .= " Product.matkl = '".$type_id."'";
      	if(isset($this->data['Product']) || !empty($this->params['named'])){
			
			//Grade/Quality
			if(isset($this->data['Product']['wgbez60-mvgr3']) && ($this->data['Product']['wgbez60-mvgr3']!='')){
				$criteria .= " AND Product.wgbez60-mvgr3 LIKE '".$this->data['Product']['wgbez60-mvgr3']."'";
				$this->set("wgbez60-mvgr3", $this->data['Product']['wgbez60-mvgr3']);
				$urlString.= "wgbez60-mvgr3:".$this->data['Product']['wgbez60-mvgr3']."/";
			}elseif(isset($this->params['named']['wgbez60-mvgr3']) && $this->params['named']['wgbez60-mvgr3']!=''){
				if(!isset($this->data['Product']['wgbez60-mvgr3'])){
					$criteria .= " AND Product.wgbez60-mvgr3 LIKE '".$this->params['named']['wgbez60-mvgr3']."'";
					$this->set("wgbez60-mvgr3", $this->params['named']['wgbez60-mvgr3']);
					$urlString.= "wgbez60-mvgr3:".$this->params['named']['wgbez60-mvgr3']."/";
				}
			}
			
			//Surface Finish/Coating
			if(isset($this->data['Product']['wgbez60-mvgr4']) && ($this->data['Product']['wgbez60-mvgr4']!='')){
				$criteria .= " AND Product.wgbez60-mvgr4 LIKE '".$this->data['Product']['wgbez60-mvgr4']."'";
				$this->set("wgbez60-mvgr4", $this->data['Product']['wgbez60-mvgr4']);
				$urlString.= "wgbez60-mvgr4:".$this->data['Product']['wgbez60-mvgr4']."/";
			}elseif(isset($this->params['named']['wgbez60-mvgr4']) && $this->params['named']['wgbez60-mvgr4']!=''){
				if(!isset($this->data['Product']['wgbez60-mvgr4'])){
					$criteria .= " AND Product.wgbez60-mvgr4 LIKE '".$this->params['named']['wgbez60-mvgr4']."'";
					$this->set("wgbez60-mvgr4", $this->params['named']['wgbez60-mvgr4']);
					$urlString.= "wgbez60-mvgr4:".$this->params['named']['wgbez60-mvgr4']."/";
				}
			}
			
			//Thread
			if(isset($this->data['Product']['wgbez60-mvgr2']) && ($this->data['Product']['wgbez60-mvgr2']!='')){
				$criteria .= " AND Product.wgbez60-mvgr2 LIKE '".$this->data['Product']['wgbez60-mvgr2']."'";
				$this->set("wgbez60-mvgr2", $this->data['Product']['wgbez60-mvgr2']);
				$urlString.= "wgbez60-mvgr2:".$this->data['Product']['wgbez60-mvgr2']."/";
			}elseif(isset($this->params['named']['wgbez60-mvgr2']) && $this->params['named']['wgbez60-mvgr2']!=''){
				if(!isset($this->data['Product']['wgbez60-mvgr2'])){
					$criteria .= " AND Product.wgbez60-mvgr2 LIKE '".$this->params['named']['wgbez60-mvgr2']."'";
					$this->set("wgbez60-mvgr2", $this->params['named']['wgbez60-mvgr2']);
					$urlString.= "wgbez60-mvgr2:".$this->params['named']['wgbez60-mvgr2']."/";
				}
			}
			
			//Standard
			if(isset($this->data['Product']['wgbez60-mvgr5']) && ($this->data['Product']['wgbez60-mvgr5']!='')){
				$criteria .= " AND Product.wgbez60-mvgr5 LIKE '".$this->data['Product']['wgbez60-mvgr5']."'";
				$this->set("wgbez60-mvgr5", $this->data['Product']['wgbez60-mvgr5']);
				$urlString.= "wgbez60-mvgr5:".$this->data['Product']['wgbez60-mvgr5']."/";
			}elseif(isset($this->params['named']['wgbez60-mvgr5']) && $this->params['named']['wgbez60-mvgr5']!=''){
				if(!isset($this->data['Product']['wgbez60-mvgr5'])){
					$criteria .= " AND Product.wgbez60-mvgr5 LIKE '".$this->params['named']['wgbez60-mvgr5']."'";
					$this->set("wgbez60-mvgr5", $this->params['named']['wgbez60-mvgr5']);
					$urlString.= "wgbez60-mvgr5:".$this->params['named']['wgbez60-mvgr5']."/";
				}
			}
		}
		$newUrl = "productDetail".$urlString;
		$this->set('newUrl',$newUrl);
		
		$this->paginate = array(
			'page'=> 1,
			'group' => array('Product.mvgr2', 'Product.mvgr3', 'Product.mvgr4'),
			'limit'=>'1',
		);
		$products = $this->paginate('Product',$criteria);
		
        $this->set('products', $products);
        $this->set('type_id', $type_id);
    }


    public function products($product_id = null)
    {
        $this->checkFrontUserSession();
        $this->__isLocationSelected();
        $this->loadModel('Product');
		
		if(isset($this->data['Product']['m_id']) && !empty($this->data['Product']['m_id'])){
			$product = $this->Product->find('first', array('conditions' => array('Product.matnr' => $this->data['Product']['m_id'])));
		}elseif(isset($this->params['named']['m_id']) && !empty($this->params['named']['m_id'])){
			$product = $this->Product->find('first', array('conditions' => array('Product.matnr' => $this->params['named']['m_id'])));
		}else{
			$product = $this->Product->find('first', array('conditions' => array('Product.id' => $product_id)));
		}
		
		
		
		
		
		
        
        if ($product) {
            $options = array();
            $options['joins'] = array(
                array('table' => 'product_availability',
                    'alias' => 'ProductAvailability',
                    'type' => 'INNER',
                    'conditions' => array(
                        'Product.matnr = ProductAvailability.matnr',
                        'ProductAvailability.vkorg' => 1100
                    )
                )
            );
            $options['contain'] = array('ProductType');
            $options['conditions'] = array('Product.mvgr2' => $product['Product']['mvgr2'], 'Product.mvgr3' => $product['Product']['mvgr3'], 'Product.mvgr4' => $product['Product']['mvgr4']);
            $options['fields'] = array('Product.*', 'ProductAvailability.*', 'ProductType.*');
			
			$productsL = $this->Product->find('all', $options);
			//Show fields listing in the left Panel
			$diaList = array();
			$lengthList = array();
			if(isset($productsL) && !empty($productsL)){
				foreach($productsL as $singleProduct){
					
					//Dia
					if(!in_array($singleProduct['Product']['bezei'],$diaList)){
						$diaList[$singleProduct['Product']['bezei']] = $singleProduct['Product']['bezei'];
					}
					
					//Length
					if(!in_array($singleProduct['Product']['groes'],$lengthList)){
						$lengthList[$singleProduct['Product']['groes']] = $singleProduct['Product']['groes'];
					}
				}
			}
			$this->set(compact('diaList','lengthList'));
			//Show fields listing in the left Panel
			
			$urlString = "/";
			if(isset($this->params['pass'][0]) && !empty($this->params['pass'][0])){
				$urlString.= $this->params['pass'][0]."/";
			}
			if(isset($this->data['Product']) || !empty($this->params['named'])){
				//Dia
				if(isset($this->data['Product']['bezei']) && ($this->data['Product']['bezei']!='')){
					$options['conditions']['Product.bezei'] = $this->data['Product']['bezei'];
					$urlString.= "bezei:".$this->data['Product']['bezei']."/";
				}elseif(isset($this->params['named']['bezei']) && $this->params['named']['bezei']!=''){
					if(!isset($this->data['Product']['bezei'])){
						$options['conditions']['Product.bezei'] = $this->params['named']['bezei'];
						$urlString.= "bezei:".$this->params['named']['bezei']."/";
					}
				}
				
				//Length
				if(isset($this->data['Product']['groes']) && ($this->data['Product']['groes']!='')){
					$options['conditions']['Product.groes'] = $this->data['Product']['groes'];
					$urlString.= "groes:".$this->data['Product']['groes']."/";
				}elseif(isset($this->params['named']['groes']) && $this->params['named']['groes']!=''){
					if(!isset($this->data['Product']['groes'])){
						$options['conditions']['Product.groes'] = $this->params['named']['groes'];
						$urlString.= "groes:".$this->params['named']['groes']."/";
					}
				}
			}
			$newUrl = "products".$urlString;
			
			$this->set('newUrl',$newUrl);
			
			
            $options['limit'] = '1';
			$products = $this->Product->find('all', $options);
			//$products = $this->paginate('Product',$options);
			
            $this->set('products', $products);
        } else {
            $this->redirect(array('controller' => 'users', 'action' => 'chooseLocation'));
        }
    }

    public function admin_login()
    {
        $this->layout = null;
        if (!$this->Session->read("aid")) {
            if ($this->request->data) {
                $this->User->set($this->request->data);
                if ($this->User->validates()) {
                    $data = $this->User->find('first', array('conditions' => array('User.e_mail' => $this->request->data['User']['e_mail'], 'User.password' => $this->request->data['User']['password'], 'Customer.konda ' => 'AD', 'Customer.status ' => '1')));
                    if ($data) {
                        $this->Session->write('aid', $data['User']['id']);
                        $this->redirect(array('controller' => 'users', 'action' => 'dashboard', 'admin' => true));
                        exit();
                    } else {
                        $this->Session->setFlash('The user could not be found. Please fill the correct information.', 'default', array(), 'failure');
                    }
                }
            }
        } else {
            $this->redirect(array('controller' => 'users', 'action' => 'dashboard', 'admin' => true));
            exit();
        }
    }

    public function admin_dashboard()
    {
        $this->checkUserSession();
        $this->layout = 'admin';
        $this->redirect(array('controller' => 'users', 'action' => 'listCustomers', 'admin' => true));
    }

    public function admin_logout()
    {
        $this->Session->delete("aid", NULL);
        $this->Session->setFlash("You have logout successfully", 'default', array(), 'success');
        $this->redirect(array('controller' => 'users', 'action' => 'login', 'admin' => true));
        exit();
    }

    public function admin_forgotPassword()
    {
        if (!$this->Session->read("aid")) {
            if ($this->request->data) {
                if (!empty($this->request->data['User']['e_mail'])) {
                    $data = $this->User->find('first', array('conditions' => array('User.e_mail' => $this->request->data['User']['e_mail'], 'Customer.konda' => 'AD', 'Customer.status' => '1')));
                    if ($data) {
                        // @todo: Setup the email correctly
                        $msg = "<html><body>Hello " . ucfirst($data['Customer']['firstname']) . ' ' . ucfirst($data['Customer']['lastname']) . ",<br/><br/> Please find below your account password. <br/><br/> Password: <b>" . $data['User']['password'] . "</b>
                            <br/>
                            <br/>
                            We advise you to change your account password frequently to keep your account secure.
                            <br/>
                            <br/>
                            Thanks & Regards,
                            <br/> Support Team,
                            <br/>
                            Unbrako</body></html>";
                        CakeEmail::deliver($data['User']['e_mail'], 'Forgot Password', $msg, array('from' => array('support@unbrako.com' => 'Support Unbrako'), 'emailFormat' => 'html'));
                        $this->Session->setFlash('An email containing the password has been sent to your email address.', 'default', array(), 'success');
                        $this->redirect(array('controller' => 'users', 'action' => 'login', 'admin' => true));
                        exit();
                    } else {
                        $this->Session->setFlash('Please enter the correct Email to retrieve the password', 'default', array(), 'failure');
                        $this->redirect(array('controller' => 'users', 'action' => 'login', 'admin' => true));
                        exit();
                    }
                } else {
                    $this->Session->setFlash('Please enter the correct Email to retrieve the password', 'default', array(), 'failure');
                    $this->redirect(array('controller' => 'users', 'action' => 'login', 'admin' => true));
                    exit();
                }
            } else {
                $this->Session->setFlash('Please enter the correct Email to retrieve the password', 'default', array(), 'failure');
                $this->redirect(array('controller' => 'users', 'action' => 'login', 'admin' => true));
                exit();
            }
        } else {
            $this->redirect(array('controller' => 'users', 'action' => 'dashboard', 'admin' => true));
            exit();
        }
    }

    public function admin_changePassword()
    {
        $this->checkUserSession();
        $this->layout = 'admin';
        if ($this->request->data) {
            $this->User->set($this->request->data);
            $data = $this->User->find('first', array('conditions' => array('User.id' => $this->Session->read('aid'))));
            if ($data['User']['password'] != $this->request->data['User']['old']) {
                $this->User->validationErrors['old'][0] = 'Please fill correct old password';
            }
            if ($this->User->validates()) {
                $this->User->id = $this->Session->read('aid');
                $this->request->data['User']['password'] = $this->request->data['User']['new'];
                $this->User->save($this->request->data);
                $this->Session->setFlash('Password changed successfully', 'default', array(), 'success');
            }
        }
    }

    public function admin_listCustomers()
    {
        $this->checkUserSession();
        $this->layout = 'admin';
        $this->Paginator->settings = array(
            'conditions' => array("Not" => array('Customer.konda' => array('AD', 'EM'))),
            'limit' => 20,
            'order' => array('Customer.firstname' => 'asc'),
            'contain' => array('Customer' => array('Country', 'State', 'City'))
        );
        $data = $this->Paginator->paginate('User');
        $this->set(compact('data'));
    }

    public function admin_editUser($id = null)
    {
        $this->checkUserSession();
        $this->layout = 'admin';
        if ($this->request->data) {
            $this->loadModel('Customer');
            $this->Customer->validate = array();
            if ($this->request->data['Customer']['konda'] != 'RL') {
                if (isset($this->request->data['Customer']['verify_status']) && $this->request->data['Customer']['verify_status'] == '2') {
                    // @todo: Setup the email correctly
                    $msg = "<html><body>Hello " . ucfirst($this->request->data['Customer']['firstname']) . ' ' . ucfirst($this->request->data['Customer']['lastname']) . ",<br/><br/> Thanks for registering with us. Please click on below link to activate your account. Activating your account will help you to enjoy our services without any interruption. <br/><br/> <a href='unbrako.us/jkt/estore/users/changeStatus/" . base64_encode($this->request->data['Customer']['id']) .
                        "'>Verify
                        Your Account</a>
                        <br/>
                        <br/>
                        Thanks & Regards,
                        <br/> Support Team,
                        <br/>
                        Unbrako</body></html>";
                    CakeEmail::deliver($this->request->data['User']['e_mail'], 'Thanks for Registration', $msg, array('from' => array('support@unbrako.com' => 'Support Unbrako'), 'emailFormat' => 'html'));
                    $this->request->data['Customer']['link_expire'] = 0;
                    $this->Customer->save($this->request->data);
                    $this->Session->setFlash('User has been updated successfully. And a verification email has been sent to the user for their account activation.', 'default', array(), 'success');
                } else {
                    $this->Customer->save($this->request->data);
                    $this->Session->setFlash('User has been updated successfully.', 'default', array(), 'success');
                }
            } else {
                $this->Customer->save($this->request->data);
                $this->Session->setFlash('User has been updated successfully.', 'default', array(), 'success');
            }

            $this->redirect(array('controller' => 'users', 'action' => 'listCustomers', 'admin' => true));
        } else {
            $user = $this->User->find('first', array('conditions' => array('User.id' => $id)));
            if ($user) {
                $this->request->data = $user;
                $this->loadModel('Discount');
                $price_list = $this->Discount->find('list', array('fields' => array('Discount.id', 'Discount.discount_final'), 'conditions' => array('Discount
                .cust_cat' => $user['Customer']['konda'])));
                $this->set('price_list', $price_list);
            } else {
                $this->Session->setFlash('User can not be found. Please select right user.', 'default', array(), 'failure');
                $this->redirect(array('controller' => 'users', 'action' => 'listCustomers', 'admin' => true));
            }
        }
    }


    public function addressBook()
    {
        $this->checkFrontUserSession();
        $this->loadModel('Address');
        $options = array();
        $options['joins'] = array(
            array('table' => 'locations',
                'alias' => 'Location',
                'type' => 'LEFT',
                'conditions' => array(
                    'Location.land1 = Address.country',
                    'Location.bland = Address.bland',
                    'Location.ort01 = Address.city',
                )
            )
        );
        $options['conditions'] = array('Address.user_id' => $this->Session->read('uid'));
        $options['contain'] = false;
        $options['fields'] = array('Address.*', 'Location.*');
        $this->set('addresses', $this->Address->find('all', $options));
    }


    public function addAddress($id = null)
    {
        $this->checkFrontUserSession();
        $this->loadModel('Address');

        App::import('model', 'Location');
        $country = new Location();
        $countries = $country->find('list', array('fields' => array('land1', 'landx')));
        $this->set('countries', $countries);
        $this->set('states', array());
        $this->set('cities', array());

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
        } else {
            $this->set('edit', false);
            if ($id != null) {
                $data = $this->Address->read('', $id);
                if ($data) {
                    $this->request->data = $data;
                    $this->set('edit', true);
                    $this->set('states', $country->find('list', array('conditions' => array('Location
                    .bland' => $data['Address']['bland']),
                        'fields' => array('bland', 'bezei'))));
                    $this->set('cities', $country->find('list', array('conditions' => array('Location
                    .ort01' => $data['Address']['city']),
                        'fields' => array('ort01', 'bezei_city'))));
                }
            }
        }
    }


    function deleteAddress($id = null)
    {
        $this->checkFrontUserSession();
        $this->loadModel('Address');
        if ($id != null) {
            $data = $this->Address->find('first', array('conditions' => array('Address.id' => $id,
                'Address.user_id' => $this->Session->read('uid'))));
            if (!empty($data)) {
                $this->Address->delete($data['Address']['id']);
                $this->Session->setFlash('Address has been deleted successfully.', 'default', array(),
                    'success');
                $this->redirect(array('controller' => 'users', 'action' => 'addressBook'));
            } else {
                $this->Session->setFlash('Please select the right address to delete.', 'default', array(),
                    'failure');
                $this->redirect(array('controller' => 'users', 'action' => 'addressBook'));
            }
        } else {
            $this->Session->setFlash('Please select the right address to delete.', 'default', array(),
                'failure');
            $this->redirect(array('controller' => 'users', 'action' => 'addressBook'));
        }
    }


    public function changePassword()
    {
        $this->checkFrontUserSession();
        if ($this->request->data) {
            $this->User->set($this->request->data);
            $data = $this->User->find('first', array('conditions' => array('User.id' => $this->Session->read('uid'))));
            if ($data['User']['password'] != $this->request->data['User']['old']) {
                $this->User->validationErrors['old'][0] = 'Please fill correct old password';
            }
            if ($this->User->validates()) {
                $this->User->id = $this->Session->read('uid');
                $this->request->data['User']['password'] = $this->request->data['User']['new'];
                $this->User->save($this->request->data);
                $this->Session->setFlash('Password changed successfully', 'default', array(), 'success');
            }
        }
    }

    public function test()
    {
        App::import('Vendor', 'Ups');
        $upsAccessnumber = "4CBE3F3AFCC21495";
        $upsUsername = " UnbrakoAlvin";
        $upsPassword = "abc@USA123";
        $upsShippernumber = "";
        $ups = new Ups($upsAccessnumber, $upsUsername, $upsPassword, $upsShippernumber);
        $serviceMethod = "03"; //"Ground"=>"03"
        $fromZip = "90210";
        $toZip = "20770";
        $length = "0";
        $width = "0";
        $height = "0";
        $weight = "5";
        $reponse = $ups->getRate($serviceMethod, $fromZip, $toZip, $length, $width, $height, $weight);
        echo "<pre>";
        print_r($reponse);
        die;
    }
    
    
    public function test1()
    {
        App::import('Vendor', 'Authorize');
        $loginId = "3Ax3yP4Y";
        $transactionKey = "22h5MdpH6ym46DCx";
        $serviceUrl = "https://test.authorize.net/gateway/transact.dll";
        //$serviceUrl = "https://secure.authorize.net/gateway/transact.dll"; For LIVE
        $authorize = new Authorize($serviceUrl, $loginId, $transactionKey, "AUTH_CAPTURE");
        $reponse = $authorize->makePayment(
                    array('first_name'=>"Harish",
                          'last_name'=>"Kumar",
                          'address'=>"6704 Ivy Lane",
                          'state'=>"WA",
                          'zip_code'=>"20770",
                          'cc_number'=>'4111111111111111',
                          'exp_date'=>'0315',
                          'amount'=>'19.19')
                    );
        echo "<pre>";
        print_r($reponse);
        die;
    }
}
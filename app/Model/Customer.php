<?php
/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
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
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('AppModel', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class Customer extends AppModel
{
    public $actsAs = array('Containable');
    public $belongsTo = array(
        'Country' => array(
            'className' => 'Country',
            'foreignKey' => 'country'
        ),
        'State' => array(
            'className' => 'State',
            'foreignKey' => 'bland'
        ),
        'City' => array(
            'className' => 'City',
            'foreignKey' => 'city'
        ),
        'PaymentTerm' => array(
            'className' => 'PaymentTerm',
            'foreignKey' => 'pmnttrms'
        ),
        'BusinessType' => array(
            'className' => 'BusinessType',
            'foreignKey' => 'brsch'
        )
    );

    public $validate = array(
        'cus_dob' => array(
            'required' => array(
                'on' => 'create',
                'rule' => 'notEmpty',
                'message' => 'Please enter Date of Birth',
                'required' => true,
                'last' => true
            ),
        ),
        'firstname' => array(
            'required' => array(
                'on' => 'create',
                'rule' => 'notEmpty',
                'message' => 'Please enter first name',
                'required' => true,
                'allowEmpty' => false,
                'last' => true
            ),
            'between' => array(
                'on' => 'create',
                'rule' => array('between', 3, 40),
                'message' => 'First Name length should be between 3 and 40 characters',
                'required' => true,
                'allowEmpty' => false,
                'last' => true
            ),
        ),
        'lastname' => array(
            'required' => array(
                'on' => 'create',
                'rule' => 'notEmpty',
                'message' => 'Please enter last name',
                'required' => true,
                'allowEmpty' => false,
                'last' => true
            ),
            'between' => array(
                'on' => 'create',
                'rule' => array('between', 3, 40),
                'message' => 'Last Name length should be between 3 and 40 characters',
                'required' => true,
                'allowEmpty' => false,
                'last' => true
            ),
        ),
        'e_mail' => array(
            'email' => array(
                'on' => 'create',
                'rule' => 'email',
                'message' => 'Please enter valid email address',
                'required' => true,
                'allowEmpty' => false,
                'last' => true
            ),
            'unique' => array(
                'on' => 'create',
                'rule' => 'isUnique',
                'message' => 'This Email already exist',
                'required' => true,
                'allowEmpty' => false,
                'last' => true
            ),
        ),
        'house_no' => array(
            'required' => array(
                'on' => 'create',
                'rule' => 'notEmpty',
                'message' => 'Please enter House No',
                'required' => true,
                'allowEmpty' => false,
                'last' => true
            ),
        ),
        'street' => array(
            'required' => array(
                'on' => 'create',
                'rule' => 'notEmpty',
                'message' => 'Please enter street address',
                'required' => true,
                'allowEmpty' => false,
                'last' => true
            ),
        ),
        'city' => array(
            'required' => array(
                'on' => 'create',
                'rule' => 'notEmpty',
                'message' => 'Please enter city',
                'required' => true,
                'allowEmpty' => false,
                'last' => true
            ),
        ),
        'district' => array(
            'required' => array(
                'on' => 'create',
                'rule' => 'notEmpty',
                'message' => 'Please enter district',
                'required' => true,
                'allowEmpty' => false,
                'last' => true
            ),
        ),
        'postl_cod1' => array(
            'required' => array(
                'on' => 'create',
                'rule' => 'notEmpty',
                'message' => 'Please enter correct postal code',
                'required' => true,
                'allowEmpty' => false,
                'last' => true
            ),
        ),
        'bland' => array(
            'required' => array(
                'on' => 'create',
                'rule' => 'notEmpty',
                'message' => 'Please select region',
                'required' => true,
                'allowEmpty' => false,
                'last' => true
            ),
        ),
        'country' => array(
            'required' => array(
                'on' => 'create',
                'rule' => 'notEmpty',
                'message' => 'Please select country',
                'required' => true,
                'allowEmpty' => false,
                'last' => true
            ),
        ),
        'yr_name' => array(
            'required' => array(
                'on' => 'create',
                'rule' => 'notEmpty',
                'message' => 'Please enter your name',
                'required' => true,
                'allowEmpty' => false,
                'last' => true
            ),
        ),
        'yr_email' => array(
            'email' => array(
                'on' => 'create',
                'rule' => 'email',
                'message' => 'Please enter valid email address',
                'required' => true,
                'allowEmpty' => false,
                'last' => true
            ),
        ),
    );
}

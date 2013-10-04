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
class Address extends AppModel
{
    public $actsAs = array('Containable');
    public $virtualFields = array('address_list' => 'concat(Address.street, " - ", Address.postl_cod1)');

    public $belongsTo = array(
        'User',
        'Country' => array(
            'className' => 'Country',
            'foreignKey' => 'country'
        ),
        'State' => array(
            'className' => 'State',
            'foreignKey' => 'bland'
        ),
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
    );
}

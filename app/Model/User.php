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
class User extends AppModel
{
    public $hasOne = array(
        'Customer' => array(
            'className' => 'Customer',
        )
    );

    public $actsAs = array('Containable');

    public $validate = array(
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
        'password' => array(
            'required' => array(
                'on' => 'create',
                'rule' => array('minLength', '5'),
                'message' => 'Password minimum 5 characters long',
                'required' => true,
                'allowEmpty' => false,
                'last' => true
            ),
        ),
    );

    public $validateLogin = array(
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
        'password' => array(
            'required' => array(
                'rule' => 'notEmpty',
                'message' => 'Please enter your Password',
                'alloeEmpty' => false,
                'last' => true
            ),
        ),
    );

    public $validateForgotPassword = array(
        'e_mail' => array(
            'email' => array(
                'on' => 'create',
                'rule' => 'email',
                'message' => 'Please enter valid email address',
                'required' => true,
                'allowEmpty' => false,
                'last' => true
            ),
        )
    );

    public $validateChangePassword = array(
        'new' => array(
            'required' => array(
                'on' => 'create',
                'rule' => array('minLength', '5'),
                'message' => 'Password minimum 5 characters long',
                'required' => true,
                'allowEmpty' => false,
                'last' => true
            ),
        ),
        'confirm' => array(
            'required' => array(
                'rule' => array('equalToField', 'new'),
                'message' => 'New and confirm password should be same',
                'required' => true,
                'last' => true
            ),
        )
    );

    public $validateAdminChangePassword = array(
        'new' => array(
            'required' => array(
                'on' => 'create',
                'rule' => array('minLength', '5'),
                'message' => 'Password minimum 5 characters long',
                'required' => true,
                'allowEmpty' => false,
                'last' => true
            ),
        ),
        'confirm' => array(
            'required' => array(
                'rule' => array('equalToField', 'new'),
                'message' => 'New and confirm password should be same',
                'required' => true,
                'last' => true
            ),
        )
    );

    public $validateAdminLogin = array();

    function equalToField($field = array(), $compare_field = null)
    {
        foreach ($field as $key => $value) {
            $v1 = $value;
            $v2 = $this->data[$this->name][$compare_field];
            if ($v1 !== $v2) {
                return FALSE;
            } else {
                continue;
            }
        }
        return TRUE;
    }
}

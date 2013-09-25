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
class ProductType extends AppModel {
    public $primaryKey = 'matkl';
    public $actsAs = array('Containable');

    public $belongsTo = array(
        'ProductGroup' => array(
            'className' => 'ProductGroup',
            'foreignKey' => 'parentgroupid'
        ));
}

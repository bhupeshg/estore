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
class ProductGroup extends AppModel {
    public $primaryKey = 'parentgroupid';
    public $actsAs = array('Containable');
}

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
class ProductAvailability extends AppModel {
    public $useTable = 'product_availability';
    public $primaryKey = 'matnr';
    public $actsAs = array('Containable');
}

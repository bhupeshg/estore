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
class Plant extends AppModel {
    public $primaryKey = 'werks';
    public $actsAs = array('Containable');
}

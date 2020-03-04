<?php
/**
 * Created by PhpStorm.
 * User: Wishaal
 * Date: 9/1/2016
 * Time: 11:04 AM
 */

require 'php/vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;


$capsule = new Capsule;

$settings = array(
    'driver' => 'informix',
    'host' => '',
    'service' => '',
    'database' => '',
    'username' => '',
    'password' => '',
    'server' => 'devshm',
    'protocol' => 'onsoctcp'
);



$capsule->addConnection($settings,'informix');
$manager = $capsule->getDatabaseManager();
$manager->setDefaultConnection('informix');

// Make this Capsule instance available globally via static methods... (optional)
$capsule->setAsGlobal();

// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
$capsule->bootEloquent();

$input = Illuminate\Http\Request::createFromGlobals();
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Apns extends Public_Controller {

    function apns() {
        parent::Public_Controller();
        
        include dirname(__FILE__) . '/../libraries/dbconnect.php';
        include dirname(__FILE__) . '/../libraries/applepushns.php';
        $db = DbConnect::getInstance();
        $db->connect();
        $db->show_errors();
        $apns = new ApplePushNS($db, $_GET);
        die('Done');
        
    }

}
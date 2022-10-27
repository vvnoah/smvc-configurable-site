<?php

/**
 * sMVC model class
 *
 * @author     sedasoft stefan.segers@telenet.be
 * @package    sMVC\core
 * @version    1.0.0
 * @since      Class available since Release 1.0.0
 */

namespace core;

class Model {
    public Database $db;
    
    public function __construct() {
        if (isset(Application::$app->db)){
            $this->db = Application::$app->db;
        }
    }
    
    public function loadData($data) {
        
    }
    
    public function validate() {
        
    }
}

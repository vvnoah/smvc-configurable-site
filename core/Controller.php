<?php

/**
 * sMVC controller class
 *
 * @author     sedasoft stefan.segers@telenet.be
 * @package    sMVC\core
 * @version    1.0.0
 * @since      Class available since Release 1.0.0
 */


namespace core;

class Controller {
    
    public View $view;
    
    public function __construct() {
        /* instantiate view library */
        $this->view = new View();
    }
    
}

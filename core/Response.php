<?php
/**
 * sMVC response class
 *
 * @author     sedasoft stefan.segers@telenet.be
 * @package    sMVC\core
 * @version    1.0.0
 * @since      Class available since Release 1.0.0
 */

namespace core;

class Response {
    
    public function statusCode(int $code)
    {
        http_response_code($code);
    }
    
}

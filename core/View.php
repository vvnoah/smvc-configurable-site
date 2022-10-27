<?php
/**
 * sMVC view class
 *
 * @author     sedasoft stefan.segers@telenet.be
 * @package    sMVC\core
 * @version    1.0.0
 * @since      Class available since Release 1.0.0
 */

namespace core;
use Exception;

class View {

    public $viewVars = array();
    
    protected function renderView($view, array $viewVars = null)
    {   
        extract($this->viewVars);
        if(isset($viewVars)){
            extract($viewVars);
        }
        try {
            $file = Application::$APP_DIR."/views/$view.php";
            if (file_exists($file) && is_readable($file)) {
                include_once $file;
            }else{
                throw new Exception("$file view does not exists or is not readable.");
            }
        } catch (Exception $e) {
            echo $e->getMessage();     
        }
    }
    
    public function assign($viewVar, $value=null)
    {
        if(isset($value)){
            $this->viewVars[$viewVar] = $value;
        }else{
            foreach($viewVar as $key => $value){
                if(is_int($key)){
                    $this->viewVars[] = $value;
                }else{
                    $this->view_vars[$key] = $value;
                }
            }
        }
    }
    
    public function fetch($view, array $viewVars = null)
    {
        ob_start();
        $this->renderView($view, $viewVars);
        return ob_get_clean();
    }
    
    public function display($view, array $params = null) {
        return $this->renderView($view, $params);     
    }
}

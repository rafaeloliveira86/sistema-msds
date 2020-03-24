<?php
declare(strict_types = 1);

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Email;
use Phalcon\Forms\Element\Select;
use Phalcon\Forms\Element\Password;

class AdminController extends ControllerBase {
    public function initialize() {
        $this->assets->addCss('css/bootstrap-custom.css');
        $this->assets->addJs('js/main.js');
        $this->view->appTitle = "Mayara Souza - Designer de Sobrancelhas";
    }
    
    public function indexAction() {
        
    }
}
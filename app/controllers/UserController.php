<?php
declare(strict_types = 1);

class UserController extends ControllerBase {
    public function initialize() {
        if (!$this->session->has('IS_LOGIN')) {
            return $this->response->redirect('auth');
        } else {
            $this->assets->addCss('css/bootstrap-custom.css');
            $this->assets->addJs('js/main.js');
            $this->view->appTitle = "Mayara Souza Estética";
        }
    }

    public function selectAction() {
        $this->assets->addCss('css/dashboard.css');
        $this->view->headerIcon = "fa fa-list";
        $this->view->headerTitle = "Listar Usuários";
        $this->view->headerText = "Tabela de listagem de usuários cadastrados";
        $user = User::find();
        return $this->view->render('user', 'select', ['users' => $user]);
    }

    public function notFoundAction() {
        return $this->view->render('error', '404');
    }
}
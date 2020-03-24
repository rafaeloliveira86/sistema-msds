<?php
declare(strict_types = 1);

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Email;
use Phalcon\Forms\Element\Select;
use Phalcon\Forms\Element\Password;

class UserController extends ControllerBase {
    public function initialize() {
        $this->assets->addCss('css/bootstrap-custom.css');
        $this->assets->addJs('js/main.js');
        $this->view->appTitle = "Mayara Souza Estética";
    }

    public function indexAction() {
        if ($this->session->has('IS_LOGIN')) {
            return $this->view->render('admin', 'index');
        } else {
            $this->loginAction();
        }
    }

    public function loginAction() {
        $this->assets->addCss('css/login.css');
        $form = new Form();
        $form->add(new Email('email'));
        $form->add(new Password('password'));
        
        /*$email = $this->request->getPost('email_address', 'email');
                $password = $this->request->getPost('password');
                $login = User::authenticate($email, $password);
                if ($login) {
                    // Success! Set your session data here
                } else {
                    // Login Failed!
                    $this->flash->error('Invalid Login Details');
                }*/
        
        return $this->view->render('user', 'login', ['form' => $form]);
    }

    public function createAction() {
        $this->assets->addCss('css/dashboard.css');
        $this->view->headerIcon = "fa fa-pencil";
        $this->view->headerTitle = "Cadastro de Usuário";
        $this->view->headerText = "Preencha os campos do formulário abaixo";
        $form = new CreateForm();
        if ($this->request->isPost()) {
            if (!$form->isValid($this->request->getPost())) {
                $class = 'danger';
                foreach ($form->getMessages() as $message) {
                    $this->flash->error($message->getMessage());
                }
            } else {
                $user = new User();
                $user->assign($this->request->getPost(), [
                    'first_name',
                    'last_name',
                    'username',
                    'email_address',
                    //'password',
                    'status_id',
                    'created_by_user_id',
                    'created_at'
                ]);
                //Criptografia de Senha (MD5 ou SHA)
                $password = $this->request->getPost('password');
                $user->password = $this->security->hash($password);
                $success = $user->save();
                if ($success) {
                    $class = 'success';
                    $message = "Cadastro de usuário realizado com sucesso!";
                } else {
                    $class = 'danger';
                    $message = "Desculpe, os seguintes problemas foram gerados:<br>".implode('<br>', $user->getMessages());
                }
            }
        }
        return $this->view->render('user', 'create', ['form' => $form, 'class' => $class, 'message' => $message]);
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

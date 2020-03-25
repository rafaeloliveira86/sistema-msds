<?php
declare(strict_types = 1);

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Email;
use Phalcon\Forms\Element\Select;
use Phalcon\Forms\Element\Password;
use Phalcon\Mvc\Model\Manager;

class AuthController extends ControllerBase {
    private $dataResponse;

    public function initialize() {
        $this->assets->addCss('css/bootstrap-custom.css');
        $this->assets->addJs('js/main.js');
        $this->view->appTitle = "Mayara Souza Estética";
    }

    public function indexAction() {
        $this->assets->addCss('css/login.css');
        $form = new LoginForm();
        if ($this->request->isPost()) {
            if (!$form->isValid($this->request->getPost())) {                
                foreach ($form->getMessages() as $message) {
                    //$this->flash->error($message->getMessage());
                    $this->dataResponse = [
                        'class' => 'danger',
                        'message' => $message->getMessage()
                    ];
                }
            } else {
                $dataLogin = $this->request->getPost();
                $emailAddress = $dataLogin["email_address"];
                $password = sha1($dataLogin["password"]);
                $user = User::findFirst([
                    'conditions' => 'email_address = ?1 and password = ?2',
                    'bind' => [
                        1 => $emailAddress,
                        2 => $password
                    ]
                ]);
                if ($user) {
                    if ($user->status_id === 1) { //1 = Excluído
                        $this->dataResponse = [
                            'class' => 'danger',
                            'message' => 'Usuário não encontrado'
                        ];
                    } if ($user->status_id === 3) { //3 = Bloqueado
                        $this->dataResponse = [
                            'class' => 'danger',
                            'message' => 'Usuário Bloqueado'
                        ];
                    } else {
                        //Iniciar Sessão
                        $this->session->start();
                        $this->session->set('AUTH_ID', $user->id);
                        $this->session->set('AUTH_FIRST_NAME', $user->first_name);
                        $this->session->set('AUTH_LAST_NAME', $user->last_name);
                        $this->session->set('AUTH_USERNAME', $user->username);
                        $this->session->set('AUTH_EMAIL_ADDRESS', $user->email_address);
                        $this->session->set('AUTH_STATUS', $user->status_id);
                        $this->session->set('AUTH_CREATED_AT', $user->created_at);
                        $this->session->set('AUTH_UPDATED_AT', $user->updated_at);
                        $this->session->set('IS_LOGIN', 1);
                        //Redirecionar
                        $userAccess = UserAccess::findFirst([
                            'conditions' => 'user_id = ?1 and user_access_type_id = ?2 or '.
                                            'user_id = ?1 and user_access_type_id = ?3 or '.
                                            'user_id = ?1 and user_access_type_id = ?4 or '.
                                            'user_id = ?1 and user_access_type_id = ?5 or '.
                                            'user_id = ?1 and user_access_type_id = ?6',
                            'bind' => [
                                1 => $user->id,
                                2 => 1, //1 = Administrador
                                3 => 2, //2 = Gerente
                                4 => 3, //3 = Funcionário
                                5 => 4, //Aluno
                                6 => 5, //Cliente
                            ]
                        ]);
                        switch ($userAccess->user_access_type_id) {
                            case 1: //Administrador
                                return $this->response->redirect('user/select');
                                break;
                            case 2: //Gerente
                                return $this->response->redirect('user/select');
                                break;
                            case 3: //Funcionário
                                return $this->response->redirect('user/select');
                                break;
                            case 4: //Aluno
                                return $this->response->redirect('user/select');
                                break;
                            case 5: //Cliente
                                return $this->response->redirect('user/select');
                                break;
                        }
                    }
                } else {
                    $this->dataResponse = [
                        'class' => 'danger',
                        'message' => 'Login ou senha incorreto'
                    ];
                }
            }
        }
        return $this->view->render('user', 'login', ['form' => $form, 'alert' => $this->dataResponse]);
    }

    public function createAction() {
        $this->assets->addCss('css/dashboard.css');
        $this->view->headerIcon = "fa fa-pencil";
        $this->view->headerTitle = "Cadastro de Usuário";
        $this->view->headerText = "Preencha os campos do formulário abaixo";
        $form = new CreateForm();
        if ($this->request->isPost()) {
            if (!$form->isValid($this->request->getPost())) {
                foreach ($form->getMessages() as $message) {
                    //$this->flash->error($message->getMessage());
                    $this->dataResponse = [
                        'class' => 'danger',
                        'message' => $message->getMessage()
                    ];                    
                }
            } else {
                $user = new User();
                $userAccess = new UserAccess();
                $userDAO = new UserDAO();
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
                $password = $this->request->getPost('password');
                $user->password = sha1($password);
                //$user->password = $this->security->hash($password);                
                $userSuccess = $user->save();
                $getLastId = $userDAO->getLastId();
                $userAccess->user_id = $getLastId;
                $userAccess->user_access_type_id = 5;
                $userAccess->created_by_user_id = 1;
                $userAccess->created_at = date('Y-m-d 00:00:00');
                $userAccessSuccess = $userAccess->save();
                if ($userSuccess && $userAccessSuccess) {                    
                    $this->dataResponse = [
                        'class' => 'success',
                        'message' => 'Cadastro de usuário realizado com sucesso!'
                    ];
                } else {
                    $this->dataResponse = [
                        'class' => 'danger',
                        'message' => "Desculpe, os seguintes problemas foram gerados:<br>".implode('<br>', $user->getMessages())
                    ];
                }
            }
        }
        return $this->view->render('user', 'create', ['form' => $form, 'alert' => $this->dataResponse]);
    }
    
    public function logoutAction() {
        $this->session->destroy();
        return $this->response->redirect('auth');
    }
}
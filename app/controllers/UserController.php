<?php
declare(strict_types = 1);

class UserController extends ControllerBase {
    private $dataResponse;
    private $result;
    
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
    
    public function updateAction() {
        $this->view->headerTitle = "Atualizar Usuários";
        $this->view->headerText = "Formulário de edição de usuário";
        //User Access Type
        $userAccessType = UserAccess::findFirst([
            'conditions' => 'user_id = ?1 and user_access_type_id = ?2 or '.
                            'user_id = ?1 and user_access_type_id = ?3',
            'bind' => [
                1 => $this->session->get('AUTH_ID'),
                2 => 1,
                3 => 2
            ]
        ]);
        $form = new UpdateForm();
        if ($this->request->isPost()) {
            //Carregar Modal
            $userDAO = new UserDAO();
            $param = [
                'id' => $this->request->getPost('id')
            ];
            $userData = $userDAO->selectReg($param);
            //Validar Formulário
            if (!$form->isValid($this->request->getPost())) {
                foreach ($form->getMessages() as $message) {
                    //$this->flash->error($message->getMessage());
                    $this->dataResponse = [
                        'class' => 'danger',
                        'message' => $message->getMessage()
                    ];                    
                }
            } else {
                /********** Save User **********/
                $user = new User();                
                $userDAO = new UserDAO();                
                $user->assign($this->request->getPost(), [
                    'first_name',
                    'last_name',
                    'username',
                    'email_address',
                    //'password',
                    'status_id',
                    'user_access_type_id',
                    'update_by_user_id',
                    'updated_at'
                ]);
                $password = $this->request->getPost('password');
                $user->password = sha1($password);
                //$user->password = $this->security->hash($password);                
                //$userSuccess = $user->save();
                $userSuccess = $userDAO->updateReg($user);
                
                /********** Save User Access **********/
                /*$userAccess = new UserAccess();
                $getLastId = $userDAO->getLastId();
                $userAccess->user_id = $getLastId;
                if (!$this->session->has('IS_LOGIN')) {
                    $userAccess->user_access_type_id = 5;
                    $updateByUserId = $this->request->getPost('update_by_user_id');
                    $userAccess->update_by_user_id = $updateByUserId;
                } else {
                    //1 = Administrador / 2 = Gerente
                    if (($userAccessType->user_access_type_id === 1) || ($userAccessType->user_access_type_id === 2)) {
                        $userAccessTypeId = $this->request->getPost('user_access_type_id');
                        $userAccess->user_access_type_id = $userAccessTypeId;
                        $userAccess->update_by_user_id = $this->session->get('AUTH_ID');
                    } else {
                        $userAccess->user_access_type_id = 5;
                        $userAccess->update_by_user_id = $this->session->get('AUTH_ID');
                    }
                }                
                $userAccess->updated_at = date('Y-m-d 00:00:00');                
                $userAccessSuccess = $userAccess->save();*/
                
                /********** Validação **********/
                if ($userSuccess) {                    
                    $this->dataResponse = [
                        'class' => 'success',
                        'message' => 'Cadastro de usuário realizado com sucesso!'
                    ];
                    return TRUE;
                } else {
                    $this->dataResponse = [
                        'class' => 'danger',
                        'message' => "Desculpe, os seguintes problemas foram gerados:<br>".implode('<br>', $user->getMessages())
                    ];
                }
            }
        }        
        //$this->view->disable();
        return $this->view->render('user', 'update', ['form' => $form, 'userAccessType' => $userAccessType->user_access_type_id, 'alert' => $this->dataResponse, 'user' => $userData]);
    }
    
    public function deleteAction() {
        $userDAO = new UserDAO();
        if ($this->request->isPost()) {
            $param = [
                'id' => $this->request->getPost('id'),
                'status_id' => 1,
                'update_by_user_id' => $this->session->get('AUTH_ID'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
            $userDAO->deleteReg($param);
        }
    }

    public function notFoundAction() {
        return $this->view->render('error', '404');
    }
}
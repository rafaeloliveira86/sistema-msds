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
    
    public function showModalAction() {
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
        if ($this->request->isPost()) {
            //Carregar Modal e popular formulário update            
            $param = ['id' => $this->request->getPost('id')];
            $userDAO = new UserDAO();
            $userData = $userDAO->selectReg($param);
            //Validar Formulário
            $form = new UpdateForm();
        }
        return $this->view->render('user', 'update', [
            'form' => $form,
            //'userAccessType' => $userAccessType->user_access_type_id, 
            //'alert' => $this->dataResponse, 
            'user' => $userData,
            'id' => $param['id']
        ]);
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
        if ($this->request->isPost()) {
            $user = new User();
            $userDAO = new UserDAO();
            $user->id = $this->request->getPost('id');
            $user->first_name = $this->request->getPost('first_name');
            $user->last_name = $this->request->getPost('last_name');
            $user->username = $this->request->getPost('username');
            $user->email_address = $this->request->getPost('email_address');
            $user->password = sha1($this->request->getPost('password'));
            $user->status_id = $this->request->getPost('status_id');
            //$user->user_access_type_id = $this->request->getPost('user_access_type_id');
            $user->update_by_user_id = $this->request->getPost('update_by_user_id');
            $user->updated_at = $this->request->getPost('updated_at');
            $formData = [
                'id' => $user->id,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'username' => $user->username,
                'email_address' => $user->email_address,
                'password' => $user->password,
                'status_id' => $user->status_id,
                //'user_access_type_id' => $user->user_access_type_id,
                'update_by_user_id' => $user->update_by_user_id,
                'updated_at' => $user->updated_at
            ];
            $updateSuccess = $userDAO->updateReg($formData);
            if ($updateSuccess) {
                $this->dataResponse = [
                    'class' => 'success',
                    'message' => 'Atualização de cadastro de usuário realizado com sucesso!'
                ];
            } else {
                $this->dataResponse = [
                    'class' => 'danger',
                    'message' => "Desculpe, os seguintes problemas foram gerados:<br>".implode('<br>', $user->getMessages())
                ];
            }
        }
        return $this->response->redirect('select');
    }

    public function deleteUpdateAction() {
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
    
    public function deleteAction() {
        $userDAO = new UserDAO();
        if ($this->request->isPost()) {
            $param = [
                'id' => $this->request->getPost('id')
            ];
            $userDAO->deleteRegUser($param);
            $userDAO->deleteRegUserAccess($param);
        }
    }

    public function notFoundAction() {
        return $this->view->render('error', '404');
    }
}
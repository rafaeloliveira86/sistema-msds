<?php
declare(strict_types = 1);

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Email;
use Phalcon\Forms\Element\Select;
use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Check;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Submit;
use Phalcon\Validation\Validator\Identical;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Confirmation;
use Phalcon\Validation\Validator\Email as EmailValidate;
use Phalcon\Validation\Validator\StringLength;

class CreateForm extends Form {
    public function initialize() {
        $this->setEntity($this);
        //Nome
        $first_name = new Text('first_name');
        $first_name->addValidator(new PresenceOf(['message' => 'O campo (Nome) é obrigatório']));
        $this->add($first_name);
        //Sobrenome
        $last_name = new Text("last_name");
        $last_name->addValidator(new PresenceOf(['message' => 'O campo (Sobrenome) é obrigatório']));
        $this->add($last_name);
        //Nome de Usuário
        $username = new Text("username");
        $username->addValidator(new PresenceOf(['message' => 'O campo (Nome de Usuário) é obrigatório']));
        $this->add($username);
        //E-mail
        $email_address = new Email("email_address");
        $email_address->addValidators([
            new PresenceOf(['message' => 'O campo (E-mail) é obrigatório']),
            new Confirmation(['message' => "Os E-mails não correspondem", 'with' => 'email_address_confirm']),
            new EmailValidate(['message' => 'O E-mail informado é inválido'])
        ]);
        $this->add($email_address);
        //Confirmar E-mail
        $email_address_confirm = new Email("email_address_confirm");
        $email_address_confirm->addValidator(new PresenceOf(['message' => 'O campo (Confirmar E-mail) é obrigatório']));
        $this->add($email_address_confirm);
        //Senha
        $password = new Password('password');
        $password->addValidators([
            new StringLength(['min' => 6, 'messageMinimum' => 'O campo (Senha) exige o mínimo de 6 caracteres']),
            new StringLength(['max' => 8, 'messageMaximum' => 'O campo (Senha) exige o máximo de 8 caracteres']),
            new PresenceOf(['message' => 'O campo (Senha) é obrigatório']),
            new Confirmation(['message' => "As senhas não correspondem", 'with' => 'password_confirm'])
        ]);
        $this->add($password);
        //Confirmar Senha
        $password_confirm = new Password('password_confirm');
        $password_confirm->addValidators([
            new StringLength(['min' => 6, 'messageMinimum' => 'O campo (Confirmar Senha) exige o mínimo de 6 caracteres']),
            new StringLength(['max' => 8, 'messageMaximum' => 'O campo (Confirmar Senha) exige o máximo de 8 caracteres']),
            new PresenceOf(['message' => 'O campo (Confirmar Senha) é obrigatório'])
        ]);
        $this->add($password_confirm);
        //Status
        $status_id = new Select('status_id',
            Status::find(), [
                'emptyText' => 'Selecionar',
                'emptyValue' => '',
                'useEmpty' => true,
                'using' => [
                    'id',
                    'status_name',
                ],
            ]
        );
        $status_id->addValidator(new PresenceOf(['message' => 'O campo (Status) é obrigatório']));
        $this->add($status_id);
        //Nível de Acesso
        $user_access_type_id = new Select('user_access_type_id',
            UserAccessType::find(), [
                'emptyText' => 'Selecionar',
                'emptyValue' => '',
                'useEmpty' => true,
                'using' => [
                    'id',
                    'access_name',
                ],
            ]
        );
        //$user_access_type_id->addValidator(new PresenceOf(['message' => 'O campo (Nível de Acesso) é obrigatório']));
        $this->add($user_access_type_id);
        //Criado por usuário
        if (!$this->session->has('IS_LOGIN')) {
            $create_by_user_id = new Hidden('created_by_user_id', ['value' => 1]);
        } else {
            $userId = $this->session->get('AUTH_ID');
            $create_by_user_id = new Hidden('created_by_user_id', ['value' => $userId]);
        }
        $this->add($create_by_user_id);
        //Data de Cadastro
        $created_at = new Hidden('created_at', ['value' => date('Y-m-d H:i:s')]);
        $this->add($created_at);
    }
}
?>
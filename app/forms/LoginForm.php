<?php
declare(strict_types = 1);

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Email;
use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Submit;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email as EmailValidate;
use Phalcon\Validation\Validator\StringLength;

class LoginForm extends Form {
    public function initialize() {
        $this->setEntity($this);
        //E-mail
        $email_address = new Email("email_address");
        $email_address->addValidators([
            new PresenceOf(['message' => 'O campo (E-mail) é obrigatório']),
            new EmailValidate(['message' => 'O E-mail informado é inválido'])
        ]);
        $this->add($email_address);
        //Senha
        $password = new Password('password');
        $password->addValidators([
            new StringLength(['min' => 6, 'messageMinimum' => 'O campo (Senha) exige o mínimo de 6 caracteres']),
            new StringLength(['max' => 8, 'messageMaximum' => 'O campo (Senha) exige o máximo de 8 caracteres']),
            new PresenceOf(['message' => 'O campo (Senha) é obrigatório'])
        ]);
        $this->add($password);
    }
}
?>
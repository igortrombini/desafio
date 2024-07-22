<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Authentication\PasswordHasher\DefaultPasswordHasher;
use Cake\Log\Log;

class UsersTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('users');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
        $this->addBehavior('Timestamp');
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name', 'Name is required');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmptyString('email', 'Email is required');

        $validator
            ->scalar('login')
            ->maxLength('login', 255)
            ->requirePresence('login', 'create')
            ->notEmptyString('login', 'Login is required');

        $validator
            ->scalar('password')
            ->maxLength('password', 255)
            ->requirePresence('password', 'create')
            ->notEmptyString('password', 'Password is required')
            ->add('password', 'custom', [
                'rule' => function ($value, $context) {
                    return (bool)preg_match('/^(?=.*[A-Z])(?=.*[!@#$&*]).{8,}$/', $value);
                },
                'message' => 'Password must be at least 8 characters long and contain at least one uppercase letter and one special character.'
            ]);

        $validator
            ->scalar('reset_token')
            ->maxLength('reset_token', 255)
            ->allowEmptyString('reset_token');

        return $validator;
    }

    public function validationEditProfile(Validator $validator): Validator
    {
        $validator = $this->validationDefault($validator);
        $validator->allowEmptyString('password');
        return $validator;
    }

    public function validationResetPassword(Validator $validator): Validator
    {
        $validator
            ->scalar('password')
            ->maxLength('password', 255)
            ->requirePresence('password', 'create')
            ->notEmptyString('password', 'Password is required')
            ->add('password', 'custom', [
                'rule' => function ($value, $context) {
                    return (bool)preg_match('/^(?=.*[A-Z])(?=.*[!@#$&*]).{8,}$/', $value);
                },
                'message' => 'Password must be at least 8 characters long and contain at least one uppercase letter and one special character.'
            ]);

        return $validator;
    }

    public function validationPassword(Validator $validator): Validator
    {
        $validator
            ->scalar('password')
            ->maxLength('password', 255)
            ->requirePresence('password', 'create')
            ->notEmptyString('password', 'Password is required')
            ->add('password', 'custom', [
                'rule' => function ($value, $context) {
                    return (bool)preg_match('/^(?=.*[A-Z])(?=.*[!@#$&*]).{8,}$/', $value);
                },
                'message' => 'Password must be at least 8 characters long and contain at least one uppercase letter and one special character.'
            ]);

        return $validator;
    }

    protected function _setPassword($password)
    {
        Log::debug('Senha recebida: ' . $password); // Adiciona log da senha recebida

        if (strlen($password) > 0) {
            $hashedPassword = (new DefaultPasswordHasher())->hash($password);
            Log::debug('Senha com hash: ' . $hashedPassword); // Adiciona log da senha com hash
            return $hashedPassword;
        }
    }
}

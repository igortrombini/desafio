<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Event\EventInterface;
use Cake\Mailer\Mailer;
use Cake\Utility\Security;
use Cake\Routing\Router;

class UsersController extends AppController
{
    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        // Adiciona ações que não requerem autenticação
        $this->Authentication->addUnauthenticatedActions(['login', 'add', 'forgotPassword', 'resetPassword']);
    }

    // Ação de login
    public function login()
    {
        // Permite métodos GET e POST
        $this->request->allowMethod(['get', 'post']);
        // Obtém o resultado da autenticação
        $result = $this->Authentication->getResult();

        // Se o usuário está autenticado, redireciona para a página inicial
        if ($result->isValid()) {
            $target = $this->Authentication->getLoginRedirect() ?? '/';
            return $this->redirect($target);
        }
        // Exibe erro se o login falhar
        if ($this->request->is('post') && !$result->isValid()) {
            $this->Flash->error('Invalid username or password');
        }
    }

    // Ação de logout
    public function logout()
    {
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {
            $this->Authentication->logout();
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }
    }

    // Ação de registro
    public function add()
    {
        // Cria uma nova entidade de usuário
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            // Preenche a entidade com os dados do formulário
            $user = $this->Users->patchEntity($user, $this->request->getData());
            // Tenta salvar o usuário
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'login']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        // Passa a entidade de usuário para a view
        $this->set(compact('user'));
    }

    // Ação de esqueci a senha
    public function forgotPassword()
    {
        if ($this->request->is('post')) {
            $email = $this->request->getData('email');
            $user = $this->Users->findByEmail($email)->first();
            if ($user) {
                $resetToken = Security::hash(Security::randomBytes(25));
                $user->reset_token = $resetToken;
                if ($this->Users->save($user)) {
                    // Envia o email com o link de redefinição de senha
                    $mailer = new Mailer('default');
                    $mailer->setTo($user->email)
                           ->setSubject('Redefinição de senha')
                           ->deliver('Clique no link para redefinir sua senha: ' . Router::url(['controller' => 'Users', 'action' => 'resetPassword', $resetToken], true));
                    $this->Flash->success('Por favor, verifique seu email para o link de redefinição de senha.');
                } else {
                    $this->Flash->error('Erro ao salvar o token de redefinição.');
                }
            } else {
                $this->Flash->error('Email não encontrado.');
            }
        }
    }

    // Ação de redefinição de senha
    public function resetPassword($token = null)
    {
        if ($token) {
            $user = $this->Users->findByResetToken($token)->first();
            if ($user) {
                if ($this->request->is(['post', 'put'])) {
                    $user = $this->Users->patchEntity($user, $this->request->getData(), ['validate' => 'resetPassword']);
                    $user->reset_token = null;
                    if ($this->Users->save($user)) {
                        $this->Flash->success('Sua senha foi alterada.');
                        return $this->redirect(['action' => 'login']);
                    }
                    $this->Flash->error('Erro ao redefinir a senha.');
                }
            } else {
                $this->Flash->error('Token inválido ou expirado.');
            }
        }
    }
}

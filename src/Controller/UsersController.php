<?php
declare(strict_types=1);

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\EventInterface;
use Cake\Mailer\Mailer;
use Cake\Utility\Security;
use Cake\Routing\Router;
use Cake\Log\Log;
use Authentication\PasswordHasher\DefaultPasswordHasher;

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
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {
            return $this->redirect($this->Authentication->getLoginRedirect() ?? '/users/dashboard');
        }

        if ($this->request->is('post') && !$result->isValid()) {
            $this->Flash->error('Invalid username or password');
            Log::debug('Invalid login attempt with email: ' . $this->request->getData('email'));
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
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            Log::debug('Dados do formulário de registro: ' . json_encode($data));

            if (!empty($data['photo']->getClientFilename())) {
                $fileName = $data['photo']->getClientFilename();
                $uploadPath = 'uploads/photos/';
                $uploadFile = WWW_ROOT . $uploadPath . $fileName;

                if (!file_exists(WWW_ROOT . $uploadPath)) {
                    mkdir(WWW_ROOT . $uploadPath, 0777, true);
                }

                $data['photo']->moveTo($uploadFile);
                $data['photo'] = $uploadPath . $fileName;
            } else {
                $this->Flash->error(__('Unable to upload the photo.'));
            }

            $user = $this->Users->patchEntity($user, $data);
            Log::debug('Dados do usuário após patchEntity: ' . json_encode($user));

            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'login']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
                Log::debug('User save errors: ' . json_encode($user->getErrors()));
            }
        }
        $this->set(compact('user'));
    }

    // Ação de esqueci a senha
    public function forgotPassword()
{
    if ($this->request->is('post')) {
        $email = $this->request->getData('email');
        $user = $this->Users->findByEmail($email)->first();
        if ($user) {
            $resetToken = Security::hash(Security::randomBytes(25), 'sha256', true);
            Log::debug('Generated reset token: ' . $resetToken); // Adiciona um log para depuração

            $user->reset_token = $resetToken;
            if ($this->Users->save($user)) {
                $resetUrl = Router::url([
                    'controller' => 'Users',
                    'action' => 'resetPassword',
                    'token' => $resetToken
                ], true);

                Log::debug('Reset URL: ' . $resetUrl); // Adiciona um log para depuração

                $emailMessage = 'Clique no link para redefinir sua senha: ' . $resetUrl;
                Log::debug('Email Message: ' . $emailMessage); // Log do corpo do e-mail

                $mailer = new Mailer('default');
                $mailer->setTo($user->email)
                       ->setSubject('Redefinição de senha')
                       ->deliver($emailMessage);

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
                $data = $this->request->getData();
                $user = $this->Users->patchEntity($user, $data, ['validate' => 'resetPassword']);
                if ($this->Users->save($user)) {
                    // Resetar o token apenas após a alteração da senha ser salva com sucesso
                    $user->reset_token = null;
                    $this->Users->save($user);
                    $this->Flash->success('Sua senha foi alterada.');
                    return $this->redirect(['action' => 'login']);
                }
                $this->Flash->error('Erro ao redefinir a senha.');
            }
            $this->set(compact('token')); // Pass the token to the view
        } else {
            $this->Flash->error('Token inválido ou expirado.');
            return $this->redirect(['action' => 'forgotPassword']);
        }
    } else {
        $this->Flash->error('Token de redefinição de senha não fornecido.');
        return $this->redirect(['action' => 'forgotPassword']);
    }
}

    // Ação de dashboard (Área do usuário)
    public function dashboard()
    {
        $this->set('user', $this->Authentication->getIdentity());
    }

    // Ação de editar perfil
    public function editProfile()
    {
        $user = $this->Users->get($this->Authentication->getIdentity()->getIdentifier());

        if ($this->request->is(['post', 'put'])) {
            $data = $this->request->getData();

            if (!empty($data['photo']->getClientFilename())) {
                $fileName = $data['photo']->getClientFilename();
                $uploadPath = 'uploads/photos/';
                $uploadFile = WWW_ROOT . $uploadPath . $fileName;

                if (!file_exists(WWW_ROOT . $uploadPath)) {
                    mkdir(WWW_ROOT . $uploadPath, 0777, true);
                }

                $data['photo']->moveTo($uploadFile);
                $data['photo'] = $uploadPath . $fileName;
            } else {
                unset($data['photo']);
            }

            $user = $this->Users->patchEntity($user, $data);

            if ($this->Users->save($user)) {
                $this->Flash->success('Profile updated successfully.');
                // Atualiza a foto de perfil na sessão do usuário
                $identity = $this->Authentication->getIdentity()->getOriginalData();
                $identity['photo'] = $user->photo;
                $this->Authentication->setIdentity($identity);
                return $this->redirect(['action' => 'dashboard']);
            } else {
                $this->Flash->error('Unable to update profile. Please try again.');
            }
        }

        $this->set('user', $user);
    }

    // Ação de editar senha
    public function editPassword()
    {
        $user = $this->Users->get($this->Authentication->getIdentity()->getIdentifier());

        if ($this->request->is(['post', 'put'])) {
            $data = $this->request->getData();

            // Verificar se a senha atual está correta
            $hasher = new DefaultPasswordHasher();
            if (!$hasher->check($data['current_password'], $user->password)) {
                $this->Flash->error('A senha atual está incorreta.');
            } elseif ($data['new_password'] !== $data['confirm_password']) {
                $this->Flash->error('A nova senha e a confirmação da nova senha não coincidem.');
            } else {
                // Atualizar a senha
                $user = $this->Users->patchEntity($user, ['password' => $data['new_password']], ['validate' => 'password']);
                if ($this->Users->save($user)) {
                    $this->Flash->success('Senha alterada com sucesso.');
                    return $this->redirect(['action' => 'dashboard']);
                } else {
                    $this->Flash->error('Não foi possível alterar a senha. Por favor, tente novamente.');
                }
            }
        }

        $this->set('user', $user);
    }
}

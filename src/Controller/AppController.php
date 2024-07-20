<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\EventInterface;

class AppController extends Controller
{
    public function initialize(): void
    {
        parent::initialize();

        // Carrega componentes necessários
        $this->loadComponent('Flash');
        
        // Carrega o componente de autenticação
        $this->loadComponent('Authentication.Authentication');

        /*
         * Enable the following component for recommended CakePHP form protection settings.
         * see https://book.cakephp.org/4/en/controllers/components/form-protection.html
         */
        //$this->loadComponent('FormProtection');
    }

    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        // Adiciona ações que não requerem autenticação
        $this->Authentication->addUnauthenticatedActions(['login', 'add', 'forgotPassword', 'resetPassword']);
    }
}

<?php
return [
    'Authentication' => [
        // Redireciona usuários não autenticados para a página de login
        'unauthenticatedRedirect' => '/users/login',
        // Verifica a autenticação durante a inicialização do controller
        'checkAuthIn' => 'Controller.initialize',
    ],
];

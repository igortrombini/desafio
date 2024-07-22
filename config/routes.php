<?php
use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;

return function (RouteBuilder $routes): void {
    $routes->setRouteClass(DashedRoute::class);

    $routes->scope('/', function (RouteBuilder $builder): void {
        $builder->connect('/', ['controller' => 'Pages', 'action' => 'display', 'home']);
        $builder->connect('/pages/*', 'Pages::display');

        $builder->connect('/users/forgot-password', ['controller' => 'Users', 'action' => 'forgotPassword']);
        $builder->connect('/users/reset-password/:token', 
            ['controller' => 'Users', 'action' => 'resetPassword'], 
            ['pass' => ['token'], 'token' => '[a-zA-Z0-9]+']
        );
        $builder->connect('/users/edit-profile', ['controller' => 'Users', 'action' => 'editProfile']);
        $builder->connect('/users/dashboard', ['controller' => 'Users', 'action' => 'dashboard']);
        $builder->connect('/users/change-password', ['controller' => 'Users', 'action' => 'changePassword']);

        $builder->fallbacks();
    });
};

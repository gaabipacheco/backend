<?php
use Slim\App;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

return function (App $app) {

    $app->get('/', function (
        ServerRequestInterface $request,
        ResponseInterface $response
    ) {
        $response->getBody()->write('Hello, World!');

        return $response;
    });

    $app->get('/home',\App\Action\HomeAction::class)->setName('home');

    //Operações com usuário
    $app->post('/users',\App\Action\UserCreateAction::class); //envio por body

    $app->get('/users',\App\Action\UserListAction::class); //sem envio

    //http://localhost/slim0902aula/users/3
    $app->get('/users/{id}',\App\Action\UserReaderAction::class); //envio por path

    $app->put('/users',\App\Action\UserUpdateAction::class); //envio por body

    //http://localhost/slim0902aula/users/3
    $app->delete('/users/{id}',\App\Action\UserDeleteAction::class); //envio por path

};

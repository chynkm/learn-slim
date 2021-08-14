<?php

namespace App\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 *
 */
final class HomeAction
{
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        $result = ['error' => ['message' => 'Validation failed']];
        $response->getBody()->write(json_encode($result));

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(422);


        // $response->getBody()->write(json_encode(['success' => true]));
        // return $response->withHeader('Content-Type', 'application/json');

        // $response->getBody()->write('Hello Slim!');
        // return $response;
    }
}

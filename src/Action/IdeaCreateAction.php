<?php

namespace App\Action;

use App\Domain\Idea\Service\IdeaCreator;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class IdeaCreateAction
{
    private $ideaCreator;

    public function __construct(IdeaCreator $ideaCreator)
    {
        $this->ideaCreator = $ideaCreator;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface{
        // Collect input from the HTTP request
        $data = (array) $request->getParsedBody();

        // $repo = new IdeaCreator(new MySQLIdeaCreator()); // If no DI, then
        // Invoke the Domain with inputs and retain the result
        $ideaId = $this->ideaCreator->createIdea($data);

        // Transform the result into the JSON representation
        $result = [
            'idea_id' => $ideaId,
        ];

        // Build the HTTP response
        $response->getBody()->write((string) json_encode($result));

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(201);
    }
}

<?php

namespace App\Domain\Idea\Service;

use App\Domain\Idea\IdeaRepository;
use App\Exception\ValidationException;

final class IdeaCreator
{
    private $repository;

    public function __construct(IdeaRepository $repository)
    {
        $this->repository = $repository;
    }

    public function createIdea(array $data): int
    {
        // Input validation
        $this->validateNewIdea($data);

        // Insert user
        $ideaId = $this->repository->save($data);

        return $ideaId;
    }

    private function validateNewIdea(array $data): void
    {
        $errors = [];

        if (empty($data['title'])) {
            $errors['username'] = 'Input required';
        }
        if (empty($data['rating'])) {
            $errors['rating'] = 'Input required';
        }
        if (empty($data['author'])) {
            $errors['author'] = 'Input required';
        }

        if ($errors) {
            throw new ValidationException('Please check your input', $errors);
        }
    }
}

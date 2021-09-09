<?php

namespace App\Domain\Idea;

interface IdeaRepository
{
    public function save(array $idea); //both for create/update
    // delete
    // getById
}

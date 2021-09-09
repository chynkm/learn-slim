<?php

namespace App\Domain\Idea\Database;

use App\Domain\Idea\IdeaRepository;
use PDO;

class MySQLIdeaRepository implements IdeaRepository
{
    private $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(array $idea): int
    {
        $row = [
            'title' => $idea['title'],
            'rating' => $idea['rating'],
            'author' => $idea['author'],
        ];

        $sql = "INSERT INTO ideas SET
                title=:title,
                rating=:rating,
                author=:author;";

        $this->connection->prepare($sql)->execute($row);

        return (int) $this->connection->lastInsertId();
    }
}

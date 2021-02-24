<?php

namespace App\Domain\User\Repository;

use PDO;

class UserCreatorRepository
{
  private $connection;

  public function __construct(PDO $connection)
  {
    $this->connection = $connection;
  }

  public function insertUser(array $user): int //lastInsertedId.... a chave primária gerada.
  {
    $row = [
      'nome' => $user['nome'],
      'raca' => $user['raca'],
      'emaildono' => $user['emaildono'],
      'idade' => $user['idade'],
      'peso' => $user['peso'],
    ];

    $sql = "INSERT INTO users SET
            nome=:nome,
            raca=:raca,
            emaildono=:emaildono,
            idade=:idade,
            peso=:peso";

    $this->connection->prepare($sql)->execute($row);

    return (int) $this->connection->lastInsertId();
  }
}

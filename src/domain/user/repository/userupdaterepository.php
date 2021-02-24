<?php

namespace App\Domain\User\Repository;

use PDO;

class UserUpdateRepository
{
  private $connection;

  public function __construct(PDO $connection)
  {
    $this->connection = $connection;
  }

  public function updateUser(array $user): int //rowCount.... número de linhas afetadas...
  {
    $row = [
      'id' => $user['id'],
      'nome' => $user['nome'],
      'raca' => $user['raca'],
      'emaildono' => $user['emaildono'],
      'idade' => $user['idade'],
      'peso' => $user['peso'],
    
    ];

    $sql = "UPDATE users SET
            nome=:nome,
            raca=:raca,
            emaildono=:emaildono,
            idade=:idade,
            peso=:peso
            WHERE id=:id";

    $statement = $this->connection->prepare($sql);
    $statement->execute($row);

    return (int) $statement->rowCount();
  }
}

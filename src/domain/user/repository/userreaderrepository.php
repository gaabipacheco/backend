<?php

namespace App\Domain\User\Repository;

use PDO;
use App\Domain\User\Model\User;
use DomainException;

class UserReaderRepository
{
  private $connection;

  public function __construct(PDO $connection)
  {
    $this->connection = $connection;
  }

  public function getUserById(int $userId): User //retorna um objeto usuario
  {

    $sql = "SELECT id, nome, raca, emaildono, idade, peso FROM users WHERE id = :id;";
    $statement = $this->connection->prepare($sql);
    $statement->execute(['id' => $userId]);

    $row = $statement->fetch();

    // if(!$row) {
    //   throw new DomainException(sprintf('Usuário não encontrado: %s', $userId));
    // }

    $user = new User();
    $user->id = (int) $row['id'];
    $user->nome = (string) $row['nome'];
    $user->raca = (string) $row['raca'];
    $user->emaildono = (string) $row['emaildono'];
    $user->idade = (int) $row['idade'];
    $user->peso = (double) $row['peso'];

    return $user;

  }
}

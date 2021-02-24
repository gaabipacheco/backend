<?php

namespace App\Domain\User\Repository;

use PDO;
use App\Domain\User\Model\User;

class UserListRepository
{
  private $connection;

  public function __construct(PDO $connection)
  {
    $this->connection = $connection;
  }

  public function findAll()
  {

    $sql = "SELECT id, nome, raca, emaildono, idade, peso FROM users;";

    $statement = $this->connection->prepare($sql);
    $statement->execute();

    $rows = $statement->fetchAll();

    //galho.....
    $users = [];
    foreach($rows as $row) {
      $user = new User();

      $user->id = (int) $row['id'];
      $user->nome = (string) $row['nome'];
      $user->raca = (string) $row['raca'];
      $user->emaildono = (string) $row['emaildono'];
      $user->idade = (int) $row['idade'];
      $user->peso = (double) $row['peso'];

      $users[] = $user;
    }

    // $var_dump($users); //para testar.....
    return $users;

  }
}

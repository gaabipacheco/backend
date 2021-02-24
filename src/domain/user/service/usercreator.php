<?php

namespace App\Domain\User\Service;

use App\Domain\User\Repository\UserCreatorRepository;
use App\Exception\ValidationException;

final class UserCreator
{

    private $repository;

    public function __construct(UserCreatorRepository $repository)
    {
      $this->repository = $repository;
    }

    public function createUser(array $data): int //last inserted id
    {
      $this->validateNewUser($data);

      $userId = $this->repository->insertUser($data);

      return $userId;

    }

    private function validateNewUser(array $data): void
    {
      $errors = [];

      //validacao... é por nossa conta....
      // is_string, is_null, is_empty, is_array,
      // tratamento: colocar tudo em maiusculo... minusculo...
      // filter_var para testar email....
      // expressao regular....

      if(empty($data['nome'])) {
        $errors['nome'] = 'Precisa digitar o nome do pet';
      }

      if(empty($data['emaildono'])) {
        $errors['emaildono'] = 'Precisa digitar o email';
      } else if(filter_var($data['emaildono'], FILTER_VALIDATE_EMAIL) === false)  {
        $errors['emaildono'] = 'Email inválido!';
      }

      if($errors) {
        throw new ValidationException('Por favor verifique os dados digitados', $errors);
      }

    }

}

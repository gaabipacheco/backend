<?php

namespace App\Domain\User\Service;

use App\Domain\User\Repository\UserUpdateRepository;
use App\Exception\ValidationException;

final class UserUpdate
{

    private $repository;

    public function __construct(UserUpdateRepository $repository)
    {
      $this->repository = $repository;
    }

    public function updateUser(array $data): int //rowCount
    {
      $this->validateNewUser($data);


      $rowCount = $this->repository->updateUser($data);

      return $rowCount;

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
        $errors['nome'] = 'Precisa digitar o nome';
      }

      if(empty($data['emaildono'])) {
        $errors['emaildono'] = 'Precisa digitar o email do dono';
      } else if(filter_var($data['emaildono'], FILTER_VALIDATE_EMAIL) === false)  {
        $errors['emaildono'] = 'Email inválido!';
      }

      if($errors) {
        throw new ValidationException('Por favor verifique os dados digitados', $errors);
      }

    }

}

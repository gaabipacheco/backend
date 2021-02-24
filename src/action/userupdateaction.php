<?php

namespace App\Action;

use App\Domain\User\Service\UserUpdate;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class UserUpdateAction
{
  private $userUpdate;

  public function __construct(UserUpdate $userUpdate)
  {
    $this->userUpdate = $userUpdate;
  }

  public function __invoke(
    ServerRequestInterface $request,
    ResponseInterface $response
    ): ResponseInterface {

      // buscando dados do post com json
      $data = (array) $request->getParsedBody();

      $rowCount = $this->userUpdate->updateUser($data);

      $result = [
        'success' => $rowCount == 1 ? true : false
      ];

      $response->getBody()->write((string)json_encode($result));

      return $response
      ->withHeader('Content-Type', 'application/json')
      ->withStatus(200); //modificado...

    }
}

<?php
namespace App\Exceptions;

use Exception;
use Dingo\Api\Exception\Handler as DingoHandler;

class ApiExceptionsHandler extends DingoHandler
{
    public function handle(Exception $exception)
    {
        return parent::handle($exception);
    }
}
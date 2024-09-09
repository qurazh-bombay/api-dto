<?php
declare(strict_types = 1);

namespace App\Validator;

class Validator implements ValidatorInterface
{
    public function validate(array $data, array $constraints): bool
    {
        // логика валидации для входящих данных
        return true;
    }
}

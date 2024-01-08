<?php

namespace App\Exceptions\Request;

use App\Exceptions\BaseException;

class InvalidParameterException extends BaseException
{
    protected $statusCode = 422;
    protected $message = 'Invalid parameter';
}

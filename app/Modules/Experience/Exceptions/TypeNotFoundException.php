<?php

namespace App\Modules\Experience\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Throwable;

class TypeNotFoundException extends Exception
{
    private $types;

    public function __construct($types, $message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->types = $types;
    }

    public function render(): JsonResponse
    {
        return response()->json('The type you have requested cannot be found. Your available types are: ' . $this->getAvailableTypes(), 404);
    }

    private function getAvailableTypes(): string
    {
        return implode(', ', array_keys($this->types));
    }
}

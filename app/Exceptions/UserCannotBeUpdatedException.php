<?php

namespace App\Exceptions;

use Exception;

class UserCannotBeUpdatedException extends Exception
{
    public function render() {
        return response()->json(['error_message' => 'This user cannot be updated']);
    }
}

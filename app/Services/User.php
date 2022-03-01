<?php

namespace App\Services;

use App\Exceptions\UserCannotBeDeletedException;
use App\Exceptions\UserCannotBeUpdatedException;
use App\Models\User as UserModel;
use Carbon\Carbon;
use Exception;

class User
{
    public function update(UserModel $user, $params)
    {
        if (!$user->userDetails) {
            throw new UserCannotBeUpdatedException();
        }
        $user->userDetails->update([
            'first_name' => $params['first_name'] ?? $user->userDetails->first_name,
            'last_name' => $params['last_name'] ?? $user->userDetails->last_name,
            'phone_number' => $params['phone_number'] ?? $user->userDetails->phone_number
        ]);
        $user->update([
            'updated_at' => Carbon::now()
        ]);
        return $user;
    }

    public function delete(UserModel $user)
    {
        if ($user->userDetails) {
            throw new UserCannotBeDeletedException();
        }
        return $user->delete();
    }
}

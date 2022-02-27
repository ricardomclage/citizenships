<?php

namespace App\Services;

use App\Models\User as UserModel;
use Carbon\Carbon;

class User
{
    public function update(UserModel $user, $params)
    {
        if (!$user->userDetails) {
            abort(403, 'User has no details to be updated');
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
            abort(403, 'User cannot be deleted');
        }
        return $user->delete();
    }
}

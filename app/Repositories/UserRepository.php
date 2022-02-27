<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\User;

class UserRepository extends BaseRepository
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function getUsers($filters)
    {
        $users = $this->model->leftJoin('user_details', 'user_details.user_id', '=', 'users.id')
            ->leftJoin('countries', 'countries.id', '=', 'user_details.citizenship_country_id');

        $users = $this->applyFilters($filters, $users);

        return $users->select(
            'users.id',
            'users.email',
            'users.active',
            'users.created_at',
            'users.updated_at',
            'user_details.first_name',
            'user_details.last_name',
            'user_details.phone_number',
            'countries.name as country',
        )->get();
    }

    private function applyFilters($filters, $users)
    {
        if (!is_null($filters['active'])) {
            $users->where('active', $filters['active']);
        }

        if (!is_null($filters['country_id'])) {
            $users->where('user_details.citizenship_country_id', $filters['country_id']);
        }
        return $users;
    }
}

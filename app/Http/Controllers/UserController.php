<?php

namespace App\Http\Controllers;

use App\Services\User as UserService;
use App\Repositories\UserRepository;
use App\Models\User as UserModel;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userRepository;
    private $userService;

    public function __construct(
        UserRepository $userRepository,
        UserService $userService
    )
    {
        $this->userRepository = $userRepository;
        $this->userService = $userService;
    }

    public function index(Request $request)
    {
        $filters = [
            'country_id' => $request->get('countryId'),
            'active' => $request->get('active')
        ];

        $users = $this->userRepository->getUsers($filters);

        return $users;
    }

    public function update(Request $request, UserModel $user)
    {
        // if (empty($request->all())) {
        //     abort(400, "Empty Request");
        // }
        return $this->userService->update($user, $request->all());
    }

    public function delete(Request $request, UserModel $user)
    {
        return $this->userService->delete($user);
    }
}

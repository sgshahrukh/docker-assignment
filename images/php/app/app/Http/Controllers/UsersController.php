<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\todo\Domain\User\Exceptions\RegisterUserValidationException;
use App\todo\Domain\User\Exceptions\UserNotFoundException;
use App\todo\Domain\User\Service\ClearUserToken;
use App\todo\Domain\User\Service\LoginUser;
use App\todo\Domain\User\Service\RegisterUser;
use App\todo\Domain\User\Service\TokenGenerator;
use Faker\Provider\Uuid;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('cors');
    }

    public function store(Request $request)
    {
        try {
            $uuid = Uuid::uuid();
            $token = TokenGenerator::generate();
            (new RegisterUser($token))->registerUser($uuid, $request->toArray());

            return response()->json(['status' => 'success', 'uuid' => $uuid, 'token' => 'Bearer ' . $token], 201);
        } catch (RegisterUserValidationException $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }

    public function login(Request $request, LoginUser $loginUser)
    {
        try {
            $user = $loginUser->login($request->input('email', ''), $request->input('password', ''));
        } catch (\Throwable $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 401);
        }

        return response()->json([
            'status' => 'success',
            'user' => $user,
            'token' => 'Bearer ' . $user->api_token
        ]);
    }

    public function logout(Request $request)
    {
        try {
            (new ClearUserToken)->clear($request->toArray());
        } catch (UserNotFoundException $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }

        return response()->json(['status' => 'success'], 200);
    }
}

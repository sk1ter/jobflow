<?php


namespace App\Http\Controllers\API\v1;


use App\Http\Requests\API\v1\FormRequests\AuthRequest;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AuthController
{
    public function index(AuthRequest $request)
    {
        $data = $request->validated();
        if (Auth::attempt($data)) {
            /**
             * @var User $user
             */
            $user = User::where('login', $request->login)->get()->first();

            return response()->json([
                'success' => true,
                'message' => '',
                'errors' => [],
                'data' => [
                    'token' => $user->createToken(Str::uuid())->plainTextToken
                ]
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Login or password incorrect',
            'errors' => [
                'login' => 'Login or password incorrect'
            ],
            'data' => null
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}

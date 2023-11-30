<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Register;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Register $request)
    {
        try {
            $data = $request->validated();
            $data['password'] = Hash::make($data['password']);
            $data['status'] = User::ACTIVE;
            // $data['package_id'] = decodeID($data['package_id']);

            // create user
            $user = User::create($data);

            // create wallet
            $user->createDefaultWallet();

            // assign role
            $customerRole = Role::findByName('customer');
            $user->assignRole($customerRole);

            // generate token
            $token = $user->createToken('postman')->plainTextToken;

            return $this->response([
                'success' => true,
                'message' => __('auth.success_registered'),
                'data' => [
                    'user' => $user,
                    'token' => $token,
                ],
            ]);
        } catch (\Throwable $th) {
            return  $this->response(buildErrorResponse($th));
        }
    }
}

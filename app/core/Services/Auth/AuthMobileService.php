<?php

namespace App\Core\Services\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthMobileService extends AuthService {

    public function login(array $data) {

        $rep = parent::login($data);
        

        if ($rep) {
            $user = Auth::user();
            return response()->json([
                'data' => $user,
                'token' => $user->createToken('API Token')->plainTextToken,
                'message' => 'Success',
            ]);
        }

        return response()->json([
            'message' => 'Invalid credentials',
        ], 401);
    }
}
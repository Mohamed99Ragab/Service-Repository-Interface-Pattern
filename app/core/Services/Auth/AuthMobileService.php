<?php

namespace App\Core\Services\Auth;

class AuthMobileService extends AuthService {

    public function login(array $data) {
        $rep = parent::login($data);

        if ($rep) {
            return response()->json([
                'data' => $rep,
                'message' => 'Success',
            ]);
        }

        return response()->json([
            'message' => 'Invalid credentials',
        ], 401);
    }
}
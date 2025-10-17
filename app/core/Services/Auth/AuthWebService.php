<?php

namespace App\Core\Services\Auth;

class AuthWebService extends AuthService {

    public function login(array $data) {
        $rep = parent::login($data);

        if ($rep) {
            return redirect()->route('dashboard');
        }

        return redirect()->back()->with('error', 'Invalid credentials');
    }

    
}
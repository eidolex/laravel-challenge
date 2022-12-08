<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Resources\LoginResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        $user = User::query()
            ->where('email', $request->email)
            ->firstOrFail();

        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'status'  => 404,
                'message' => 'Invalid credentials'
            ]);
        }

        return new LoginResource($user);
    }
}

<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\api\BaseController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends BaseController
{
    public function register(Request $request){
        $input = $request->all();
        $profileImagePath = null;
        
        $validator = Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'string'],
            'profile_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        if($validator->fails())
            return $this->sendError('Validation Error.', $validator->errors());

        if (request()->hasFile('profile_image')) {
            $profileImagePath = request()->file('profile_image')->store('profile_images', 'public');
        }
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'actived' => 0,
            'role' => $request->role,
            'profile_picture' => $profileImagePath,
            'email_confirmed' => 0,
            'remember_token' => Str::random(10),
        ]);

        $user->sendEmailVerificationNotification(); // Envía el correo de verificación

        return $this->sendResponse($user, "User created successfully");
    }
}

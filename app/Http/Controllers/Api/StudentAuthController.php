<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class StudentAuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'student_code' => 'required',
            'password' => 'required',
            'remember_me' => 'sometimes|boolean',
        ]);

        if ($validator->fails()) {
            return sendError(__('messages.validation_error'), $validator->errors());
        }

        $user = User::where('id', $request->student_code)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'password' => ['The provided credentials are incorrect.'],
            ]);
        }

        $remember = $request->input('remember_me', false);

        Auth::login($user, $remember);

        $user['token'] = $user->createToken('API Token')->plainTextToken;

        return sendResponse([$user], __('messages.login_successful'));
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        $user->tokens()->delete();

        return sendResponse([], __('messages.logout_success'));
    }

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return sendError('Validation error occurred.', $validator->errors());
        }

        $user = $request->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return sendError('Current password does not match.');
        }

        $user->forceFill([
            'password' => Hash::make($request->new_password),
        ])->save();

        return sendResponse([], 'Password updated successfully.');
    }
}

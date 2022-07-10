<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     *
     * Create User
     *
     * @param Request $request
     * @param User
     *
     */
    public function createUser(Request $request)
    {
        try {
            //Validated

            $validateUser = Validator::make($request->all(),
                [
                    'name' => 'required',
                    'email' => 'required|email|unique:users,email',
                    'password' => 'required'
                ]);

            if($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'error' => $validateUser->errors()
                ], 401);
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            return response()->json([
                'status' => true,
                'message' => 'User created Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);

        }catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);

        }

    }

    public function loginUser(Request $request)
    {
        try {
            //Validated

            $validateUser = Validator::make($request->all(),
                [
                    //'name' => 'required',
                    'email' => 'required|email',
                    'password' => 'required'
                ]);

            if($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'error' => $validateUser->errors()
                ], 401);
            }

            if(!Auth::attempt($request->only(['email','password']))){
                return response()->json([
                    'status' => false,
                    'message' => 'Email & password does not match with our record',
                    'error' => $validateUser->errors()
                ], 401);
            }

            $user = User::where('email', $request['email'])->first();
            $user = Auth::user();
         /*   $authToken = $user->createToken("API_TOKEN")->plainTextToken;*/

            /*  return response()->view('welcome',[
                  'status' => true,
                  'message' => 'User logged In Successfully',
                  'authToken' => $authToken,
                  'user' => $user
              ], 200);*/

            return response()->json([
                'status' => true,
                'message' => 'User logged In Successfully',
                'authToken' => $user->createToken("API TOKEN")->plainTextToken,
                'user' => $user
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);

        }

    }

    public function logout(Request $request) {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logged out'
        ];
    }

}

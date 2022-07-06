<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Response;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * Create User
     * @param Request $request
     * @param User
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

    /*    public function login(Request $request)
        {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $user = Auth::user();
                $success =  $user->createToken('API_TOKEN')->plainTextToken;
                $success =  $user->name;

                $response_c = new Response(view('change'));
                $response_c->withCookie(cookie('name', $success, 60));
                 return $response_c;

                $response = new \Illuminate\Http\Response(view('change'));
                $response->withCookie(cookie('API_TOKEN', $success,60));

                return $this->sendResponse($success, 'User login successfully.');

            } else {
                return $this->sendError('Unauthorized.', ['error' => 'Unauthorized'],401);
            }
        }*/



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

            /* return response()->view('welcome',[
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

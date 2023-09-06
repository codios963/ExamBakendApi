<?php

namespace App\Http\Controllers\Dashboard;


use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\LoginResource;
use App\Http\Resources\UserResource;
use App\Models\Code;
use App\Models\Collage;
use App\Models\User;
use App\Traits\ApiResponseTrait;
use App\Traits\AuthTrait;
use Illuminate\Support\Str;
use App\Services\RegisterUserServiceInterface;
use App\Services\RegisterUserService;


class AuthController extends Controller
{
    use ApiResponseTrait;
    
    private $registrationService;

    public function __construct(RegisterUserServiceInterface $registrationService)
    {
        $this->registrationService = $registrationService;
    }
   

    public function login(LoginRequest $request)
    {
        
            $user = User::with('codes.collage')->where('username', $request->username)->first();
    
            if (!$user || $user->codes->value != $request->code) {
                return $this->notfoundResponse('Invalid Credentials');
            }
    
            $token = $user->createToken('auth_token')->plainTextToken;
    
            return redirect()->route('dash.index');
       
    }

    public function logout()
    {
       
        auth()->user()?->tokens->delete();
            
            return redirect()->route('home');
        
    }

   
}

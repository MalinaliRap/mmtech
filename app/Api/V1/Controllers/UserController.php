<?php

namespace App\Api\V1\Controllers;

use App\Http\Controllers\Controller;
use Domains\User\Models\User;
use Domains\User\Managers\UserManager;
use Domains\User\Repositories\UserRepository;
use Freelabois\LaravelQuickstart\Traits\Crudable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
class UserController extends Controller
{
    use Crudable;

    public function __construct(UserManager $userManager, UserRepository $userRepository){
      $this->setup($userManager, $userRepository);
    }

   public function login(Request $request)
   {
   
      $loginData = $request->validate([
         'email' => 'email|required',
         'password' => 'required'
      ]);

      if (!Auth::attempt($loginData)) {
         return response(['message' => 'Credenciais Inválidas'], 401);
      }

      $user = Auth::user(); 
      $success['token'] =  $user->createToken('MMTech')->accessToken; 
     
      return response(['user' => Auth::user(), 'access_token' => $success['token']]);

   }

   public function logout(Request $request){
      dd(Auth::check());
      if (Auth::check()) {
         $user = Auth::user()->token();
         $user->revoke();
         return response(['message' => 'logout realizado com sucesso']);
      }

      return response(['message' => 'Erro ao realizar logout']);
   }
}

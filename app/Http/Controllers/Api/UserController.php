<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
  public function changePassword(Request $request){
    $user = User::where('email', $request->email)->first();
    if($user){
      $user->password = bcrypt($request->password);
      $user->save();
      return $this->successResponse($user, 'Contraseña Modificada.');
    }
    return $this->errorResponse('Este usuario no existe.', 404);
  }
}

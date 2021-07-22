<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
  public function changePassword(Request $request){
    $user = User::where('email', $request->email)->first();
    if($request->withConfirm){
      if(!Hash::check($request->actual_password, $user->password)){
        return $this->errorResponse('La contraseña actual es incorrecta.', 400);
      }
    }

    if($user){
      $user->password = bcrypt($request->password);
      $user->save();
      return $this->successResponse($user, 'Contraseña Modificada.');
    }
    return $this->errorResponse('Este usuario no existe.', 404);
  }

  public function update(Request $request, $id){
    $user = User::find($id);
    if($user){
      $user->fill($request->all());
      $user->save();
      return $this->successResponse($user, 'Datos Modificados');
    }
    return $this->errorResponse('Usuario no encontrado', 404);
  }

  public function actualizarImagen(Request $request){
    $user = User::find($request->id);
    if($user){

      if($request->file('image')){
        if($user->image){
          $separacion = explode("/",$user->image);
          $image = $separacion[3].'/'.$separacion[4];
          Storage::disk('public')->exists($image) ? Storage::disk('public')->delete($image) : ''; 
        }
        
        $path = Storage::disk('public')->put('img_perfiles', $request->file('image'));
        $user->fill(['image' => asset($path)])->save();
        return $this->successResponse($user, 'Datos Modificados');
      }
      return $this->errorResponse('Oops... hubo un error, vuelve a intentarlo', 401);
    }
    return $this->errorResponse('Usuario no encontrado', 404);
  }
}

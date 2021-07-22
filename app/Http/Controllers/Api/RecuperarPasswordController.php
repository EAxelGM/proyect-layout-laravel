<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\RecuperarPassword;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendCodeRecuperarPassword as SCRP;

class RecuperarPasswordController extends Controller
{
    public function sendEmail(Request $request){
        $user = User::where('email', $request->email)->first();
        if($user){
            $code = rand(100000, 999999);
            $create_new_code = RecuperarPassword::where('email', $user->email)->first();
            if($create_new_code){
                $create_new_code->code = $code;
                $create_new_code->save();
            }else{
                $create_new_code = RecuperarPassword::create([
                    'email' => $user->email,
                    'code' => $code,
                ]);
            }
            Mail::to($user->email)->send(new SCRP($user, $create_new_code));
            return $this->successResponse(null, 'correo enviado, revise su bandeja de entrada.');
        }
        return $this->errorResponse('Este correo no existe.', 404);
    }

    public function verifyCode(Request $request){
        $is_correct = RecuperarPassword::where([
            ['code', $request->code],
            ['email', $request->email]
        ])->first();
        if($is_correct){
            $is_correct->delete();
            return $this->successResponse(null, 'Verificado, puede modificar su nueva contraseña.');
        }
        return $this->errorResponse('Codigo incorrecto', 403, $is_correct);
    }
}

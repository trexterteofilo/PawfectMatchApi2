<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
   public function register(){
    return response ([
        'message'=> 'Api is working'
    ],200);
   }
}

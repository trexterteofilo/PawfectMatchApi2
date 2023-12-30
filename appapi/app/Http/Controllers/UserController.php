<?php

namespace App\Http\Controllers;

use App\Models\User; // Add this line to import the User model
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    /**
     * Gets users except yourself
     *
     * @return JsonResponse
     */


    // public function index(): JsonResponse
    // {
    //     $users = User::where('id', '!=', auth()->user()->id)->get();
    //     return $this->success($users);
    // }
        public function index(): JsonResponse
        {
            $users = User::wherenot('userID', auth()->user()->userID)->get();
            return $this->success($users);
        }
}

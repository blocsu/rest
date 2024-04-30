<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use App\Models\User;


class UserController extends Controller
{
    public function list() {
        return User::paginate();
    }

    public function show($id) {
        return User::findOrFail($id);
    }
    
    public function store($login, Request $req) {
        $user = new User;
        $user->login = $login;
        $user->password = $req->input('password');
        if($user->save()) {
            return redirect('user/' . $user->id);
        }
        return Response(['result' => 'error'], HttpResponse::HTTP_BAD_GATEWAY);
    }
}

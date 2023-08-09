<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;

class UserAuth extends Controller {
    function userlogin(Request $req) {

        $data = $req->input();

        $getUser = Users::where([
                                ['username', '=', $data['account']],
                                ['password', '=', $data['password']]//,
                                //['approver', '!=', null ]
                            ])->get();

        if( count($getUser) != 0 ) {

            $req->session()->put('account',$data['account']);
            $req->session()->put('empno',$getUser[0]->empno);
            $req->session()->put('name',($getUser[0]->name.' '.$getUser[0]->surname));
            $req->session()->put('department',$getUser[0]->department);
            $req->session()->put('level',$getUser[0]->level);
            
        }

        return redirect('/main');
    }
}
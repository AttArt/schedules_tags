<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Public_dept; 

use App\Models\Users; 

class RegisterController extends Controller {

    public function index()
    {
        $data['dept'] = Public_dept::all(); 
        return view('meetingplanner.register', compact('data'));

    }

    public function show(Request $request)
    {
       
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'userno' => 'required',
            'dept' => 'required',
            'firstN' => 'required',
            'lastN' => 'required',
            'username' => 'required',
            'password' => 'required', 
        ]);

        try {
            $user = new Users;
            $user->empno = $request->userno;
            $user->department = $request->dept;
            $user->name = $request->firstN;
            $user->surname = $request->lastN;
            $user->username = $request->username;
            $user->password = $request->password; 
            //Preuser / User
            $user->level = 'Preuser';
            // $user->approver = '';
      
            $user->save();
         
            $message = 'success';
            // return response()->json( $message);

            return redirect('/main');
            
        } catch(\Exception $e) {
            // \Log::error($e->getMessage());
            $message = 'error';
            return response()->json( $message);
        }
    }


    public function update(Request $request, $tableDB)
    {

    }

    public function destroy($content)
    {
 
    }

}
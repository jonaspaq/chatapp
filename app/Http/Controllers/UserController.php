<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash;
use App\Http\Requests\RegisterUser;
use App\User;
use DB;
use Illuminate\Support\MessageBag;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function tryLogin(Request $request)
    {   
        $data = $request->only('username', 'password');
        if(Auth::attempt($data))
        {
            return redirect()->route('home');
        }

        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('welcome');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $validated = [
            'name' => $request->name,
            'username' => $request->username,
            'password' => $request->password
        ];
        $validated['password'] = Hash::make($validated['password']);
        
        //return $validated;
        User::create($validated);
        
        return redirect()->route('login')->with('Success')->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function logout(){
        Auth::logout();
        return redirect()->route('welcome_page');
    }
    public function ajaxStore(Request $request)
    {   
        // $available = "Available";
        // $unavailable = "unAvailable";
        $existing = User::where('username', $request->username)->get();
        if($existing->count() >=1 ){
            return $existing->count();
        }else{
            return $existing->count();
        }
        // return $existing;
    }

    
}

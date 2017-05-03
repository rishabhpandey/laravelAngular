<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
    
    public function store(Request $request)
    {
        if($request->has('id')){
            User::where('id',$request->get('id'))->update($request->all());
        }else{
            User::create($request->all());
        }
      
    }
    
    public function show()
    {
        return User::all();
    }
    
    public function delete($id)
    {   
        User::find($id)->delete();
    }
    
    public function edit($id)
    {   
       return User::find($id);
    }
}

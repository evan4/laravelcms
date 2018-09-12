<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Requests\AccountUpdateRequest;

class HomeController extends BackendController
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
        return view('backend.home.index');
    }

    public function edit(Request $request)
    {
        $user = $request->user();
        return view('backend.home.edit', compact('user'));
    }

    public function update(AccountUpdateRequest $request)
    {
        $user = $request->user();
        $data = $request->all();
       
        if(!empty($request->input('password'))){
            $data['password'] = Hash::make($request->input('password'));
        }else{
            unset($data['password']);
        }
       
        $user->update($data);

        return redirect()->back()->with('message', 'Account was updatedc successfully!');
    }
}

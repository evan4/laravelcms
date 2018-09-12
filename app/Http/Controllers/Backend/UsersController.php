<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Requests\UserDestroyRequest;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Hash;

class UsersController extends BackendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('name')->paginate($this->limit);
        $usersCount = User::count();
        
        return view('backend.users.index', compact('users','usersCount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user)
    {
        $roles = Role::pluck('name','id');
        return view('backend.users.create', compact('user', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        dd($request->all());
        $data = $request->all();
        $data['password'] = Hash::make($request->input('password'));

        $user = User::create($data);
        $user->attachRole($request->input('role'));

        return redirect('/backend/users')->with('message', 'User was created successfully!');
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
        $user = User::findOrFail($id);
        $roles = Role::pluck('name','id');
        return view('backend.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $data = $request->all();
       
        if(!empty($request->input('password'))){
            $data['password'] = Hash::make($request->input('password'));
        }else{
            unset($data['password']);
        }
       
        $user->update($data);
        $user->detachRole($user->role);
        $user->attachRole($request->input('role'));

        return redirect('/backend/users')->with('message', 'User was updatedc successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserDestroyRequest $request, $id)
    {
        $user =User::findOrFail($id);
        $deleteOption = $request->delete_option;
        $delectUser = $request->delete_user;

        if($deleteOption == 'delete')
        {
            $user->posts()->withTrashed()->forceDelete();

        }
        elseif($deleteOption == 'attribute')
        {
            $user->posts()->update(['authorid' => $delectUser ]);
        }
        
        $user->delete();

        return redirect('/backend/users')->with('message', 'User was deleted successfully!');
    }

    public function confirm(UserDestroyRequest $request, $id)
    {
        $user =User::findOrFail($id);
        $users = User::where('id', '!=', $user->id)->pluck('name', 'id');
        
        return view('backend.users.confirm', compact('user', 'users'));
    }
}

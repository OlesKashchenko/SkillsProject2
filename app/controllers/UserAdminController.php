<?php

class UserAdminController extends BaseController {
 
    public function __construct()
    {
        //$this->beforeFilter('auth');
    }
 
    /**
     * Display a listing of the user.
     *
     * @return Response
     */
    public function index()
    {
        $users = User::all();
 
        return View::make('backend.user.index', ['users' => $users]);
    }
 
    /**
     * Show the form for creating a new user.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('backend.user.create');
    }
 
    /**
     * Store a newly created user in storage.
     *
     * @return Response
     */
    public function store()
    {
        $user = new User;
 
        $user->first_name = Input::get('first_name');
        $user->last_name  = Input::get('last_name');
        $user->email      = Input::get('email');
        $user->password   = Hash::make(Input::get('password'));
 
        $user->save();

        $user->makeEmployee('developer');
 
        return Redirect::to('/backend/user');
    }
 
    /**
     * Show the form for editing the specified user.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $user = User::find($id);
 
        return View::make('backend.user.edit', [ 'user' => $user ]);
    }
 
    /**
     * Update the specified user in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $user = User::find($id);
 
        $user->first_name = Input::get('first_name');
        $user->last_name  = Input::get('last_name');
        $user->email      = Input::get('email');
        if (Input::get('password') !== '' && Input::get('password') === Input::get('password_confirmation'))
        $user->password   = Hash::make(Input::get('password'));
 
        $user->save();
        $user->roles()->detach();
        $user->roles()->attach(Input::get('roles'));
 
        return Redirect::to('/backend/user');
    }
 
    /**
     * Remove the specified user from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        User::destroy($id);
 
        return Redirect::to('/backend/user');
    }
 
}
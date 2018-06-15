<?php

namespace App\Http\Controllers\Backend;

use App\Category;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\CategoryRequestUpdate;
use App\Http\Requests\UserDestroyRequest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends BackendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::latest()->paginate($this->limit);
        $usersCount = User::count();
        return view('layouts.backend.users.index', compact('users','usersCount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User();
        return view('layouts.backend.users.create',compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);
        User::create($request->all());
        return redirect('/backend/users')->with('message', "Usuário criado com sucesso");
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

        return view('layouts.backend.users.edit',compact('user'));

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
        User::findOrFail($id)
        ->update( !isset($request->password) ? $request->except(['password']) : $request->all() );
        return redirect('/backend/users')->with('message', "Usuário Atualizado com sucesso");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserDestroyRequest $request, $id)
    {
        $user = User::findOrFail($id);

        $deleteOption = $request->delete_option;
        $selectedUser = $request->selected_user;

        if($deleteOption == "delete"){
            $user->posts()->withTrashed()->forceDelete();
        }

        if($deleteOption == "atribuir"){
            $user->posts()->update(['author_id' => $selectedUser]);
        }

        $user->delete();
        return redirect('/backend/users')->with('message', "Usuário Deletado com sucesso");
    }

    public function confirm(UserDestroyRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $users = User::where('id', '!=', $user->id)->select('name','id')->get();
        return view('layouts.backend.users.confirm',compact('user','users'));
    }
}

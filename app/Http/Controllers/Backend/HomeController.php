<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\AccountUpdateRequest;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Http\Request;

class HomeController extends BackendController
{

    public function index()
    {
        return view('layouts.backend.home.index');
    }

    public function edit(Request $request){
        $user = $request->user();
        return view('layouts.backend.home.edit',compact('user'));
    }

    public function update(AccountUpdateRequest $request){
        $user = $request->user();
        $user->update( !isset($request->password) ? $request->except(['password']) : $request->all() );

        return redirect()->back()->with('message',"Conta atualizada");
    }
}

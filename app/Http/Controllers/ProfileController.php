<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        return view('profile');
    }
    public function update()
    {
        $user_id = auth()->id();
        $data = request()->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email'],
            'password'=>['nullable','confirmed'],
            'image' => ['mimes:jpeg,jpg,png'],
        ]);
        if(request()->has('password')){
            $data['password'] = Hash::make(request('password'));
        }
        if(request()->hasFile('image')){
            $path = request('image')->store('users');
            $data['image'] = $path;
        }
        User::findOrFail($user_id)->update($data);
        session()->flash('edit','The profile has been updated');

        return back();
    }
}

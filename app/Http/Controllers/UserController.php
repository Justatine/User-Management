<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserController extends Controller
{
    public function __invoke(){
        $users = User::orderBy('created_at', 'desc')->get();    

        $users->each(function($user) {
            $user->formatted_created_at = Carbon::parse($user->created_at)->format('F j, Y');
        });

        return view('pages.admin.dashboard',[
            'users' => $users   
        ]);
    }

    public function gotoClientPage(){
        return view('pages.client.home');
    }

    public function store(Request $request){
        $validated = $request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|string|unique:users,email',
            'password'=>'required|min:8',
            'role'=>'required|in:Admin,Client'
        ]);

        $validated['created_at'] = now();
        $addUser = User::insert($validated);
        if (!$addUser) {
            return redirect()->back()->withErrors(['add'=>'Unable to add user']);
        }

        return redirect()->back()->with(['success'=>true,'message'=>'User has been added']);
    }

    public function show($id){
        $findUser = User::find($id);
        if (!$findUser) {
            return redirect()->back()->withErrors(['find','User not found']);
        }

        return view('pages.admin.edit', [
            'user' => $findUser
        ]);
    }

    public function update(Request $request, $id){
        $validated = $request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|string|max:255|unique:users,email,'.$id,
            'password'=>'nullable|min:8|confirmed',
            'role'=>'required|in:Admin,Client'
        ]);

        $validated['updated_at'] = now();

        if (!empty($request->password)) {
            $validated['password'] = Hash::make($request->password);
        }else{
            unset($validated['password']);
        }

        $updateUser = User::where('id',$id)->update($validated);
        if (!$updateUser) {
            return redirect()
            ->back()
            ->withErrors(['update','Unable to update user']);
        }

        return redirect()
        ->back()
        ->with(['success'=>true, 'message'=>'User updated']);
    }

    public function destroy($id){
        $findUser = User::find($id);

        if ($findUser) {
            $findUser->delete();
            return redirect()->back()->with(['success'=>true, 'message'=>'User deleted']);
        }

        return redirect()->back()->withErrors(['delete','Unable to delete user']);
    }
}

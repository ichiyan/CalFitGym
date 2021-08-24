<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ChangePasswordController extends Controller
{

    public function changePass(Request $request)
    {
        $user = Auth::user();

        $userPassword = $user->password;

        $request->validate([
            'current_password' => 'required',
            'password' => 'required|same:confirm_password|min:6',
            'confirm_password' => 'required',
        ]);

        if (!Hash::check($request->current_password, $userPassword)) {
            return back()->withErrors(['current_password'=>'password not match']);
        }

        $user->password = Hash::make($request->password);

        $user->save();

        return redirect()->back()->with('success','password successfully updated');
        // $user = Auth::user();
        // $userPass = $user->password;

        // $request->validate([
        //     'current_pass' => 'required',
        //     'new_pass' => 'required',
        //     'confirm_pass' => 'required|same:new_pass'
        // ]);

        // if(!Hash::check($request->current_pass, $userPass)){
        //     return back()->withErrors(['current_password'=>'password not match']);
        // }

        // $user->password = Hash::make($request->password);

        // $user->save();

        //return redirect()->back()->with('success','password successfully updated');

        // $request->validate([
        //     'current_pass' => ['required', new MatchOldPassword],
        //     'new_pass' => ['required'],
        //     'confirm_pass' => ['same:new_password'],
        // ]);

        // User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_pass)]);

        // print('Password change successfully.');

        // return back();

        // $this->validate($request, [
        //     'oldpassword' => 'required',
        //     'newpassword' => 'required',
        // ]);

        // $hashedPassword = Auth::user()->password;
        // if (Hash::check($request->oldpassword , $hashedPassword)) {
        //     if (Hash::check($request->newpassword , $hashedPassword)) {

        //         $users = User::find(Auth::user()->id);
        //         $users->password = $request->newpassword;
        //         $users->save();
        //         session()->flash('message','password updated successfully');
        //         return redirect()->back();
        //     }
        //     else{
        //         session()->flash('message','new password can not be the old password!');
        //         return redirect()->back();
        //     }
        // }
        // else{
        //     session()->flash('message','old password doesnt matched');
        //     return redirect()->back();
        // }
    }
}


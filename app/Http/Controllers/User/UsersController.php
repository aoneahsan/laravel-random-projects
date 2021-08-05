<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function update_user_email(Request $request){

        $validated = $request->validate([
            'email' => 'required|email'
        ]);

        if(User::where('email', '=', $request->email)->first()){
            return redirect()->back()->with('email_exists', 'Email already exists!');
        }
        
        $user = User::findOrFail(auth()->user()->id);
        $user->email = $request->email;
        $user->save();
        return redirect()->back()->with('email_updated', 'Your email has been updated successfully!');
        
    }

     /**
     * update user password
     */
    public function update_user_password(Request $request){
        
        $validated = $request->validate([
            'old_password' => ['required'],
            'new_password' => ['required', 'string', 'min:8'],
        ]);
        
        $old_password = $request->old_password;
        $new_password = $request->new_password;
        $user  = User::findOrFail(auth()->user()->id);
        $userP = $user->password;
        if(Hash::check($old_password, $userP)){
            $user->password = Hash::make($new_password);
            $user->save();
            return redirect()->back()->with('password_updated', 'Password udpated successfully!');
        }
        else{
            
            return redirect()->back()->with('message', 'Entered Old Password Do Not Match Our Credentials.');
        }
    }
}

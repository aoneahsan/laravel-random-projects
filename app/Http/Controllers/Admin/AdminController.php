<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Plan;
use App\Models\User;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard(){

        return view('dashboard.admin.dashboard');
    }


    /**
     * fetch all users 
     */
    public function get_all_users(Request $request){

        $condition = [];

        if( isset($request['user_name']) && $request['user_name'] != '' )
        {
            $condition[] = ['name', 'like', '%'.$request['user_name'].'%'];
        }

        if( isset($request['user_email']) && $request['user_email'] != '' )
        {
            $condition[] = ['email', 'like', '%'.$request['user_email'].'%'];
        }

        // print_r($condition);

        $users = User::where('id', '!=', auth()->user()->id)->where($condition)->paginate(20);

        return view('dashboard.admin.users.users', ['users' => $users]);
    }

       /**
     * show form to create a new user
     */
    public function create_new_user(){

        $plans = Plan::all();
        return view('dashboard.admin.users.create', ['plans' => $plans]);
    }

    /**
     * show form to edit a user
     */
    public function edit_user($id){
        $user = User::findOrFail($id);
        $plans = Plan::all();
        $plan = Plan::get_user_plan_by_id($id);

        return view('dashboard.admin.users.edit', ['user' => $user , 
        'user_plan' => $plan, 'plans' => $plans]);
    }

    /** 
     * store a new user with subscription plan
     */
    public function store_new_user(Request $request){

        //return $request;
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'plan_id' => 'required',
            'password' => 'required|min:8'
        ]);

        if(User::where('email', '=', $request->email)->first()){
            return redirect()->back()->with('message', 'Email already exists!');
        }

        $newUser =  User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $newUser->assignRole('prospect'); //assign role to user

        //add subscription to newly created user
        Subscription::create([
            "user_id" => $newUser->id,
            "plan_id" => $request->plan_id,
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now()
        ]);

        return redirect('/admin/users')->with('created', 'New user added successfully!');
    }

    /**
     * update user and its scription plan
     */
    public function update_user(Request $request){

        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'plan_id' => 'required',
            'user_id' => 'required'
        ]);

        if(User::where('email', '=', $request->email)->where('id', '!=', $request->user_id)->first()){
            return redirect()->back()->with('message', 'Email is used by some other user. Try different one!');
        }

        $user = User::findOrFail($request->user_id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->purchased_templates = $request->purchased_templates;
        if(isset($request->password)){
            $request->validate([
                'password' => 'required|min:8'
            ]);
            $user->password = Hash::make($request->password);
        }
        
        $user->save();

        $subscription = Subscription::where('user_id', '=', $user->id)->latest()->first();
        $subscription->plan_id = $request->plan_id;
        $subscription->updated_at = Carbon::now();
        $subscription->save();

        return redirect()->back()->with('updated', 'User updated successfully!');

    }

    /**
     * show sigle user
     */
    public function show_single_user($id){

        $user_data = User::findOrFail($id);
        $plan = Plan::get_user_plan_by_id($id);
        // $user_sites = Site::where('user_id', '=', $id)->get();
        // $user_templates = Template::templatesOfUser($id);
        // $user_shortcodes = Template::shortcodesOfUser($id);
        // $user_domains = Domain::get_user_domains($id);

        return view('dashboard.admin.users.show', ['user' => $user_data , 'plan' => $plan]);
    }


    /**
     * delete user
     */
    public function delete_user($id){

        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->back()->with('message', 'User deleted successfully!');

    }
    


 
}

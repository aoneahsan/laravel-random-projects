<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Models\Plan;
use App\Models\User;
use App\Models\Subscription;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $newUser = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        //assign a default role as 'prospect' to all newly signed up users
        $newUser->assignRole('user');

        $this->add_subscription($newUser->id);

        //send data to active campaign api
        // ActiveCampaignController::addNewContact([
        //     'name' => $data['name'],
        //     'email' => $data['email'],
        // ]);

        return $newUser;
    }

    protected function add_subscription($user_id){

        Subscription::create([
            "user_id" => $user_id,
            "plan_id" => Plan::findOrFail(2)->id,
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now()
        ]);
    }
}

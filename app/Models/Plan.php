<?php

namespace App\Models;

use App\Models\Subscription;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'sites',
        'price',
    ];

        /**
     * get user current subscription plan data
     */
    public static function get_user_plan(){
        $user_id = auth()->user()->id;
        $subscription = Subscription::where('user_id', '=', $user_id)->latest()->first();
        $plan = Self::where('id', '=', $subscription->plan_id)->first();

        return $plan;

    }

    /**
     * get user current subscription plan data by given user id
     */
    public static function get_user_plan_by_id($user_id){
        $subscription = Subscription::where('user_id', '=', $user_id)->latest()->first();
        $plan = Self::where('id', '=', $subscription->plan_id)->first();

        return $plan;

    }

    /**
     * get current user subscription data
     */
    public static function get_user_subscription_by_id($id){
        return Subscription::where('user_id', '=', $id)->latest()->first();
    }

    /**
     * get current user subscription data
     */
    public static function get_user_subscription(){
        return Subscription::where('user_id', '=', auth()->user()->id)->latest()->first();
    }

    /**
     * get count allowed sites for a user plan
     */
    public static function get_allowed_sites_count(){
        $plan = Self::get_user_plan();
        if($plan->name === "pro"){
            return 20;
        }
        if($plan->name === "premium"){
            return 'unlimited';
        }
    }
}


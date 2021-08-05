<?php

namespace App\Http\Controllers\Admin;

use App\Models\Plan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlansController extends Controller
{
        /**
     * fetch all plans
     */
    public function get_all_plans(Request $request){

        $condition = [];

        if( isset($request['plan_name']) && $request['plan_name'] != '' )
        {
            $condition[] = ['name', 'like', '%'.$request['plan_name'].'%'];
        }

        if( isset($request['sites']) && $request['sites'] != '' )
        {
            $condition[] = ['sites', 'like', '%'.$request['sites'].'%'];
        }

        $plans = Plan::where($condition)->latest()->paginate(20);

        return view('dashboard.admin.plans.plans', ['plans' => $plans]);
    }

    /**
     * show form to create a new plan
     */
    public function create_new_plan(){

        return view('dashboard.admin.plans.create');
    }

    /**
     * show form to edit a plan
     */
    public function edit_plan($id){
        $plan = Plan::findOrFail($id);

        return view('dashboard.admin.plans.edit', [ 'plan' => $plan]);
    }

    /** 
     * store a new plan
     */
    public function store_new_plan(Request $request){

        //return $request;
        $validated = $request->validate([
            'plan_name' => 'required',
            'sites' => 'required',
            'price' => 'required|numeric',
        ]);

        $newPlan =  Plan::create([
            'name' => $request->plan_name,
            'sites' => $request->sites,
            'price' => $request->price,
        ]);


        return redirect()->route('admin.plans.index')->with('created', 'New plan added successfully!');
    }

    /**
     * update plan details
     */
    public function update_plan(Request $request){

        $validated = $request->validate([
            'plan_name' => 'required',
            'sites' => 'required',
            'price' => 'required|numeric',
        ]);

        $plan = Plan::findOrFail($request->plan_id);
        $plan->name = $request->plan_name;
        $plan->sites = $request->sites;
        $plan->price = $request->price;
        
        $plan->save();

        return redirect()->back()->with('updated', 'Plan updated successfully!');

    }

    /**
     * show sigle plan
     */
    public function show_single_plan($id){

        $plan = Plan::findOrFail($id);

        return view('dashboard.admin.plans.show', ['plan' => $plan] );
    }
}

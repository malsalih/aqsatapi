<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddCustomerRequest;
use App\Models\Activity;
use App\Models\Customer;
use App\Models\User;
use Carbon\Carbon;
use Hamcrest\Type\IsInteger;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Ramsey\Uuid\Type\Integer;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
        $conditions = [];
        $json = str_replace('"', '', json_encode($request->property_string));
        // $json = str_replace('"', '',$request->property_string);

        $request->filled('subject_id')? $conditions[] = ['subject_id',$request->integer('subject_id')]: 0;
        $request->filled('id')? $conditions[] = ['_id', $request->id]: 0;
        $request->filled('from_date')? $conditions[] = ['created_at', '>=',  Carbon::createFromDate($request->from_date)]: 0;
        $request->filled('to_date')? $conditions[] = ['created_at', '<=',  Carbon::createFromDate($request->to_date)]: 0;
        $request->filled('property_string')? $conditions[] = ['name', 'like', (string)"%$json%"]: 0; //! لا يعمل بالعربي

// dd($conditions);
        $activityLogs = Activity::with('causer', /*'subject'*/)
        ->where($conditions)
        // ->where('properties',['attributes'=>['name'=>Arr::wrap($request->property_string)]])
        ->when(filled($request->user_id), fn($q) => $q->whereHasMorph('causer', User::class, fn($query, $type) => $query->whereIn('causer_id', Arr::wrap($request->user_id))))
        ->when(filled($request->event), fn($q) => $q->whereIn('event', Arr::wrap($request->event)))
        ->when(filled($request->log_name), fn($q) => $q->whereIn('log_name', Arr::wrap($request->log_name)))
        // ->toMql();
        ->latest()
        ->paginate($request->per_page);

        return $activityLogs;
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function addCustomer(AddCustomerRequest $request)
    {
        $customer =new Customer();
        $customer->fill($request->all());
        $customer->save();
        
        return Activity::all();

        // return $customer;
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
}

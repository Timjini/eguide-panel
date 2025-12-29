<?php

namespace App\Http\Controllers\Billing;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BillingController extends Controller
{

    public function index(Request $request): View
    {
        info("request data", ['route' => $request->route()->parameter('company')]);
        $company = Company::find($request->route()->parameter('company'));
        $subscription = $company->subscriptions()->first();
        return view('companies.billing.index', compact('subscription'));
    }
}

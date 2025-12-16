<?php

namespace App\Http\Controllers\Billing;

use App\Models\Company;
use App\Models\Plan;
use Illuminate\Support\Facades\Auth;

final class PlanController
{
    public function index()
    {
        // TODO : super coupled
        $companyId = Auth::user()->company_id;
        $company = Company::find($companyId);
        return view('plans.index', [
            'plans' => Plan::where('is_active', true)->orderBy('sort_order')->get(),
            'company' => $company
        ]);
    }
}

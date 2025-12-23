<?php

namespace App\Http\Controllers\Billing;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class BillingController extends Controller
{

    public function index(): View
    {
        return view('companies.billing.index');
    }
}

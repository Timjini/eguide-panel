<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCompanyRequest;
use App\Jobs\CreateCompany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CompanyController extends Controller
{

    public function index()
    {
        return view('companies.index');
    }

    public function store(StoreCompanyRequest $request)
    {
        CreateCompany::dispatchSync($request->validated());

        return redirect()
            ->route('companies.index')
            ->with('success', __('Company created successfully.'));
    }
}

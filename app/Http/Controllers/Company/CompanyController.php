<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCompanyRequest;
use App\Jobs\CreateCompany;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{

    public function __construct() {}
    public function index()
    {
        $company = Company::find(Auth::user()->company_id);
        return view('companies.index', ['company' => $company]);
    }

    public function store(StoreCompanyRequest $request)
    {
        CreateCompany::dispatchSync(
            $request->validated()
        );

        return redirect()
            ->route('companies.index')
            ->with('success', __('Company created successfully.'));
    }
}

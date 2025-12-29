<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class MembersController extends Controller
{
    public function index(): View
    {
        return view('companies.members.index');
    }
}
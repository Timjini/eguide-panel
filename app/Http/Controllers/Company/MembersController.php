<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Service\InviteMemberService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MembersController extends Controller
{
    public function __construct(
        protected InviteMemberService $inviteMemberService
    )
    {
        $this->inviteMemberService = $inviteMemberService;
    }
    public function index(): View
    {
        return view('companies.members.index');
    }

    public function create(): View
    {
        return view('companies.members.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'role' => 'required|string',
        ]);

        $this->inviteMemberService->invite($data);

        return redirect()->route('company.members.index')
            ->with('success', 'Member invited successfully!');
    }
}
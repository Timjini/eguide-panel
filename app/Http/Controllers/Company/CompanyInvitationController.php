<?php 

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Service\OnboardingStepsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CompanyInvitationController extends Controller
{
     public function __construct(
        protected OnboardingStepsService $service
    ) {}

    public function index(): View 
    {
        // $invitation = 
        return view('companies.invitations.index');
    }

    public function validateInvitationCode(Request $request) 
    {
        info("Validating invitation code: " . $request->invitation_code);

        if($request->invitation_code === 'VALIDCODE123') {
            info("Invitation code is valid.");
            $this->service->exitOnboarding(
                Auth::user(),
                $companyId = '43337125-a2d7-48d8-a8d2-f89c36c2b906'
            );
            return redirect()->route('dashboard');
        } else {
            info("Invitation code is invalid.");
            return redirect()->back()->withErrors(['invitation_code' => 'Invalid invitation code.']);
        }
    }
}
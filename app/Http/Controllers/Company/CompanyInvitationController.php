<?php 

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\CompanyInvitation;
use App\Service\OnboardingStepsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Events\CompanyInvitationCreated;
use App\Lib\Outils;

class CompanyInvitationController extends Controller
{
     public function __construct(
        protected OnboardingStepsService $service,
        protected Outils $outils
    ) {}

    public function index(): View 
    {
        // $invitation = 
        return view('companies.invitations.index');
    }

    public function store(Request $request) 
    {
        // validation
        // check if invitation already exists
        // company id policy to make sure user can only invite to their own company
        // later policy to check if user has permission to invite


        // move this to service later
        $invitation = CompanyInvitation::create([
            'company_id' => Auth::user()->company_id,
            'email' => $request->email,
            'expires_at' => now()->addDays(7),
            'invited_by' => Auth::id(),
            'invitation_code' => $this->outils::generateStr(),
        ]);

        // Change event later to Job with reminder emails
        event(new CompanyInvitationCreated($invitation));

         return redirect()->route('companies.invitations.index')
            ->with('success', 'Customer created successfully.');
    }

    public function bulkSoftDelete(Request $request) 
    {
        info("Bulk soft deleting invitations with IDs: " . implode(", ", $request->ids));

        CompanyInvitation::whereIn('id', $request->ids)->delete();

        return response()->json(['message' => 'Invitations soft deleted successfully.']);
    }

    public function validateInvitationCode(Request $request) 
    {
        info("Validating invitation code: " . $request->invitation_code);

        $invitation = CompanyInvitation::where('invitation_code', $request->invitation_code)
            ->where('email', Auth::user()->email)
            ->where('expires_at', '>', now())
            ->first();

        if($invitation) {
            info("Invitation code is valid.");
            $this->service->exitOnboarding(
                Auth::user(),
                $invitation->company_id
            );
            return redirect()->route('dashboard')->with('success', 'Invitation accepted successfully.');
        } else {
            info("Invitation code is invalid.");
            return redirect()->back()->withErrors(['invitation_code' => 'Invalid invitation code.']);
        }
    }
}
<?php

namespace App\Livewire;

use App\Models\CompanyInvitation;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

final class CompanyInvitationTable extends PowerGridComponent
{
    public string $tableName = 'companyInvitationTable';

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            PowerGrid::header()
                ->showSearchInput(),
            PowerGrid::footer()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return CompanyInvitation::query()
              ->join('users', function ($users) {
                  $users->on('company_invitations.invited_by', '=', 'users.id');
              })->join('companies', function ($companies) {
                  $companies->on('company_invitations.company_id', '=', 'companies.id');
              })
              ->select([
                  'company_invitations.id',
                  'company_invitations.email',
                  'company_invitations.invitation_code',
                  'company_invitations.expires_at',
                  'users.name as invited_by',
                  'company_invitations.created_at',
              ])->where('companies.id', Auth::user()->company()->get()->first()->id);
        ;
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('email')
            ->add('invitation_code')
            ->add('expires_at')
            ->add('invited_by')
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Email', 'email')
                ->sortable()
                ->searchable(),

            Column::make('Invitation code', 'invitation_code')
                ->sortable()
                ->searchable(),

            Column::make('Expires at', 'expires_at')
                ->sortable()
                ->searchable(),

            Column::make('Invited by', 'invited_by')
                ->sortable()
                ->searchable(),

            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
        ];
    }

    #[\Livewire\Attributes\On('delete')]
    public function delete($invitationId): void
    {
        $this->js('alert('.$invitationId.')');
    }

    public function actions(CompanyInvitation $row): array
    {
        return [
            Button::add('delete')
                ->id()
                ->icon('default-trash')
                ->class('cursor-pointer text-red-600 hover:text-red-900')
                ->dispatch('delete', ['invitationId' => $row->id]),
        ];
    }

    /*
    public function actionRules($row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
        ];
    }
    */
}

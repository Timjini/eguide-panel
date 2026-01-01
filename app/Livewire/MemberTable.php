<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Context;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Facades\Rule;

final class MemberTable extends PowerGridComponent
{
    public string $tableName = 'memberTable';

    public function header(): array
    {
        return [
            // Button::add('create-member')
            //     ->slot('Create Member')
            //     ->class('bg-green-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
            //     ->dispatch('createMember', []),
        ];
    }

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            PowerGrid::header()
                ->showToggleColumns()
                ->showSearchInput(),
            PowerGrid::footer()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return User::query()
            ->join('companies', function ($companies) {
                $companies->on('users.company_id', '=', 'companies.id');
            })
            ->select([
                'users.id',
                'users.name',
                'users.email',
                'users.created_at',
                'companies.legal_name as company_name',
            ])->where('companies.id', Auth::user()->company()->get()->first()->id);
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('name')
            ->add('email')
            ->add('created_at');
    }

    public function columns(): array
    {
        return [

            Column::make('Name', 'name')
                ->sortable()
                ->searchable(),

            Column::make('Email', 'email')
                ->sortable()
                ->searchable(),

            Column::make('Created at', 'created_at')
                ->sortable()
                ->searchable(),

            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($memberId): void
    {

        info('Edit member:');
        $this->js('alert(' . $memberId . ')');
    }

    #[\Livewire\Attributes\On('delete')]
    public function delete($memberId): void
    {

        info('Delete member:');
        $this->js('alert(' . $memberId . ')');
    }

    #[\Livewire\Attributes\On('bulkDelete')]
    public function bulkDelete(): void
    {
        info('Bulk delete members');
    }

    public function actions(User $row): array
    {
        return [
            Button::add('edit')
                ->id()
                ->icon('default-edit')
                ->class('')
                ->dispatch('edit', ['memberId' => $row->id]),

            Button::add('delete')
                ->id()
                ->icon('default-trash')
                ->class('cursor-pointer text-red-600 hover:text-red-900')
                ->dispatch('delete', ['memberId' => $row->id]),
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

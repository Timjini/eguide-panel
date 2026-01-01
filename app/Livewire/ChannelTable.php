<?php

namespace App\Livewire;

use App\Models\Channel;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

final class ChannelTable extends PowerGridComponent
{
    public string $tableName = 'channelTable';

    public function boot(): void
    {
        config(['livewire-powergrid.filter' => 'outside']);
    }

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
        return Channel::query()->join('companies', function ($companies) {
            $companies->on('channels.company_id', '=', 'companies.id');
        })
        ->select([
            'channels.id',
            'channels.name',
            'channels.description',
            'channels.code',
            'channels.started_at',
            'channels.ended_at',
            'channels.status',
            'channels.created_at',
        ])->where('companies.id', Auth::user()->company_id)
        ;
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
         return PowerGrid::fields()
            ->add('name')
            ->add('description')
            ->add('code')
            ->add('started_at')
            ->add('ended_at')
            ->add('status');
    }

    public function columns(): array
    {
        return [
            Column::make('Name', 'name')
                ->searchable()
                ->sortable(),
            Column::make('Description', 'description')
                ->searchable()
                ->sortable(),
            Column::make('Code', 'code')
                ->searchable()
                ->sortable(),
            Column::make('Start Date', 'started_at')
                ->searchable()
                ->sortable(),
            Column::make('End Date', 'ended_at')
                ->searchable()
                ->sortable(),
            Column::make('Status', 'status')
                ->searchable()
                ->sortable(),
            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::datetimepicker('started_at'),

            Filter::datetimepicker('ended_at')
        ];
    }

    #[\Livewire\Attributes\On('delete')]
    public function delete($channelId): void
    {
        $this->js('alert('.$channelId.')');
    }

    public function actions(Channel $row): array
    {
        return [
             Button::add('delete')
                ->id()
                ->icon('default-trash')
                ->class('cursor-pointer text-red-600 hover:text-red-900')
                ->dispatch('delete', ['channelId' => $row->id]),
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

<?php

namespace App\Livewire;

use App\Events\ChannelCreated;
use App\Livewire\Forms\ChannelForm;
use App\Models\Channel;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CreateChannel extends Component
{

    public ChannelForm $form;
    public function save()
    {
        $this->validate();
        $companyId = Auth::user()->company_id;
        try {
            $channel = Channel::create([
                'company_id' => Auth::user()->company_id,
                'name' => $this->form->name,
                'description' => $this->form->description,
                'stated_at' => $this->form->stated_at,
                'end_at' => $this->form->end_at,
                'status' => $this->form->is_active ? 'active' : 'inactive',
                'code' => strtoupper(uniqid('CHN')),
            ]);

            event(new ChannelCreated($channel->code));
           $this->redirectRoute('companies.channels.index', ['company' => $companyId]);
        } catch (\Exception $e) {
            info('An error occurred while creating the channel: ' . $e->getMessage());
            // Log the error or handle it as needed
            session()->flash('error', 'An error occurred while creating the channel: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.create-channel');
    }
}

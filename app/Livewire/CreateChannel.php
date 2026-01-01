<?php 

namespace App\Livewire;

use App\Livewire\Forms\ChannelForm;
use Livewire\Component;

class CreateChannel extends Component
{

    public ChannelForm $form; 
      public function save()
    {
        $this->validate();
        info("Submission form channel: " .  $this->form->is_active);
        // return $this->redirect('/posts');
    }

    public function toggleProperties($property)
    {
        $this->form->is_active = !$this->form->is_active;
    }

    public function render()
    {
        return view('livewire.create-channel');
    }
    
}
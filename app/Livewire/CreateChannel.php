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
        info("Submitted email: " . $this->form->name);
        // return $this->redirect('/posts');
    }

    public function render()
    {
        return view('livewire.create-channel');
    }
    
}
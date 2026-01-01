<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class ChannelForm extends Form
{
    #[Validate('required|min:5')]
    public $name = '';

}

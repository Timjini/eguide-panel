<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class ChannelForm extends Form
{
    #[Validate('required|min:5')]
    public $name = '';

    #[Validate('required|min:5')]
    public $description = '';

    #[Validate('required|date')]
    public $stated_at = '';

    #[Validate('required|date')]
    public $end_at = '';

    public $is_active = false;

}

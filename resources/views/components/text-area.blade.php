@props([
    'label' => null,
    'placeholder' => null,
    'rows' => 4,
    'cols' => null,
    'name' => null,
    'value' => null,
])
<flux:textarea label="{{ $label }}" 
               placeholder="{{ $placeholder }}" 
               rows="{{ $rows }}" 
               cols="{{ $cols }}" 
               name="{{ $name }}" 
               value="{{ $value }}" />
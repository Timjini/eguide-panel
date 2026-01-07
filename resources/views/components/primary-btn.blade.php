 @props([
     'type' => 'button',
     'variant' => 'primary',
     'class' => '',
     'data-test' => '',
     'label' => __('Create account')
 ])
 <flux:button  wire:click="save" type="{{ $type }}" variant="{{ $variant }}" class="w-full text-gray-200 dark:text-gray-900 " data-test="{{ $dataTest }}">
     {{ $label }}
 </flux:button>
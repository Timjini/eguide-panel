 @props([
     'type' => 'button',
     'variant' => 'primary',
     'class' => '',
     'data-test' => '',
     'label' => __('Create account')
 ])
 <flux:button type="{{ $type }}" variant="{{ $variant }}" class="w-full" data-test="{{ $dataTest }}">
     {{ $label }}
 </flux:button>
@props([
'name' => '',
'label' => '',
'value' => '',
'type' => 'text',
'placeholder' => '',
'required' => false,
'autofocus' => false,
'autocomplete' => '',
'requiredIndicator' => false,
])
<flux:field>
    <flux:label>{{ $label }}</flux:label>
    <flux:input
        :name="$name"
        :value="old($name)"
        :type="$type"
        :autocomplete="$autocomplete"
        :placeholder="$placeholder"
        {{ $attributes ?? '' }}
        :required="$required"
        :autofocus="$autofocus"
    />
    <flux:error name="{{ $name }}" />
</flux:field>
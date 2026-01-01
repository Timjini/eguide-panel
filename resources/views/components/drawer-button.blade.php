
@props(['title', 'commandfor'])
<button command="show-modal" commandfor="{{$commandfor}}" class="rounded-md bg-gray-800 px-2.5 py-1.5 text-sm font-semibold text-white inset-ring inset-ring-white/5 hover:bg-gray-700 dark:bg-accent-foreground ">
    {{$title}}
</button>

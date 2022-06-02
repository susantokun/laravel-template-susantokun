@props(['title'])
<div class="flex items-center h-10 intro-y">
    <h2 class="mr-5 text-lg font-medium truncate">{{ $title }}</h2>
    {{ $slot }}
</div>

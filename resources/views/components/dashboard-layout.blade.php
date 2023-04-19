@props(['add' => false, 'all' => false, 'favorites' => false])
<x-layout title="Login">
    <main class="d-flex">
        <x-header.side-navigation :add="$add" :all="$all" :favorites="$favorites"/>

        {{ $slot }}

    </main>
</x-layout>

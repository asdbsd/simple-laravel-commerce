@props(['add' => false, 'all' => false])
<x-layout title="Login" cssPath="/css/auth.css">
    <main class="d-flex flex-nowrap">
        <x-header.side-navigation :add="$add" :all="$all"/>

        {{ $slot }}

    </main>
</x-layout>

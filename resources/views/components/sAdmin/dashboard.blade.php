<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/SAdmin.css'])
</head>

<body>
    <div class="layout-container">
        <aside class="sidebar">
            <h1>tes</h1>
            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3">
                <path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z" />
            </svg>
            <livewire:sidebar/>
        </aside>

        <main class="main-content">
            <div class="navbar">

            </div>
            <div>

            </div>
            {{-- @php
                $target = request()->segment(2) ?? null;
            @endphp

            @if ($target) {
                <livewire:dynamic-component :component="'sAdmin.' . $target" wire:key="{{$target}}" />
            }
            @endif --}}

            @livewire('sAdmin.barang')
        </main>
    </div>
</body>

</html>

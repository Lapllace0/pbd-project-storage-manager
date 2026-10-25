<?php

use Livewire\Component;
use Livewire\Attributes\On;

new class extends Component
{
    public $current = 'welcome';

    #[On('abc')]
    public function tes($data) {
        $this->current = $data;
    }
};
?>

<div>
    {{-- <livewire:dynamic-component :component="'sAdmin.' . $target" wire:key="{{$target}}" /> --}}
<livewire:dynamic-component :component="'sAdmin.' . $current" :wire:key="$current"/>
</div>

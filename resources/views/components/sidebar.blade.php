<?php

use Livewire\Component;

new class extends Component
{
    public function getData() {
        $this->dispatch('tes');
    }
};
?>

<div>
    <ul>
        <li>
            <button wire:click='getData'>click me</button>
        </li>
    </ul>
</div>

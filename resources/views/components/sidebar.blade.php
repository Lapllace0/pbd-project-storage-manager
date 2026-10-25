<?php

use Livewire\Component;

new class extends Component
{
    public function getData($data) {
        $this->dispatch('abc', data: $data);
    }
};
?>

<div>
    <ul>
        <li>
            <button wire:click="getData('barang')">click me</button>
        </li>
        <li>
            <button wire:click="getData('users')">click me</button>
        </li>
    </ul>
</div>

<?php

use Livewire\Component;

new class extends Component {
    public $active = '';
    public function getData($data, $active)
    {
        $this->active = $active;
        $this->dispatch('abc', data: $data);
    }


};
?>

<div>
    <ul>
        <li>
            <button wire:click="getData('lihat_barang', 1)" class="btn {{$active == 1 ? 'btn-active' : ''}}">Barang</button>
        </li>
        <li>
            <button wire:click="getData('lihat_user', 2)" class="btn {{$active == 2 ? 'btn-active' : ''}}">Users</button>
        </li>
        <li>
            <button wire:click = "getData('lihat_vendor', 3)" class="btn {{$active == 3 ? 'btn-active' : ''}}">Vendor</button>
        </li>
        <li>
            <button wire:click = "getData('lihat_role', 4)" class="btn {{$active == 4 ? 'btn-active' : ''}}">Role</button>
        </li>
        <li>
            <button wire:click = "getData('kartu_stok', 5)" class="btn {{$active == 5 ? 'btn-active' : ''}}">Kartu Stok</button>
        </li>
        <li>
            <button wire:click = "getData('lihat_margin', 6)" class="btn {{$active == 6 ? 'btn-active' : ''}}">Margin</button>
        </li>
        <li>
            <button wire:click = "getData('lihat_satuan', 7)" class="btn {{$active == 7 ? 'btn-active' : ''}}">Satuan</button>
        </li>
        <li>
            <button wire:click = "getData('penerimaan', 8)" class="btn {{$active == 8 ? 'btn-active' : ''}}">Penerimaan</button>
        </li>
        <li>
            <button wire:click = "getData('detail_penerimaan', 9)" class="btn {{$active == 9 ? 'btn-active' : ''}}">Detail Penerimaan</button>
        </li>
        <li>
            <button wire:click = "getData('pengadaan', 10)" class="btn {{$active == 10 ? 'btn-active' : ''}}">Pengadaan</button>
        </li>
        <li>
            <button wire:click = "getData('detail_pengadaan', 11)" class="btn {{$active == 11 ? 'btn-active' : ''}}">Detail Pengadaan</button>
        </li>
        <li>
            <button wire:click = "getData('penjualan', 12)" class="btn {{$active == 12 ? 'btn-active' : ''}}">Penjualan</button>
        </li>
        <li>
            <button wire:click = "getData('detail_penjualan', 13)" class="btn {{$active == 13 ? 'btn-active' : ''}}">Detail Penjualan</button>
        </li>
        <li>
            <button wire:click = "getData('retur', 14)" class="btn {{$active == 14 ? 'btn-active' : ''}}">Retur</button>
        </li>
        <li>
            <button wire:click = "getData('detail_retur', 15)" class="btn {{$active == 15 ? 'btn-active' : ''}}">Detail Retur</button>
        </li>
    </ul>
</div>

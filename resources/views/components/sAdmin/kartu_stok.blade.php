<?php

use Livewire\Component;

new class extends Component {
    public $data;
    public $offset = 0;

    public function getAll()
    {
        $this->data = DB::select('select * from kartu_stok limit 1 offset ?', [$this->offset]);
        $this->offset += 1;
    }
};
?>

<div>
    <button wire:click="getAll">tes</button>
    <table class="table">
        <thead class="thead">
            <tr>
                <th>Id Kartu Stok</th>
                <th>Jenis Transaksi</th>
                <th>Masuk</th>
                <th>Keluar</th>
                <th>Stock</th>
                <th>created_at</th>
                <th>Id Transaksi</th>
                <th>Id Barang</th>
            </tr>
        </thead>
        <tbody>
            @if ($data)
                @foreach ($data as $d)
                    @if ($loop->iteration % 2 == 1)
                        <tr class="trOdd">
                            <td>{{ $d->idKartu_stok }}</td>
                            <td>{{ $d->jenis_transaksi }}</td>
                            <td>{{ $d->masuk }}</td>
                            <td>{{ $d->keluar }}</td>
                            <td>{{ $d->stock }}</td>
                            <td>{{ $d->created_at }}</td>
                            <td>{{ $d->idTransaksi }}</td>
                            <td>{{ $d->idBarang }}</td>
                        </tr>
                    @else
                        <tr class="trEven">
                            <td>{{ $d->idKartu_stok }}</td>
                            <td>{{ $d->jenis_transaksi }}</td>
                            <td>{{ $d->masuk }}</td>
                            <td>{{ $d->keluar }}</td>
                            <td>{{ $d->stock }}</td>
                            <td>{{ $d->created_at }}</td>
                            <td>{{ $d->idTransaksi }}</td>
                            <td>{{ $d->idBarang }}</td>
                        </tr>
                    @endif
                @endforeach
            @endif
        </tbody>
    </table>
</div>

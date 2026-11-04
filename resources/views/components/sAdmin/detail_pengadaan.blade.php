<?php

use Livewire\Component;

new class extends Component {
    public $data;
    public $offset = 0;

    public function getAll()
    {
        $this->data = DB::select('select * from detail_pengadaan limit 1 offset ?', [$this->offset]);
        $this->offset += 1;
    }
};
?>

<div>
    <button wire:click="getAll">tes</button>
    <table class="table">
        <thead class="thead">
            <tr>
                <th>Id Detail Pengadaan</th>
                <th>Harga Satuan</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
                <th>Id Barang</th>
                <th>Id Pengadaan</th>
            </tr>
        </thead>
        <tbody>
            @if ($data)
                @foreach ($data as $d)
                    @if ($loop->iteration % 2 == 1)
                        <tr class="trOdd">
                            <td>{{ $d->idDetail_pengadaan }}</td>
                            <td>{{ $d->harga_satuan }}</td>
                            <td>{{ $d->jumlah }}</td>
                            <td>{{ $d->sub_total }}</td>
                            <td>{{ $d->idBarang }}</td>
                            <td>{{ $d->idPengadaan }}</td>
                        </tr>
                    @else
                        <tr class="trEven">
                            <td>{{ $d->idDetail_pengadaan }}</td>
                            <td>{{ $d->harga_satuan }}</td>
                            <td>{{ $d->jumlah }}</td>
                            <td>{{ $d->sub_total }}</td>
                            <td>{{ $d->idBarang }}</td>
                            <td>{{ $d->idPengadaan }}</td>
                        </tr>
                    @endif
                @endforeach
            @endif
        </tbody>
    </table>
</div>

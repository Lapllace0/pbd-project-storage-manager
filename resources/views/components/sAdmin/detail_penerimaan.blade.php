<?php

use Livewire\Component;

new class extends Component {
    public $data;
    public $offset = 0;

    public function getAll()
    {
        $this->data = DB::select('select * from detail_penerimaan limit 1 offset ?', [$this->offset]);
        $this->offset += 1;
    }
};
?>

<div>
    <button wire:click="getAll">tes</button>
    <table class="table">
        <thead class="thead">
            <tr>
                <th>Id Detail Penerimaan</th>
                <th>Id Penerimaan</th>
                <th>Id Barang</th>
                <th>Jumlah Terima</th>
                <th>Harga Satuan Terima</th>
                <th>Subtotal Terima</th>
            </tr>
        </thead>
        <tbody>
            @if ($data)
                @foreach ($data as $d)
                    @if ($loop->iteration % 2 == 1)
                        <tr class="trOdd">
                            <td>{{ $d->idDetail_penerimaan }}</td>
                            <td>{{ $d->idPenerimaan }}</td>
                            <td>{{ $d->idBarang }}</td>
                            <td>{{ $d->jumlah_terima }}</td>
                            <td>{{ $d->harga_satuan_terima }}</td>
                            <td>{{ $d->sub_total_terima }}</td>
                        </tr>
                    @else
                        <tr class="trEven">
                            <td>{{ $d->idDetail_penerimaan }}</td>
                            <td>{{ $d->idPenerimaan }}</td>
                            <td>{{ $d->idBarang }}</td>
                            <td>{{ $d->jumlah_terima }}</td>
                            <td>{{ $d->harga_satuan_terima }}</td>
                            <td>{{ $d->sub_total_terima }}</td>
                        </tr>
                    @endif
                @endforeach
            @endif
        </tbody>
    </table>
</div>

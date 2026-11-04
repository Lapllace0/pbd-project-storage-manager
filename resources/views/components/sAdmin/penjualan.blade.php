<?php

use Livewire\Component;

new class extends Component {
    public $data;
    public $offset = 0;

    public function getAll()
    {
        $this->data = DB::select('select * from penjualan limit 1 offset ?', [$this->offset]);
        $this->offset += 1;
    }
};
?>

<div>
    <button wire:click="getAll">tes</button>
    <table class="table">
        <thead class="thead">
            <tr>
                <th>Id Penjualan</th>
                <th>created_at</th>
                <th>Subtotal Nilai</th>
                <th>PPN</th>
                <th>Total Nilai</th>
                <th>Id User</th>
                <th>Id Margin Penjualan</th>
            </tr>
        </thead>
        <tbody>
            @if ($data)
                @foreach ($data as $d)
                    @if ($loop->iteration % 2 == 1)
                        <tr class="trOdd">
                            <td>{{ $d->idPenjualan }}</td>
                            <td>{{ $d->created_at }}</td>
                            <td>{{ $d->subTotal_nilai }}</td>
                            <td>{{ $d->ppn }}</td>
                            <td>{{ $d->total_nilai }}</td>
                            <td>{{ $d->idUser }}</td>
                            <td>{{ $d->idMargin_penjualan }}</td>
                        </tr>
                    @else
                        <tr class="trEven">
                            <td>{{ $d->idPenjualan }}</td>
                            <td>{{ $d->created_at }}</td>
                            <td>{{ $d->subTotal_nilai }}</td>
                            <td>{{ $d->ppn }}</td>
                            <td>{{ $d->total_nilai }}</td>
                            <td>{{ $d->idUser }}</td>
                            <td>{{ $d->idMargin_penjualan }}</td>
                        </tr>
                    @endif
                @endforeach
            @endif
        </tbody>
    </table>
</div>

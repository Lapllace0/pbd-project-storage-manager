<?php

use Livewire\Component;

new class extends Component {
    public $data;
    public $offset = 0;

    public function getAll()
    {
        $this->data = DB::select('select * from detail_retur limit 1 offset ?', [$this->offset]);
        $this->offset += 1;
    }
};
?>

<div>
    <button wire:click="getAll">tes</button>
    <table class="table">
        <thead class="thead">
            <tr>
                <th>Id detail Retur</th>
                <th>Jumlah</th>
                <th>Alasan</th>
                <th>Id Retur</th>
                <th>Id Detail Penerimaan</th>
            </tr>
        </thead>
        <tbody>
            @if ($data)
                @foreach ($data as $d)
                    @if ($loop->iteration % 2 == 1)
                        <tr class="trOdd">
                            <td>{{ $d->idDetail_retur}}</td>
                            <td>{{ $d->jumlah }}</td>
                            <td>{{ $d->alasan }}</td>
                            <td>{{ $d->idRetur }}</td>
                            <td>{{ $d->idDetail_penerimaan }}</td>
                        </tr>
                    @else
                        <tr class="trEven">
                            <td>{{ $d->idDetail_retur}}</td>
                            <td>{{ $d->jumlah }}</td>
                            <td>{{ $d->alasan }}</td>
                            <td>{{ $d->idRetur }}</td>
                            <td>{{ $d->idDetail_penerimaan }}</td>
                        </tr>
                    @endif
                @endforeach
            @endif
        </tbody>
    </table>
</div>

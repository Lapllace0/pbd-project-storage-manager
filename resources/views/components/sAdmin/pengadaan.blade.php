<?php

use Livewire\Component;

new class extends Component {
    public $data;
    public $offset = 0;

    public function getAll()
    {
        $this->data = DB::select('select * from pengadaan limit 1 offset ?', [$this->offset]);
        $this->offset += 1;
    }
};
?>

<div>
    <button wire:click="getAll">tes</button>
    <table class="table">
        <thead class="thead">
            <tr>
                <th>Id Pengadaan</th>
                <th>Timestamp</th>
                <th>Id User</th>
                <th>Status</th>
                <th>Id Vendor</th>
                <th>Subtotal Nilai</th>
                <th>PPN</th>
                <th>Total Nilai</th>
            </tr>
        </thead>
        <tbody>
            @if ($data)
                @foreach ($data as $d)
                    @if ($loop->iteration % 2 == 1)
                        <tr class="trOdd">
                            <td>{{ $d->idPengadaan}}</td>
                            <td>{{ $d->timestamp}}</td>
                            <td>{{ $d->idUser}}</td>
                            <td>{{ $d->status}}</td>
                            <td>{{ $d->idVendor}}</td>
                            <td>{{ $d->subTotal_nilai}}</td>
                            <td>{{ $d->ppn}}</td>
                            <td>{{ $d->total_nilai}}</td>
                        </tr>
                    @else
                        <tr class="trEven">
                            <td>{{ $d->idPengadaan}}</td>
                            <td>{{ $d->timestamp}}</td>
                            <td>{{ $d->idUser}}</td>
                            <td>{{ $d->status}}</td>
                            <td>{{ $d->idVendor}}</td>
                            <td>{{ $d->subTotal_nilai}}</td>
                            <td>{{ $d->ppn}}</td>
                            <td>{{ $d->total_nilai}}</td>
                        </tr>
                    @endif
                @endforeach
            @endif
        </tbody>
    </table>
</div>

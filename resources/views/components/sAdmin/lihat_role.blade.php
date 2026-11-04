<?php

use Livewire\Component;

new class extends Component {
    public $data;
    public $offset = 0;

    public function getAll()
    {
        $this->data = DB::select('select * from lihat_role limit 1 offset ?', [$this->offset]);
        $this->offset += 1;
    }
};
?>

<div>
        <button wire:click="getAll">tes</button>
    <table class="table">
        <thead class="thead">
            <tr>
                <th>Nama Role</th>
            </tr>
        </thead>
        <tbody>
            @if ($data)
                @foreach ($data as $d)
                    @if ($loop->iteration % 2 == 1)
                        <tr class="trOdd">
                            <td>{{ $d->{'Nama Role'} }}</td>
                        </tr>
                    @else
                        <tr class="trEven">
                            <td>{{ $d->{'Nama Role'} }}</td>
                        </tr>
                    @endif
                @endforeach
            @endif
        </tbody>
    </table>
</div>

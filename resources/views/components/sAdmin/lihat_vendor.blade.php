<?php

use Livewire\Component;

new class extends Component {
    public $data;
    public $offset = 0;

    public function getAll()
    {
        $this->data = DB::select('select * from lihat_vendor limit 1 offset ?', [$this->offset]);
        $this->offset += 1;
    }

        public function mount() {
        $this->getAll();
    }
};
?>

<div>
    <button wire:click="getAll">tes</button>
    <table class="table">
        <thead class="thead">
            <tr>
                <th>sd</th>
                <th>sdasd</th>
            </tr>
        </thead>
        <tbody>
            @if ($data)
                @foreach ($data as $d)
                    @if ($loop->iteration % 2 == 1)
                        <tr class="trOdd">
                            <td>{{ $d->{'Nama Vendor'} }}</td>
                            <td>{{ $d->{'Badan Hukum'} }}</td>
                        </tr>
                    @else
                        <tr class="trEven">
                            <td>{{ $d->{'Nama Vendor'} }}</td>
                            <td>{{ $d->{'Badan Hukum'} }}</td>
                        </tr>
                    @endif
                @endforeach
            @endif
        </tbody>
    </table>
</div>

<?php

use Livewire\Component;
use Livewire\Attributes\On;

new class extends Component {
    public $data;
    public $offset = 0;
    public $page = 1;
    public $nextData;

    public function getAll()
    {
        $this->data = DB::select('select * from lihat_barang limit 5 offset ?', [$this->offset]);
        $this->nextData = DB::select(
            'with dataA as (
            select * from lihat_barang limit 5 offset ?)
            select count(*) as total from dataA',
            [$this->offset + 5],
        );
        $this->offset += 5;
    }

    public function getNext()
    {
        $this->data = DB::select('select * from lihat_barang limit 5 offset ?', [$this->offset]);
        $this->nextData = DB::select(
            'with dataA as (
            select * from lihat_barang limit 5 offset ?)
            select count(*) as total from dataA',
            [$this->offset + 5],
        );
        $this->offset += 5;
        $this->page += 1;
    }

    public function getPrev()
    {
        $this->offset -= 10;
        $this->page -= 1;
        $this->data = DB::select('select * from lihat_barang limit 5 offset ?', [$this->offset]);
        $this->nextData = DB::select(
            'with dataA as (
            select * from lihat_barang limit 5 offset ?)
            select count(*) as total from dataA',
            [$this->offset + 5],
        );
        $this->offset += 5;
    }

    public function mount()
    {
        $this->getAll();
    }
};
?>

<div class="test">

    <div class="navPage">
        <h5 class="page">PAGE: {{ $page }}</h5>
        @if ($page == 1)
            <button wire:click="getPrev" disabled class="prevPage">prev</button>
        @else
            <button wire:click="getPrev" class="prevPage">prev</button>
        @endif
        @if ($nextData[0]->total < 1)
            <button wire:click="getNext" disabled class="nextPage">next</button>
        @else
            <button wire:click="getNext" class="nextPage">next</button>
        @endif
    </div>

    <table class="table">
        <thead class="thead">
            <tr>
                <th>Jenis</th>
                <th>Nama</th>
                <th>Satuan</th>
                <th>Harga</th>
                <th class="editData">edit</th>
            </tr>
        </thead>
        <tbody class="tbody">
            @if ($data)
                @foreach ($data as $d)
                    @if ($loop->iteration % 2 == 1)
                        <tr class="trOdd datarow" id="{{ $d->idBarang }}">
                            <td>{{ $d->jenis }}</td>
                            <td>{{ $d->Nama }}</td>
                            <td>{{ $d->Satuan }}</td>
                            <td>{{ $d->Harga }}</td>
                            <td><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" height="24px"
                                    width="24px" class="svgEdit" onclick="window.showModal()">
                                    <path
                                        d="M5,21q-0.83,0-1.41-0.59T3,19V5Q3,4.17 3.59,3.59T5,3h8.93l-2,2H5V19H19V12.05l2-2V19q0,0.82-0.59,1.41T19,21H5Zm7-9ZM9,15V10.75l9.18-9.18q0.3-0.3 0.68-0.45q0.38-0.15 0.75-0.15q0.4,0 0.76,0.15q0.36,0.15 0.66,0.45L22.43,3q0.28,0.3 0.43,0.66T23,4.4T22.86,5.14T22.43,5.8L13.25,15H9ZM21.03,4.4L19.63,3l1.4,1.4ZM11,13h1.4l5.8-5.8L17.5,6.5L16.78,5.8L11,11.58V13Zm6.5-6.5L16.78,5.8L17.5,6.5l0.7,0.7L17.5,6.5Z" />
                                </svg>
                            </td>
                        </tr>
                    @else
                        <tr class="trEven datarow" id="{{ $d->idBarang }}">
                            <td>{{ $d->jenis }}</td>
                            <td>{{ $d->Nama }}</td>
                            <td>{{ $d->Satuan }}</td>
                            <td>{{ $d->Harga }}</td>
                            <td><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" height="24px"
                                    width="24px" class="svgEdit" onclick="window.showModal()">
                                    <path
                                        d="M5,21q-0.83,0-1.41-0.59T3,19V5Q3,4.17 3.59,3.59T5,3h8.93l-2,2H5V19H19V12.05l2-2V19q0,0.82-0.59,1.41T19,21H5Zm7-9ZM9,15V10.75l9.18-9.18q0.3-0.3 0.68-0.45q0.38-0.15 0.75-0.15q0.4,0 0.76,0.15q0.36,0.15 0.66,0.45L22.43,3q0.28,0.3 0.43,0.66T23,4.4T22.86,5.14T22.43,5.8L13.25,15H9ZM21.03,4.4L19.63,3l1.4,1.4ZM11,13h1.4l5.8-5.8L17.5,6.5L16.78,5.8L11,11.58V13Zm6.5-6.5L16.78,5.8L17.5,6.5l0.7,0.7L17.5,6.5Z" />
                                </svg>
                            </td>
                        </tr>
                    @endif
                @endforeach
            @endif
        </tbody>
    </table>
    <div class="bg-modal">
        <div class="modal">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" height="24px" width="24px" class="svg-close"
                onclick="window.closeModal()">
                <path
                    d="M6.4,19L5,17.6L10.6,12L5,6.4L6.4,5L12,10.6L17.6,5L19,6.4L13.4,12L19,17.6L17.6,19L12,13.4L6.4,19Z" />
            </svg>
            <div class="edit-data">
                <div class="group-edit-data"">
                    <h2>Jenis: </h2>
                    <select name="jenis" id="jenis-barang">
                        <option value="P">Peripheral</option>
                        <option value="I">Custom Item</option>
                        <option value="C">Cooler</option>
                        <option value="L">Laptop</option>
                        <option value="S">Smartphone</option>
                        <option value="A">Accessories</option>
                    </select>
                </div>
                <div class="group-edit-data">
                    <h2>Nama: </h2>
                    <input type="text" id="nama-barang">
                </div>
            </div>
        </div>
    </div>
    @script
        <script>
            let modal
            document.addEventListener('click', (event) => {
                modal = event.target.closest('.datarow')

                if (modal) {
                }
            })

            window.showModal = () => {
                let bgModal = document.querySelector('.bg-modal')
                let namaBarang = document.querySelector('.nama-barang')

                console.log(modal)
                // namaBarang.value = modal.querySelector('td:nth-child(2)')

                console.log('clicked')
                bgModal.style.display = 'flex'

            }

            window.closeModal = () => {
                let bgModal = document.querySelector('.bg-modal')
                bgModal.style.display = 'none'
            }

            document.addEventListener('click', () => {
                console.log('tes')
            })
        </script>
    @endscript
</div>

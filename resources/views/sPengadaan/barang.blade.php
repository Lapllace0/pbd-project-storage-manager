<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/SAdmin.css'])
</head>

<body>
    @if (session('success'))
        <div class="flash-container-berhasil">
            <h4 class="flash-message">
                {{ session('success') }}
            </h4>
        </div>
    @elseif (session('failed'))
        <div class="flash-container-gagal">
            <h4 class="flash-message">
                {{ session('failed') }}
            </h4>
        </div>
    @endif
    <div class="navbar">
    </div>
    <div class="layout-container">
        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3"
            id="svg-a">
            <path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z" />
        </svg>
        <h1 class="username-role">{{ session('username') }} ({{ session('namaRole') }})</h1>
        <form action="/logout" method="POST">
            <button id="btn-logout" type="submit">Log out</button>
        </form>
        <aside class="sidebar" id="sidebar">
            <div>
                <ul>
                    <li>
                        <a href="{{ route('dashboard') }}" class="btn">Dashboard</a>
                    </li>
                    <li>
                        <a href="{{ route('getBarang', ['all', 1]) }}" class="btn btn-active">Barang</a>
                    </li>
                    <li>
                        <a href="{{ route('getKartuStok', ['all', 1]) }}" class="btn">Kartu Stok</a>
                    </li>
                    <li>
                        <a href="{{ route('getMarginPenjualan', ['all', 1]) }}" class="btn">Margin</a>
                    </li>
                    <li>
                        <a href="{{ route('getSatuan', ['all', 1]) }}" class="btn">Satuan</a>
                    </li>
                    <li>
                        <a href="{{ route('getVendor', ['all', 1]) }}" class="btn">Vendor</a>
                    </li>
                    <li>
                        <a href="{{ route('getPengadaan', ['all', 1]) }}" class="btn">Pengadaan</a>
                    </li>
                </ul>
            </div>
        </aside>

        <main class="main-content">
            <div class="position">

                <div class="navPanel">
                    <a href="{{ route('getBarang', [$nextFilter, 1]) }}" class="button-filter">{{ $filter }}</a>
                    <div class="navPage">
                        <h5 class="page">PAGE: {{ $page }}</h5>
                        @if ($page == 1)
                            <a class="disabled-button">Prev</a>
                            {{-- <button wire:click="getPrev" disabled class="prevPage">prev</button> --}}
                        @else
                            <a href="{{ route('getBarang', [$filter, $page - 1]) }}" class="prevPage">Prev</a>
                            {{-- <button wire:click="getPrev" class="prevPage">prev</button> --}}
                        @endif
                        @if ($nextData[0]->total < 1)
                            <a class="disabled-button">Next</a>
                            {{-- <button wire:click="getNext" disabled class="nextPage">next</button> --}}
                        @else
                            <a href="{{ route('getBarang', [$filter, $page + 1]) }}" class="nextPage">Next</a>
                            {{-- <button wire:click="getNext" class="nextPage">next</button> --}}
                        @endif
                    </div>
                </div>

                <table class="table">
                    <thead class="thead">
                        <tr>
                            <th>Jenis</th>
                            <th>Nama</th>
                            <th>Satuan</th>
                            <th>Harga</th>
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
                                    </tr>
                                @else
                                    <tr class="trEven datarow" id="{{ $d->idBarang }}">
                                        <td>{{ $d->jenis }}</td>
                                        <td>{{ $d->Nama }}</td>
                                        <td>{{ $d->Satuan }}</td>
                                        <td>{{ $d->Harga }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        @endif
                    </tbody>
                </table>
                <div class="bg-modal">
                    <div class="modal">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" height="24px" width="24px"
                            class="svg-close" onclick="closeModal()">
                            <path
                                d="M6.4,19L5,17.6L10.6,12L5,6.4L6.4,5L12,10.6L17.6,5L19,6.4L13.4,12L19,17.6L17.6,19L12,13.4L6.4,19Z" />
                        </svg>
                        <form action="/barang/action" method="POST" class="edit-data">
                            @csrf
                            <input type="hidden" value="{{ $filter }}" name="filter">
                            <input type="hidden" value="" id="idBarang" name="id">
                            <div class="group-edit-data"">
                                <div class="data-title">
                                    <h2>Jenis</h2>
                                    <h2>:</h2>
                                </div>
                                <select name="jenis" id="jenisBarang" class="input-form" required>
                                    <option value="" class="input-default-value" disabled hidden>select</option>
                                    <option value="P">Peripheral</option>
                                    <option value="I">Custom Item</option>
                                    <option value="C">Cooler</option>
                                    <option value="L">Laptop</option>
                                    <option value="S">Smartphone</option>
                                    <option value="A">Accessories</option>
                                </select>
                            </div>
                            <div class="group-edit-data">
                                <h2 class="data-title">Nama <span class="separator">:</span></h2>
                                <input type="text" class="text-edit input-form" id="namaBarang" name="nama"
                                    required>
                            </div>
                            <div class="group-edit-data"">
                                <div class="data-title">
                                    <h2>Satuan</h2>
                                    <h2>:</h2>
                                </div>
                                <select name="satuan" id="satuanBarang" class="input-form" required>
                                    <option value="" class="input-default-value" disabled hidden>select</option>
                                    @foreach ($status as $s)
                                        <option value="{{ $s->idSatuan }}">{{ $s->nama_satuan }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="group-edit-data">
                                <h2 class="data-title">Harga <span class="separator">:</span></h2>
                                <input name="harga" type="number" class="text-edit input-form" id="hargaBarang"
                                    required>
                            </div>
                            <div class="group-edit-data"">
                                <div class="data-title">
                                    <h2>Status</h2>
                                    <h2>:</h2>
                                </div>
                                <select name="status" id="statusBarang" class="input-form" required>
                                    <option value="" class="input-default-value" disabled hidden>select</option>
                                    <option value="1">active</option>
                                    <option value="0">nonactive</option>
                                </select>
                            </div>
                            <div class="button-form-edit">
                                <button type="submit" name="action" value="update"
                                    class="update-data">Update</button>
                            </div>
                            <div class="button-form-add">
                                <button type="submit" name="action" value="add" class="add-data">Add
                                    Data</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        let data = document.getElementById('svg-a')
        let sidebar = document.getElementById('sidebar')


        document.addEventListener('DOMContentLoaded', () => {
            let flashSuccess = document.querySelector('.flash-container-berhasil')
            let flashFailed = document.querySelector('.flash-container-gagal')
            if (flashSuccess) {
                console.log('updet berhasil')
                flashSuccess.classList.add('flash-remove')
                flashSuccess.addEventListener('transitioned', () => {
                    flashSuccess.remove()
                })
            }
            if (flashFailed) {
                flashFailed.classList.add('flash-remove')
                flashFailed.addEventListener('transitioned', () => {
                    flashSuccess.remove()
                })
            }


        })

        data.addEventListener('click', () => {
            if (sidebar.style.display != 'none') {
                sidebar.style.display = 'none'
            } else {
                sidebar.style.display = 'block'
            }

        })


        function showModal(id, jenis, nama, satuan, harga, status) {
            let bgModal = document.querySelector('.bg-modal')
            let buttonAdd = document.querySelector('.button-form-add')
            let buttonEdit = document.querySelector('.button-form-edit')
            // let defaultSelect = document.querySelectorAll('.input-default-value')
            // defaultSelect.forEach(element => {
            //     element.style.display = 'none'
            // });

            bgModal.style.display = 'flex'
            buttonAdd.style.display = 'none'
            buttonEdit.style.display = 'flex'

            let idBarang = document.getElementById('idBarang')

            let jenisBarang = document.getElementById('jenisBarang')
            let opsiJenis = Array.from(jenisBarang.options).find(opsi => opsi.text == jenis)

            let namaBarang = document.getElementById('namaBarang')

            let satuanBarang = document.getElementById('satuanBarang')
            let opsiSatuan = Array.from(satuanBarang.options).find(opsi => opsi.text == satuan)


            let hargaBarang = document.getElementById('hargaBarang')
            let statusBarang = document.getElementById('statusBarang')
            idBarang.value = id
            jenisBarang.value = opsiJenis.value
            namaBarang.value = nama
            satuanBarang.value = opsiSatuan.value
            hargaBarang.value = harga
            statusBarang.value = status
        }

        function showModalAdd() {
            let bgModal = document.querySelector('.bg-modal')
            let buttonEdit = document.querySelector('.button-form-edit')
            let inputForm = document.querySelectorAll('.input-form')
            let buttonAdd = document.querySelector('.button-form-add')
            bgModal.style.display = 'flex'
            buttonEdit.style.display = 'none'
            buttonAdd.style.display = 'flex'

            inputForm.forEach(element => {
                element.value = ''
            })

        }

        function closeModal() {
            let bgModal = document.querySelector('.bg-modal')
            bgModal.style.display = 'none'
        }
    </script>
</body>

</html>

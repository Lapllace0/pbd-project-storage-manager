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
                        <a href="{{ route('getBarang', ['all', 1]) }}" class="btn">Barang</a>
                    </li>
                    <li>
                        <a href="{{ route('getKartuStok', ['all', 1]) }}" class="btn btn-active">Kartu Stok</a>
                    </li>
                    <li>
                        <a href="{{ route('getMarginPenjualan', ['all', 1]) }}" class="btn">Margin</a>
                    </li>
                    <li>
                        <a href="{{ route('getSatuan', ['all', 1]) }}" class="btn">Satuan</a>
                    </li>
                    <li>
                        <a href="{{ route('getPenjualan', 1) }}" class="btn">Penjualan</a>
                    </li>
                </ul>
            </div>
        </aside>

        <main class="main-content">
            <div class="position">

                <div class="navPanel">
                    <a href="{{ route('getKartuStok', [$nextFilter, 1]) }}"
                        class="button-filter">{{ $filter }}</a>
                    <div class="navPage">
                        <h5 class="page">PAGE: {{ $page }}</h5>
                        @if ($page == 1)
                            <a class="disabled-button">Prev</a>
                        @else
                            <a href="{{ route('getKartuStok', [$filter, $page - 1]) }}" class="prevPage">Prev</a>
                        @endif
                        @if ($nextData[0]->total < 1)
                            <a class="disabled-button">Next</a>
                        @else
                            <a href="{{ route('getKartuStok', [$filter, $page + 1]) }}" class="nextPage">Next</a>
                        @endif
                    </div>
                </div>

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
                            <th>Nama Barang</th>
                        </tr>
                    </thead>
                    <tbody class="tbody">
                        @if ($data)
                            @foreach ($data as $d)
                                @if ($loop->iteration % 2 == 1)
                                    <tr class="trOdd datarow" id="{{ $d->id_stok }}">
                                        <td>{{ $d->id_stok }}</td>
                                        <td>{{ $d->jenis_transaksi }}</td>
                                        <td>{{ $d->masuk }}</td>
                                        <td>{{ $d->keluar }}</td>
                                        <td>{{ $d->stock }}</td>
                                        <td>{{ $d->created_at }}</td>
                                        <td>{{ $d->idTransaksi }}</td>
                                        <td>{{ $d->namaBarang }}</td>
                                    </tr>
                                @else
                                    <tr class="trEven datarow" id="{{ $d->id_stok }}">
                                        <td>{{ $d->id_stok }}</td>
                                        <td>{{ $d->jenis_transaksi }}</td>
                                        <td>{{ $d->masuk }}</td>
                                        <td>{{ $d->keluar }}</td>
                                        <td>{{ $d->stock }}</td>
                                        <td>{{ $d->created_at }}</td>
                                        <td>{{ $d->idTransaksi }}</td>
                                        <td>{{ $d->namaBarang }}</td>
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
                        <form action="/kartu-stok/action" method="POST" class="edit-data">
                            @csrf
                            <input type="hidden" value="{{ $filter }}" name="filter">
                            <input type="hidden" value="" id="idStok" name="id">
                            <div class="group-edit-data"">
                                <div class="data-title">
                                    <h2>Jenis Transaksi</h2>
                                    <h2>:</h2>
                                </div>
                                <select name="jenisTransaksi" id="jenisTransaksi" class="input-form" required>
                                    <option value="" class="input-default-value" disabled hidden>select</option>
                                    <option value="m">Penerimaan</option>
                                    <option value="j">Penjualan</option>
                                    <option value="r">Retur</option>
                                </select>
                            </div>
                            <div class="group-edit-data">
                                <h2 class="data-title">Masuk<span class="separator">:</span></h2>
                                <input type="number" class="input-form" id="masuk" name="masuk" value="0"
                                    required>
                            </div>
                            <div class="group-edit-data">
                                <h2 class="data-title">Keluar<span class="separator">:</span></h2>
                                <input type="number" class="input-form" id="keluar" name="keluar"
                                    value="0" required>
                            </div>
                            <div class="group-edit-data">
                                <h2 class="data-title">Id Transaksi<span class="separator">:</span></h2>
                                <input type="number" class="input-form" id="idTransaksi" name="idTransaksi"
                                    value="" required>
                            </div>
                            <div class="group-edit-data"">
                                <h2 class="data-title">Nama Barang <span class="separator">:</span></h2>
                                <select name="idBarang" id="idBarang" class="input-form input-nama-barang" required>
                                    <option value="" class="input-default-value" disabled hidden>select</option>
                                    @foreach ($dataBarang as $d)
                                        <option value="{{ $d->idBarang }}">{{ $d->nama }}</option>
                                    @endforeach
                                </select>
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

        data.addEventListener('click', () => {
            if (sidebar.style.display != 'none') {
                sidebar.style.display = 'none'
            } else {
                sidebar.style.display = 'block'
            }

        })
    </script>
</body>

</html>

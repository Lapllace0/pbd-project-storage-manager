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
        <aside class="sidebar" id="sidebar">
            <div>
                <ul>
                    <li>
                        <a href="{{ route('getBarang', ['all', 1]) }}" class="btn">Barang</a>
                    </li>
                    <li>
                        <a href="{{ route('getUser', 1) }}" class="btn">Users</a>
                    </li>
                    <li>
                        <a href="{{ route('getVendor', ['all', 1]) }}" class="btn">Vendor</a>
                    </li>
                    <li>
                        <a href="{{ route('getRole', 1) }}" class="btn">Role</a>
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
                        <a href="{{ route('getPenerimaan', ['all', 1]) }}" class="btn">Penerimaan</a>
                    </li>
                    <li>
                        <a href="{{ route('getPengadaan', ['all', 1]) }}" class="btn">Pengadaan</a>
                    </li>
                    <li>
                        <a href="{{ route('getPenjualan', 1) }}" class="btn  btn-active">Penjualan</a>
                    </li>
                </ul>
            </div>
        </aside>

        <main class="main-content">
            <h3 class="container-kembali"><a href="{{ route('getPenjualan', ['all', 1]) }}" class="kembali">< Kembali</a></h3>
            <div class="detail-position">

                <div class="table-title">Detail Penjualan</div>

                <div class="navPanel">
                    <div class="table-id">
                        <div>Id Penjualan: <span id="idPengadaan">{{$idPenjualan}}</span></div>
                    </div>
                    <div class="navPage">
                        <h5 class="page">PAGE: {{ $page }}</h5>
                        @if ($page == 1)
                            <a class="disabled-button">Prev</a>
                        @else
                            <a href="{{ route('getDetailPenjualan', [$idPenjualan, $page - 1]) }}"
                                class="prevPage">Prev</a>
                        @endif
                        @if ($nextData[0]->total < 1)
                            <a class="disabled-button">Next</a>
                        @else
                            <a href="{{ route('getDetailPenjualan', [$idPenjualan, $page + 1]) }}"
                                class="nextPage">Next</a>
                        @endif
                    </div>
                    {{-- <button type="button" onclick="showModalDelete(@js($idPengadaan))" class="hapus-pengadaan">Hapus Pengadaan</button> --}}

                </div>

                <table class="table">
                    <thead class="thead">
                        <tr>
                            <th>Id Detail Penjualan</th>
                            <th>Nama Barang</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>SubTotal</th>
                            <th>Id Penjualan</th>
                        </tr>
                    </thead>
                    <tbody class="tbody">
                        @if ($data)
                            @foreach ($data as $d)
                                @if ($loop->iteration % 2 == 1)
                                    <tr class="trOdd datarow" id="{{ $d->idDetail_penjualan }}">
                                        <td>{{ $d->idDetail_penjualan }}</td>
                                        <td>{{ $d->namaBarang }}</td>
                                        <td>{{ $d->harga }}</td>
                                        <td>{{ $d->jumlah }}</td>
                                        <td>{{ $d->subTotal }}</td>
                                        <td>{{ $d->idPenjualan }}</td>
                                    </tr>
                                @else
                                    <tr class="trEven datarow" id="{{ $d->idDetail_penjualan }}">
                                        <td>{{ $d->idDetail_penjualan }}</td>
                                        <td>{{ $d->namaBarang }}</td>
                                        <td>{{ $d->harga }}</td>
                                        <td>{{ $d->jumlah }}</td>
                                        <td>{{ $d->subTotal }}</td>
                                        <td>{{ $d->idPenjualan }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <script>
        let data = document.getElementById('svg-a')
        let sidebar = document.getElementById('sidebar')
        let navPage = document.querySelector('.navPage')


        document.addEventListener('DOMContentLoaded', () => {
            let flashSuccess = document.querySelector('.flash-container-berhasil')
            let flashFailed = document.querySelector('.flash-container-gagal')
            if (flashSuccess) {
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

    </script>
</body>

</html>

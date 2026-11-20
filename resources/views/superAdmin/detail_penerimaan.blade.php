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
                        <a href="{{ route('getPenerimaan', ['all', 1]) }}" class="btn btn-active">Penerimaan</a>
                    </li>
                    <li>
                        <a href="{{ route('getPengadaan', ['all', 1]) }}" class="btn">Pengadaan</a>
                    </li>
                    <li>
                        <a href="{{ route('getPenjualan', 1) }}" class="btn">Penjualan</a>
                    </li>
                </ul>
            </div>
        </aside>

        <main class="main-content">
            <h3 class="container-kembali"><a href="{{ route('getPenerimaan', ['all', 1]) }}" class="kembali">
                    < Kembali</a>
            </h3>
            <div class="detail-position">

                <div class="table-title">Detail Penerimaan</div>

                <div class="navPanel">
                    <div class="table-id">
                        <div>Id Penerimaan: <span id="idPenerimaan">{{ $idPenerimaan }}</span></div>
                    </div>
                    <div class="navPage">
                        <h5 class="page">PAGE: {{ $page }}</h5>
                        @if ($page == 1)
                            <a class="disabled-button">Prev</a>
                        @else
                            <a href="{{ route('getDetailPenerimaan', [$idPenerimaan, $page - 1]) }}"
                                class="prevPage">Prev</a>
                        @endif
                        @if ($nextData[0]->total < 1)
                            <a class="disabled-button">Next</a>
                        @else
                            <a href="{{ route('getDetailPenerimaan', [$idPenerimaan, $page + 1]) }}"
                                class="nextPage">Next</a>
                        @endif
                    </div>
                    {{-- <button type="button" onclick="showModalDelete(@js($idPengadaan))" class="hapus-pengadaan">Hapus Pengadaan</button> --}}
                </div>

                <table class="table">
                    <thead class="thead">
                        <tr>
                            <th>Id Detail Penerimaan</th>
                            <th>Nama Barang</th>
                            <th>Jumlah Terima</th>
                            <th>Harga Satuan Terima</th>
                            <th>Subtotal Terima</th>
                        </tr>
                    </thead>
                    <tbody class="tbody">
                        @if ($data)
                            @foreach ($data as $d)
                                @if ($loop->iteration % 2 == 1)
                                    <tr class="trOdd datarow" id="{{ $d->idDetail_penerimaan }}">
                                        <td>{{ $d->idDetail_penerimaan }}</td>
                                        <td>{{ $d->nama }}</td>
                                        <td>{{ $d->jumlah_terima }}</td>
                                        <td>{{ $d->harga_satuan_terima }}</td>
                                        <td>{{ $d->sub_total_terima }}</td>
                                    </tr>
                                @else
                                    <tr class="trEven datarow" id="{{ $d->idDetail_penerimaan }}">
                                        <td>{{ $d->idDetail_penerimaan }}</td>
                                        <td>{{ $d->nama }}</td>
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
                flashSuccess.addEventListener('transitionend', () => {
                    flashSuccess.remove()
                })
            }
            if (flashFailed) {
                flashFailed.classList.add('flash-remove')
                flashFailed.addEventListener('transitionend', () => {
                    flashFailed.remove()
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

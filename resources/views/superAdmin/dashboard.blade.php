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
                        <a href="{{route('getBarang', ['all', 1])}}" class="btn">Barang</a>
                    </li>
                    <li>
                        <a href="{{route('getUser', 1)}}" class="btn">Users</a>
                    </li>
                    <li>
                        <a href="{{route('getVendor', ['all',1])}}" class="btn">Vendor</a>
                    </li>
                    <li>
                        <a href="{{route('getRole', 1)}}" class="btn">Role</a>
                    </li>
                    <li>
                        <a href="{{route('getKartuStok', ['all',1])}}" class="btn">Kartu Stok</a>
                    </li>
                    <li>
                        <a href="{{route('getMargin', 1)}}" class="btn">Margin</a>
                    </li>
                    <li>
                        <a href="{{route('getSatuan', 1)}}" class="btn">Satuan</a>
                    </li>
                    <li>
                        <a href="{{route('getPenerimaan', ['all',1])}}" class="btn">Penerimaan</a>
                    </li>
                    <li>
                        <a href="{{route('getDetailPenerimaan', ['all',1])}}" class="btn">Detail Penerimaan</a>
                    </li>
                    <li>
                        <a href="{{route('getPengadaan', ['all',1])}}" class="btn">Pengadaan</a>
                    </li>
                    <li>
                        <a href="{{route('getDetailPengadaan', ['all',1])}}" class="btn">Detail Pengadaan</a>
                    </li>
                    <li>
                        <a href="{{route('getPenjualan', ['all',1])}}" class="btn">Penjualan</a>
                    </li>
                    <li>
                        <a href="{{route('getDetailPenjualan', ['all', 1])}}" class="btn ">Detail Penjualan</a>
                    </li>
                    <li>
                        <a href="{{route('getRetur', 1)}}" class="btn">Retur</a>
                    </li>
                    <li>
                        <a href="{{route('getDetailRetur', 1)}}" class="btn">Detail Retur</a>
                    </li>
                </ul>
            </div>
        </aside>

        <main class="main-content">
            <div>
                <h1 class="welcome">Selamat Datang Admin</h1>
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

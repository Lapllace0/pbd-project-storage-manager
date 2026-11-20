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
                        <a href="{{ route('getSatuan', ['all', 1]) }}" class="btn  btn-active">Satuan</a>
                    </li>
                    <li>
                        <a href="{{ route('getPenerimaan', ['all', 1]) }}" class="btn">Penerimaan</a>
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
            <div class="position">

                <div class="navPanel">
                    <a href="{{ route('getSatuan', [$nextFilter, 1]) }}" class="button-filter">{{ $filter }}</a>
                    <div class="navPage">
                        <h5 class="page">PAGE: {{ $page }}</h5>
                        @if ($page == 1)
                            <a class="disabled-button">Prev</a>
                        @else
                            <a href="{{ route('getSatuan', [$filter, $page - 1]) }}" class="prevPage">Prev</a>
                        @endif
                        @if ($nextData[0]->total < 1)
                            <a class="disabled-button">Next</a>
                        @else
                            <a href="{{ route('getSatuan', [$filter, $page + 1]) }}" class="nextPage">Next</a>
                        @endif
                    </div>
                </div>

                <table class="table">
                    <thead class="thead">
                        <tr>
                            <th>Id Satuan</th>
                            <th>Nama Satuan</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody class="tbody">
                        @if ($data)
                            @foreach ($data as $d)
                                @if ($loop->iteration % 2 == 1)
                                    <tr class="trOdd datarow" id="{{ $d->idSatuan }}">
                                        <td>{{ $d->idSatuan }}</td>
                                        <td>{{ $d->nama_satuan }}</td>
                                        <td>{{ $d->des_status }}</td>
                                    </tr>
                                @else
                                    <tr class="trEven datarow" id="{{ $d->idSatuan }}">
                                        <td>{{ $d->idSatuan }}</td>
                                        <td>{{ $d->nama_satuan }}</td>
                                        <td>{{ $d->des_status }}</td>
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
                        <form action="/satuan/action" method="POST" class="edit-data">
                            @csrf
                            <input type="hidden" value="" id="idSatuan" name="idSatuan">
                            <div class="group-edit-data">
                                <h2 class="data-title">Nama Satuan <span class="separator">:</span></h2>
                                <input type="text" class="text-edit input-form" id="namaSatuan" name="namaSatuan"
                                    required>
                            </div>
                            <div class="group-edit-data"">
                                <div class="data-title">
                                    <h2>Status</h2>
                                    <h2>:</h2>
                                </div>
                                <select name="status" id="status" class="input-form" required>
                                    <option value="" class="input-default-value" disabled hidden selected>select
                                    </option>
                                    <option value="1" class="input-default-value">Active
                                    </option>
                                    <option value="0" class="input-default-value">
                                        NonActive
                                    </option>
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


        function showModal(p_idSatuan, p_namaSatuan, p_status) {
            let bgModal = document.querySelector('.bg-modal')
            let buttonAdd = document.querySelector('.button-form-add')
            let buttonEdit = document.querySelector('.button-form-edit')
            let idSatuan = document.getElementById('idSatuan')

            bgModal.style.display = 'flex'
            buttonAdd.style.display = 'none'
            buttonEdit.style.display = 'flex'

            let namaSatuan = document.getElementById('namaSatuan')
            let status = document.getElementById('status')

            let selectedStatus = Array.from(status.options).find(opsi => {
                return opsi.value == p_status
            })
            if (!(selectedStatus == null)) {
                status.value = selectedStatus.value
            }

            idSatuan.value = p_idSatuan
            namaSatuan.value = p_namaSatuan
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

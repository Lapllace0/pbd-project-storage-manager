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
                        <a href="{{ route('getVendor', ['all', 1]) }}" class="btn btn-active">Vendor</a>
                    </li>
                    <li>
                        <a href="{{ route('getRole', 1) }}" class="btn">Role</a>
                    </li>
                    <li>
                        <a href="{{ route('getKartuStok', ['all', 1]) }}" class="btn">Kartu Stok</a>
                    </li>
                    <li>
                        <a href="{{ route('getMargin', 1) }}" class="btn">Margin</a>
                    </li>
                    <li>
                        <a href="{{ route('getSatuan', 1) }}" class="btn">Satuan</a>
                    </li>
                    <li>
                        <a href="{{ route('getPenerimaan', ['all',1]) }}" class="btn">Penerimaan</a>
                    </li>
                    <li>
                        <a href="{{ route('getDetailPenerimaan', ['all',1]) }}" class="btn">Detail Penerimaan</a>
                    </li>
                    <li>
                        <a href="{{ route('getPengadaan', ['all',1]) }}" class="btn">Pengadaan</a>
                    </li>
                    <li>
                        <a href="{{ route('getDetailPengadaan', ['all',1]) }}" class="btn">Detail Pengadaan</a>
                    </li>
                    <li>
                        <a href="{{ route('getPenjualan', ['all', 1]) }}" class="btn">Penjualan</a>
                    </li>
                    <li>
                        <a href="{{ route('getDetailPenjualan', ['all', 1]) }}" class="btn">Detail Penjualan</a>
                    </li>
                    <li>
                        <a href="{{ route('getRetur', 1) }}" class="btn">Retur</a>
                    </li>
                    <li>
                        <a href="{{ route('getDetailRetur', 1) }}" class="btn">Detail Retur</a>
                    </li>
                </ul>
            </div>
        </aside>

        <main class="main-content">
            <div class="position">

                <div class="navPanel">
                    <a href="{{ route('getVendor', [$nextFilter, 1]) }}" class="button-filter">{{ $filter }}</a>
                    <div class="navPage">
                        <h5 class="page">PAGE: {{ $page }}</h5>
                        @if ($page == 1)
                            <a class="disabled-button">Prev</a>
                        @else
                            <a href="{{ route('getVendor', [$filter, $page - 1]) }}" class="prevPage">Prev</a>
                        @endif
                        @if ($nextData[0]->total < 1)
                            <a class="disabled-button">Next</a>
                        @else
                            <a href="{{ route('getVendor', [$filter, $page + 1]) }}" class="nextPage">Next</a>
                        @endif
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="add-button"
                        onclick="showModalAdd()">
                        <path
                            d="M11,17h2V13h4V11H13V7H11v4H7v2h4v4ZM5,21q-0.83,0-1.41-0.59T3,19V5Q3,4.17 3.59,3.59T5,3H19q0.83,0 1.41,0.59T21,5V19q0,0.82-0.59,1.41T19,21H5Zm0-2H19V5H5V19ZM5,5V19V5Z" />
                    </svg>
                </div>

                <table class="table">
                    <thead class="thead">
                        <tr>
                            <th>Nama Vendor</th>
                            <th>Badan Hukum</th>
                            <th>Status</th>
                            <th class="editData">edit</th>
                        </tr>
                    </thead>
                    <tbody class="tbody">
                        @if ($data)
                            @foreach ($data as $d)
                                @if ($loop->iteration % 2 == 1)
                                    <tr class="trOdd datarow" id="{{ $d->idVendor }}">
                                        <td>{{ $d->nama_vendor }}</td>
                                        <td>{{ $d->nama_badan_hukum }}</td>
                                        <td>{{ $d->status }}</td>
                                        <td><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" height="24px"
                                                width="24px" class="svgEdit"
                                                onclick="showModal(@js($d->idVendor),@js($d->nama_vendor),@js($d->nama_badan_hukum),@js($d->kode_badan_hukum),@js($d->status))">
                                                <path
                                                    d="M5,21q-0.83,0-1.41-0.59T3,19V5Q3,4.17 3.59,3.59T5,3h8.93l-2,2H5V19H19V12.05l2-2V19q0,0.82-0.59,1.41T19,21H5Zm7-9ZM9,15V10.75l9.18-9.18q0.3-0.3 0.68-0.45q0.38-0.15 0.75-0.15q0.4,0 0.76,0.15q0.36,0.15 0.66,0.45L22.43,3q0.28,0.3 0.43,0.66T23,4.4T22.86,5.14T22.43,5.8L13.25,15H9ZM21.03,4.4L19.63,3l1.4,1.4ZM11,13h1.4l5.8-5.8L17.5,6.5L16.78,5.8L11,11.58V13Zm6.5-6.5L16.78,5.8L17.5,6.5l0.7,0.7L17.5,6.5Z" />
                                            </svg>
                                        </td>
                                    </tr>
                                @else
                                    <tr class="trEven datarow" id="{{ $d->idVendor }}">
                                        <td>{{ $d->nama_vendor }}</td>
                                        <td>{{ $d->nama_badan_hukum }}</td>
                                        <td>{{ $d->status }}</td>
                                        <td><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" height="24px"
                                                width="24px" class="svgEdit"
                                                onclick="showModal(@js($d->idVendor),@js($d->nama_vendor),@js($d->nama_badan_hukum),@js($d->kode_badan_hukum), @js($d->status))">
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
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" height="24px" width="24px"
                            class="svg-close" onclick="closeModal()">
                            <path
                                d="M6.4,19L5,17.6L10.6,12L5,6.4L6.4,5L12,10.6L17.6,5L19,6.4L13.4,12L19,17.6L17.6,19L12,13.4L6.4,19Z" />
                        </svg>
                        <form action="/vendor/action" method="POST" class="edit-data">
                            @csrf
                            <input type="hidden" value="{{ $filter }}" name="filter">
                            <input type="hidden" value="" id="idVendor" name="id">

                            <div class="group-edit-data">
                                <h2 class="data-title">Nama Vendor<span class="separator">:</span></h2>
                                <input type="text" class="text-edit input-form" id="namaVendor" name="namaVendor"
                                    required>
                            </div>

                            <div class="group-edit-data"">
                                <div class="data-title">
                                    <h2>Badan Hukum</h2>
                                    <h2>:</h2>
                                </div>
                                <select name="badanHukum" id="badanHukum" class="input-form" required>
                                    <option value="" class="input-default-value" disabled hidden selected>select
                                    </option>
                                    <option value="A">PT</option>
                                    <option value="B">PT Perorangan</option>
                                    <option value="C">CV</option>
                                    <option value="F">Firma</option>
                                </select>
                            </div>

                            <div class="group-edit-data"">
                                <div class="data-title">
                                    <h2>Status</h2>
                                    <h2>:</h2>
                                </div>
                                <select name="status" id="statusVendor" class="input-form" required>
                                    <option value="" class="input-default-value" disabled hidden selected>select
                                    </option>
                                    <option value="1">active</option>
                                    <option value="0">nonactive</option>
                                </select>
                            </div>
                            <div class="button-form-edit">
                                <button type="submit" name="action" value="delete"
                                    class="delete-data">Delete</button>
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


        function showModal(p_id, p_nama, p_badanHukum, p_kodeBadanHukum, p_status) {
            let bgModal = document.querySelector('.bg-modal')
            let buttonAdd = document.querySelector('.button-form-add')
            let buttonEdit = document.querySelector('.button-form-edit')

            bgModal.style.display = 'flex'
            buttonAdd.style.display = 'none'
            buttonEdit.style.display = 'flex'

            let id = document.getElementById('idVendor')
            let namaVendor = document.getElementById('namaVendor')
            let badanHukum = document.getElementById('badanHukum')
            let statusVendor = document.getElementById('statusVendor')

            id.value = p_id
            namaVendor.value = p_nama

            let opsiBadanHukum = Array.from(badanHukum.options).find(opsi => opsi.text == p_badanHukum)
            badanHukum.value = opsiBadanHukum.value

            let opsiStatus = Array.from(statusVendor.options).find(opsi => opsi.text == p_status)
            statusVendor.value = opsiStatus.value

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

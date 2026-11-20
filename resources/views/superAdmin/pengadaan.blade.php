<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/SAdmin.css', 'resources/js/app.js'])
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
                        <a href="{{ route('getPenerimaan', ['all', 1]) }}" class="btn">Penerimaan</a>
                    </li>
                    <li>
                        <a href="{{ route('getPengadaan', ['all', 1]) }}" class="btn btn-active">Pengadaan</a>
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
                    <a href="{{ route('getPengadaan', [$nextFilter, 1]) }}"
                        class="button-filter">{{ $filter }}</a>
                    <div class="navPage">
                        <h5 class="page">PAGE: {{ $page }}</h5>
                        @if ($page == 1)
                            <a class="disabled-button">Prev</a>
                        @else
                            <a href="{{ route('getPengadaan', [$filter, $page - 1]) }}" class="prevPage">Prev</a>
                        @endif
                        @if ($nextData[0]->total < 1)
                            <a class="disabled-button">Next</a>
                        @else
                            <a href="{{ route('getPengadaan', [$filter, $page + 1]) }}" class="nextPage">Next</a>
                        @endif
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="add-button"
                        onclick="showModalVendor()">
                        <path
                            d="M11,17h2V13h4V11H13V7H11v4H7v2h4v4ZM5,21q-0.83,0-1.41-0.59T3,19V5Q3,4.17 3.59,3.59T5,3H19q0.83,0 1.41,0.59T21,5V19q0,0.82-0.59,1.41T19,21H5Zm0-2H19V5H5V19ZM5,5V19V5Z" />
                    </svg>
                </div>

                <table class="table">
                    <thead class="thead">
                        <tr>
                            <th>Id Pengadaan</th>
                            <th>kapan Dibuat</th>
                            <th>Id User</th>
                            <th>id Vendor</th>
                            <th>Status</th>
                            <th>subTotal</th>
                            <th>Total</th>
                            <th class="editData">Detail</th>
                        </tr>
                    </thead>
                    <tbody class="tbody">
                        @if ($data)
                            @foreach ($data as $d)
                                @if ($loop->iteration % 2 == 1)
                                    <tr class="trOdd datarow" id="{{ $d->idPengadaan }}">
                                        <td>{{ $d->idPengadaan }}</td>
                                        <td>{{ $d->timestamp }}</td>
                                        <td>{{ $d->idUser }}</td>
                                        <td>{{ $d->idVendor }}</td>
                                        <td>{{ $d->ket_status }}</td>
                                        <td>{{ $d->subTotal_nilai }}</td>
                                        <td>{{ $d->total_nilai }}</td>
                                        <td> <a href="{{ route('getDetailPengadaan', [$d->idPengadaan, 1]) }}"
                                                class="detail-transaksi">Detail</a></td>
                                    </tr>
                                @else
                                    <tr class="trEven datarow" id="{{ $d->idPengadaan }}">
                                        <td>{{ $d->idPengadaan }}</td>
                                        <td>{{ $d->timestamp }}</td>
                                        <td>{{ $d->idUser }}</td>
                                        <td>{{ $d->idVendor }}</td>
                                        <td>{{ $d->ket_status }}</td>
                                        <td>{{ $d->subTotal_nilai }}</td>
                                        <td>{{ $d->total_nilai }}</td>
                                        <td> <a href="{{ route('getDetailPengadaan', [$d->idPengadaan, 1]) }}"
                                                class="detail-transaksi">Detail</a></td>
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
                        <form action="/pengadaan/action" method="POST" class="edit-data">
                            @csrf
                            <input type="hidden" value="{{ $filter }}" name="filter">
                            <input type="hidden" value="" id="dataArray" name="dataArray">
                            <h2 class="data-title" id="pilihVendor">Pilih Vendor</span></h2>
                            <select name="idVendor" id="idVendor" class="select-vendor-size" required>
                                @foreach ($vendor as $d)
                                    <option value="{{ $d->idVendor }}">{{ $d->nama_vendor }}</option>
                                @endforeach
                            </select>

                            <div class="add-form-dp">

                            </div>

                            <div class="button-form-chooseVendor">
                                <button type="button" onclick="showModalAdd()">Next Section</button>
                            </div>
                            <div class="button-form-edit">
                                <button type="submit" name="action" value="delete"
                                    class="delete-data">Delete</button>
                                <button type="submit" name="action" value="update"
                                    class="update-data">Update</button>
                            </div>
                            <div class="button-form-add">
                                <div class="change-page-form-button">
                                    <button onclick="getPreviousForm()" id="form-prev-button"
                                        type="button">previous</button>
                                    <button onclick="getNextForm()" id="form-next-button"
                                        type="button">next</button>
                                    <button type="submit" name="action" value="add" class="add-data"
                                        onclick="prepareSubmit()">Add
                                        All Data</button>
                                </div>
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

        let pageForm = 1
        let dataBarang = @js($barang)

        let dataInput = []
        let divInput = document.querySelector('.add-form-dp')


        function showModalVendor() {
            let bgModal = document.querySelector('.bg-modal')
            let buttonAdd = document.querySelector('.button-form-add')
            let buttonEdit = document.querySelector('.button-form-edit')
            let idVendor = document.getElementById('idVendor')
            let buttonVendor = document.querySelector('.button-form-chooseVendor')
            let pilihVendor = document.getElementById('pilihVendor')

            bgModal.style.display = 'flex'
            buttonAdd.style.display = 'none'
            buttonEdit.style.display = 'none'
            idVendor.style.display = 'flex'
            buttonVendor.style.display = 'flex'
            pilihVendor.style.display = 'block'

            divInput.innerHTML = ``
        }


        function showModalAdd() {
            let bgModal = document.querySelector('.bg-modal')
            let buttonEdit = document.querySelector('.button-form-edit')
            let inputForm = document.querySelectorAll('.input-form')
            let buttonAdd = document.querySelector('.button-form-add')
            let prevButton = document.getElementById('form-prev-button')
            let nextButton = document.getElementById('form-next-button')
            let idVendor = document.getElementById('idVendor')
            let buttonVendor = document.querySelector('.button-form-chooseVendor')
            let pilihVendor = document.getElementById('pilihVendor')
            pageForm = 1

            dataInput = []

            bgModal.style.display = 'flex'
            buttonEdit.style.display = 'none'
            buttonAdd.style.display = 'flex'
            idVendor.style.display = 'none'
            buttonVendor.style.display = 'none'
            pilihVendor.style.display = 'none'

            inputForm.forEach(element => {
                element.value = ''
            })

            let dataBarangHTML = ''
            dataBarang.forEach((data) => {
                dataBarangHTML += `<option value="${data.idBarang}">${data.nama}</option> `
            })

            divInput.innerHTML = `
            <div class="group-edit-data">
                                    <h2 class="data-title">Nama Barang <span class="separator">:</span></h2>
                                    <select name="idBarang" id="idBarang" class="input-form input-nama-barang input-page${pageForm}" required>
                                        <option value="" class="input-default-value" disabled selected hidden>select</option>
                                        ${dataBarangHTML}
                                    </select>
                                </div>
                                <div class="group-edit-data">
                                    <h2 class="data-title">Jumlah<span class="separator">:</span></h2>
                                    <input type="number" class="input-form input-page${pageForm}" id="jumlah" name="jumlah"
                                    value="0" required min='0'>
                                </div>
            `

            prevButton.disabled = true
            nextButton.disabled = true

            let inputNamaBarang = document.getElementById('idBarang')
            let inputJumlahBarang = document.getElementById('jumlah')

            let namaFilled = false
            let jumlahBarang = false
            inputNamaBarang.addEventListener('input', (e) => {
                if (e.target.value != '' && jumlahBarang == true) {
                    nextButton.disabled = false
                    console.log('tes')
                } else if (e.target.value != '') {
                    namaFilled = true
                }

            })

            inputJumlahBarang.addEventListener('input', (e) => {
                console.log(e.target.value)
                if (e.target.value != 0 && namaFilled == true && e.target.value != '') {
                    nextButton.disabled = false
                } else if (e.target.value != '' && e.target.value != 0) {
                    jumlahBarang = true
                } else {
                    jumlahBarang = false
                    nextButton.disabled = true
                }
            })
        }


        function getPreviousForm() {
            let inputNamaBarang = document.getElementById('idBarang')
            let inputJumlahBarang = document.getElementById('jumlah')
            let prevButton = document.getElementById('form-prev-button')
            let nextButton = document.getElementById('form-next-button')

            if (inputNamaBarang.value != '' && inputJumlahBarang.value != 0) {
                dataInput[pageForm - 1] = {
                    'idBarang': inputNamaBarang.value,
                    'jumlah': Number(inputJumlahBarang.value)
                }
            }

            pageForm -= 1

            if (pageForm > 1) {
                prevButton.disabled = false
            } else {
                prevButton.disabled = true
            }

            let dataBarangHTML = ''
            let totalBarang = 0
            if (dataInput[pageForm - 1] != undefined) {
                dataBarang.forEach((data) => {
                    if (dataInput[pageForm - 1].idBarang == data.idBarang) {
                        dataBarangHTML += `<option value="${data.idBarang}" selected>${data.nama}</option> `
                        totalBarang = Number(dataInput[pageForm - 1].jumlah)
                    } else {
                        dataBarangHTML += `<option value="${data.idBarang}">${data.nama}</option> `
                    }
                })
                divInput.innerHTML = `
                <div class="group-edit-data">
                    <h2 class="data-title">Nama Barang <span class="separator">:</span></h2>
                    <select name="idBarang" id="idBarang" class="input-form input-nama-barang input-page${pageForm}" required>
                        ${dataBarangHTML}
                        </select>
                        </div>
                        <div class="group-edit-data">
                            <h2 class="data-title">Jumlah<span class="separator">:</span></h2>
                            <input type="number" class="input-form input-page${pageForm}" id="jumlah" name="jumlah"
                            value="${totalBarang}" required min='0'>
                            </div>
                            `
            } else {
                dataBarang.forEach((data) => {
                    dataBarangHTML += `<option value="${data.idBarang}">${data.nama}</option> `
                })

                divInput.innerHTML = `
                            <div class="group-edit-data">
                                <h2 class="data-title">Nama Barang <span class="separator">:</span></h2>
                                <select name="idBarang" id="idBarang" class="input-form input-nama-barang input-page${pageForm}" required>
                                    <option value="" class="input-default-value" disabled selected hidden>select</option>
                                    ${dataBarangHTML}
                                    </select>
                                    </div>
                                    <div class="group-edit-data">
                                        <h2 class="data-title">Jumlah<span class="separator">:</span></h2>
                                        <input type="number" class="input-form input-page${pageForm}" id="jumlah" name="jumlah"
                                        value="0" required min='0'>
                                        </div>
                                        `
            }

            inputNamaBarang = document.getElementById('idBarang')
            inputJumlahBarang = document.getElementById('jumlah')

            let namaFilled = false
            let jumlahBarang = false
            inputNamaBarang.addEventListener('input', (e) => {
                if (e.target.value != '' && jumlahBarang == true) {
                    nextButton.disabled = false
                    console.log('tes')
                } else if (e.target.value != '') {
                    namaFilled = true
                }

            })

            if (dataInput.length >= pageForm) {
                nextButton.disabled = false
            } else {
                nextButton.disabled = true
                inputJumlahBarang.addEventListener('input', (e) => {
                    if (e.target.value != 0 && namaFilled == true && e.target.value != '') {
                        nextButton.disabled = false
                    } else if (e.target.value != '' && e.target.value != 0) {
                        jumlahBarang = true
                    } else {
                        jumlahBarang = false
                        nextButton.disabled = true
                    }
                })
            }
            console.log(dataInput)

        }

        function getNextForm() {
            let inputNamaBarang = document.getElementById('idBarang')
            let inputJumlahBarang = document.getElementById('jumlah')
            let prevButton = document.getElementById('form-prev-button')
            let nextButton = document.getElementById('form-next-button')

            dataInput[pageForm - 1] = {
                'idBarang': inputNamaBarang.value,
                'jumlah': Number(inputJumlahBarang.value)
            }
            pageForm += 1

            if (pageForm > 1) {
                prevButton.disabled = false
            }

            let dataBarangHTML = ''
            let totalBarang
            if (dataInput[pageForm - 1] != undefined) {
                dataBarang.forEach((data) => {
                    if (dataInput[pageForm - 1].idBarang == data.idBarang) {
                        dataBarangHTML += `<option value="${data.idBarang}" selected>${data.nama}</option> `
                        totalBarang = Number(dataInput[pageForm - 1].jumlah)
                    } else {
                        dataBarangHTML += `<option value="${data.idBarang}">${data.nama}</option> `
                    }
                })

                divInput.innerHTML = `
                <div class="group-edit-data">
                    <h2 class="data-title">Nama Barang <span class="separator">:</span></h2>
                    <select name="idBarang" id="idBarang" class="input-form input-nama-barang input-page${pageForm}" required>
                        ${dataBarangHTML}
                        </select>
                                        </div>
                                        <div class="group-edit-data">
                                            <h2 class="data-title">Jumlah<span class="separator">:</span></h2>
                                            <input type="number" class="input-form input-page${pageForm}" id="jumlah" name="jumlah"
                                            value="${totalBarang}" required min='0'>
                                            </div>
                                            `
            } else {
                dataBarang.forEach((data) => {
                    dataBarangHTML += `<option value="${data.idBarang}">${data.nama}</option> `
                })

                divInput.innerHTML = `
                <div class="group-edit-data">
                <h2 class="data-title">Nama Barang <span class="separator">:</span></h2>
                <select name="idBarang" id="idBarang" class="input-form input-nama-barang input-page${pageForm}" required>
                    <option value="" class="input-default-value" disabled selected hidden>select</option>
                    ${dataBarangHTML}
                    </select>
                    </div>
                    <div class="group-edit-data">
                        <h2 class="data-title">Jumlah<span class="separator">:</span></h2>
                        <input type="number" class="input-form input-page${pageForm}" id="jumlah" name="jumlah"
                        value="0" required min='0'>
                        </div>
                        `
            }
            inputNamaBarang = document.getElementById('idBarang')
            inputJumlahBarang = document.getElementById('jumlah')


            let namaFilled = false
            let jumlahBarang = false
            inputNamaBarang.addEventListener('input', (e) => {
                if (e.target.value != '' && jumlahBarang == true) {
                    nextButton.disabled = false
                    console.log('tesin')
                } else if (e.target.value != '') {
                    namaFilled = true
                }

            })

            if (dataInput.length >= pageForm) {
                nextButton.disabled = false
            } else {
                nextButton.disabled = true
                console.log('masuk')
                inputJumlahBarang.addEventListener('input', (e) => {
                    console.log(e.target.value)
                    if (e.target.value != 0 && namaFilled == true && e.target.value != '') {
                        nextButton.disabled = false
                        console.log('1')
                    } else if (e.target.value != '' && e.target.value != 0) {
                        jumlahBarang = true
                        console.log('2')
                    } else {
                        jumlahBarang = false
                        nextButton.disabled = true
                        console.log('3')
                    }
                })
            }

            console.log(dataInput)
        }

        function closeModal() {
            let bgModal = document.querySelector('.bg-modal')
            bgModal.style.display = 'none'
        }

        function prepareSubmit() {
            let inputNamaBarang = document.getElementById('idBarang')
            let inputJumlahBarang = document.getElementById('jumlah')
            let dataArray = document.getElementById('dataArray')

            if (inputJumlahBarang.value == 0) {
                inputJumlahBarang.value = ''
            }

            dataInput[pageForm - 1] = {
                'idBarang': inputNamaBarang.value,
                'jumlah': Number(inputJumlahBarang.value)
            }

            dataArray.value = JSON.stringify(dataInput)
        }
    </script>
</body>

</html>

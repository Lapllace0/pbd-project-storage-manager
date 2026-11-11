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
                        <a href="{{ route('getVendor', ['all',1]) }}" class="btn">Vendor</a>
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
                        <a href="{{ route('getDetailPengadaan', ['all',1]) }}" class="btn btn-active">Detail Pengadaan</a>
                    </li>
                    <li>
                        <a href="{{ route('getPenjualan', ['all', 1]) }}" class="btn">Penjualan</a>
                    </li>
                    <li>
                        <a href="{{ route('getDetailPenjualan', ['all', 1]) }}" class="btn">Detail
                            Penjualan</a>
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
                    <a href="{{ route('getDetailPengadaan', [$filter, 1]) }}"
                        class="button-filter">{{ $filter }}</a>
                    <div class="navPage">
                        <h5 class="page">PAGE: {{ $page }}</h5>
                        @if ($page == 1)
                            <a class="disabled-button">Prev</a>
                        @else
                            <a href="{{ route('getDetailPengadaan', [$filter, $page - 1]) }}" class="prevPage">Prev</a>
                        @endif
                        @if ($nextData[0]->total < 1)
                            <a class="disabled-button">Next</a>
                        @else
                            <a href="{{ route('getDetailPengadaan', [$filter, $page + 1]) }}" class="nextPage">Next</a>
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
                            <th>Id Detail Penjualan</th>
                            <th>Harga Satuan</th>
                            <th>Jumlah</th>
                            <th>SubTotal</th>
                            <th>Nama Barang</th>
                            <th>Id Pengadaan</th>
                            <th class="editData">edit</th>
                        </tr>
                    </thead>
                    <tbody class="tbody">
                        @if ($data)
                            @foreach ($data as $d)
                                @if ($loop->iteration % 2 == 1)
                                    <tr class="trOdd datarow" id="{{ $d->idDetail_pengadaan }}">
                                        <td>{{ $d->idDetail_pengadaan }}</td>
                                        <td>{{ $d->harga_satuan }}</td>
                                        <td>{{ $d->jumlah }}</td>
                                        <td>{{ $d->sub_total }}</td>
                                        <td>{{ $d->namaBarang }}</td>
                                        <td>{{ $d->idPengadaan }}</td>
                                        <td><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" height="24px"
                                                width="24px" class="svgEdit"
                                                onclick="showModal(@js($d->idDetail_pengadaan), @js($d->harga_satuan), @js($d->jumlah), @js($d->sub_total), @js($d->namaBarang), @js($d->idPengadaan))">
                                                <path
                                                    d="M5,21q-0.83,0-1.41-0.59T3,19V5Q3,4.17 3.59,3.59T5,3h8.93l-2,2H5V19H19V12.05l2-2V19q0,0.82-0.59,1.41T19,21H5Zm7-9ZM9,15V10.75l9.18-9.18q0.3-0.3 0.68-0.45q0.38-0.15 0.75-0.15q0.4,0 0.76,0.15q0.36,0.15 0.66,0.45L22.43,3q0.28,0.3 0.43,0.66T23,4.4T22.86,5.14T22.43,5.8L13.25,15H9ZM21.03,4.4L19.63,3l1.4,1.4ZM11,13h1.4l5.8-5.8L17.5,6.5L16.78,5.8L11,11.58V13Zm6.5-6.5L16.78,5.8L17.5,6.5l0.7,0.7L17.5,6.5Z" />
                                            </svg>
                                        </td>
                                    </tr>
                                @else
                                    <tr class="trEven datarow" id="{{ $d->idDetail_pengadaan }}">
                                        <td>{{ $d->idDetail_pengadaan }}</td>
                                        <td>{{ $d->harga_satuan }}</td>
                                        <td>{{ $d->jumlah }}</td>
                                        <td>{{ $d->sub_total }}</td>
                                        <td>{{ $d->namaBarang }}</td>
                                        <td>{{ $d->idPengadaan }}</td>
                                        <td><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" height="24px"
                                                width="24px" class="svgEdit"
                                                onclick="showModal(@js($d->idDetail_pengadaan), @js($d->harga_satuan), @js($d->jumlah), @js($d->sub_total), @js($d->namaBarang), @js($d->idPengadaan))">
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
                        <form action="/detail-pengadaan/action" method="POST" class="edit-data">
                            @csrf
                            <input type="hidden" value="{{ $filter }}" name="filter">
                            <input type="hidden" value="" id="idDetailPengadaan" name="id">
                            <input type="hidden" value="" id="dataArray" name="dataArray">
                            <select name="idVendor" id="idVendor" class="select-vendor-size" required>
                                @foreach ( $dataVendor as $d)
                                <option value="{{$d->idVendor}}">{{$d->nama_vendor}}</option>
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
        let pageForm = 1
        let dataBarang = @js($dataBarang)

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


        function showModal(p_idPenjualan, p_subTotalNilai, p_idUser) {
            let bgModal = document.querySelector('.bg-modal')
            let buttonAdd = document.querySelector('.button-form-add')
            let buttonEdit = document.querySelector('.button-form-edit')
            let defaultSelect = document.querySelectorAll('.input-default-value')
            let formWidth = document.querySelector('.edit-data')

            formWidth.style.width = '500px'
            defaultSelect.forEach(element => {
                element.style.display = 'none'
            });

            bgModal.style.display = 'flex'
            buttonAdd.style.display = 'none'
            buttonEdit.style.display = 'flex'

            let idPenjualan = document.getElementById('idPenjualan')
            let subTotalNilai = document.getElementById('subTotalNilai')
            let idUser = document.getElementById('idUser')


            idPenjualan.value = p_idPenjualan
            subTotalNilai.value = p_subTotalNilai
            idUser.value = p_idUser
        }

        function showModalVendor() {
            let bgModal = document.querySelector('.bg-modal')
            let buttonAdd = document.querySelector('.button-form-add')
            let buttonEdit = document.querySelector('.button-form-edit')
            bgModal.style.display = 'flex'
            buttonAdd.style.display = 'none'
            buttonEdit.style.display = 'none'
        }


        let dataInput = []
        let divInput = document.querySelector('.add-form-dp')

        function showModalAdd() {
            let bgModal = document.querySelector('.bg-modal')
            let buttonEdit = document.querySelector('.button-form-edit')
            let inputForm = document.querySelectorAll('.input-form')
            let buttonAdd = document.querySelector('.button-form-add')
            let prevButton = document.getElementById('form-prev-button')
            let nextButton = document.getElementById('form-next-button')
            let idVendor = document.getElementById('idVendor')
            let buttonVendor = document.querySelector('.button-form-chooseVendor')
            pageForm = 1

            dataInput = []

            bgModal.style.display = 'flex'
            buttonEdit.style.display = 'none'
            buttonAdd.style.display = 'flex'
            idVendor.style.display = 'none'
            buttonVendor.style.display = 'none'

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

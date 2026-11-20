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
                </ul>
            </div>
        </aside>

        <main class="main-content">

            <div class="position">


                <div class="navPanel">
                    <a href="{{ route('getPenerimaan', [$nextFilter, 1]) }}"
                        class="button-filter">{{ $filter }}</a>
                    <div class="navPage">
                        <h5 class="page">PAGE: {{ $page }}</h5>
                        @if ($page == 1)
                            <a class="disabled-button">Prev</a>
                        @else
                            <a href="{{ route('getPenerimaan', [$filter, $page - 1]) }}" class="prevPage">Prev</a>
                        @endif
                        @if ($nextData[0]->total < 1)
                            <a class="disabled-button">Next</a>
                        @else
                            <a href="{{ route('getPenerimaan', [$filter, $page + 1]) }}" class="nextPage">Next</a>
                        @endif
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="add-button"
                        onclick="showModalIdPengadaan()">
                        <path
                            d="M11,17h2V13h4V11H13V7H11v4H7v2h4v4ZM5,21q-0.83,0-1.41-0.59T3,19V5Q3,4.17 3.59,3.59T5,3H19q0.83,0 1.41,0.59T21,5V19q0,0.82-0.59,1.41T19,21H5Zm0-2H19V5H5V19ZM5,5V19V5Z" />
                    </svg>
                </div>

                <table class="table">
                    <thead class="thead">
                        <tr>
                            <th>Id Penerimaan</th>
                            <th>Kapan Dibuat</th>
                            <th>Status</th>
                            <th>Id User</th>
                            <th>Id Pengadaan</th>
                            <th class="editData">Detail</th>
                        </tr>
                    </thead>
                    <tbody class="tbody">
                        @if ($data)
                            @foreach ($data as $d)
                                @if ($loop->iteration % 2 == 1)
                                    <tr class="trOdd datarow" id="{{ $d->idPenerimaan }}">
                                        <td>{{ $d->idPenerimaan }}</td>
                                        <td>{{ $d->created_at }}</td>
                                        <td>{{ $d->det_status }}</td>
                                        <td>{{ $d->idUser }}</td>
                                        <td>{{ $d->idPengadaan }}</td>
                                        <td> <a href="{{ route('getDetailPenerimaan', [$d->idPenerimaan, 1]) }}"
                                                class="detail-transaksi">Detail</a></td>
                                    </tr>
                                @else
                                    <tr class="trEven datarow" id="{{ $d->idPenerimaan }}">
                                        <td>{{ $d->idPenerimaan }}</td>
                                        <td>{{ $d->created_at }}</td>
                                        <td>{{ $d->det_status }}</td>
                                        <td>{{ $d->idUser }}</td>
                                        <td>{{ $d->idPengadaan }}</td>
                                        <td> <a href="{{ route('getDetailPenerimaan', [$d->idPenerimaan, 1]) }}"
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
                        <form action="/penerimaan/action" method="POST" class="edit-data">
                            @csrf
                            <input type="hidden" value="{{ $filter }}" name="filter">
                            <input type="hidden" value="" id="dataArray" name="dataArray">
                            <h2 class="data-title" id="pilihIdPengadaan">Pilih Id Pengadaan</span></h2>
                            <select name="idPengadaan" id="idPengadaan" class="select-id_pengadaan-size" required>
                                @foreach ($pengadaan as $d)
                                    <option value="{{ $d->idPengadaan }}">{{ $d->idPengadaan }}</option>
                                @endforeach
                            </select>

                            <div class="input-form-add">

                            </div>

                            <div class="button-form-choose_idPengadaan">
                                <button type="button" onclick="showModalAdd()">Next Section</button>
                            </div>
                            <h3 id="muatData"></h3>
                            <div class="button-form-add">
                                <button type="submit" name="action" value="add" class="add-data"
                                    onclick="prepareSubmit()" id="simpanPenerimaan" disabled>Simpan
                                    Penerimaan</button>
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
        let inputForm = document.querySelector('.input-form-add')


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

        let dataInput = []
        let iterasi = 0


        function showModalIdPengadaan() {
            let bgModal = document.querySelector('.bg-modal')
            let buttonAdd = document.querySelector('.button-form-add')

            let idPengadaan = document.getElementById('idPengadaan')
            let buttonPengadaan = document.querySelector('.button-form-choose_idPengadaan')
            let pilihIdPengadaan = document.getElementById('pilihIdPengadaan')

            bgModal.style.display = 'flex'
            buttonAdd.style.display = 'none'
            idPengadaan.style.display = 'flex'
            buttonPengadaan.style.display = 'flex'
            pilihIdPengadaan.style.display = 'block'
            inputForm.style.display = 'none'

            inputForm.innerHTML = ''


        }


        async function showModalAdd() {
            let muatData = document.getElementById('muatData')
            let idPengadaan = document.getElementById('idPengadaan')


            muatData.textContent = 'Memuat data...'
            let barang = await fetch(`/penerimaan/getBarang/${idPengadaan.value}`)
            let data = await barang.json()

            if (data[0] == 0) {
                muatData.textContent = 'Gagal Memuat Data'
                return
            }
            muatData.style.display = 'none'
            console.log('berhasil')
            console.log(data)

            let buttonAdd = document.querySelector('.button-form-add')
            let buttonPengadaan = document.querySelector('.button-form-choose_idPengadaan')
            let pilihIdPengadaan = document.getElementById('pilihIdPengadaan')

            buttonAdd.style.display = 'flex'
            idPengadaan.style.display = 'none'
            buttonPengadaan.style.display = 'none'
            pilihIdPengadaan.style.display = 'none'
            inputForm.style.display = 'flex'

            inputForm.innerHTML = ''
            dataInput = []
            data.forEach(data => {
                inputForm.innerHTML += `
                <div class='container-input-penerimaan'>
                                <h4 class="label-data-input-penerimaan">${data.namaBarang}</h4>
                                <input type="hidden" value ='${data.idBarang}' class='idBarang'>
                                <input type="number" placeholder="harga satuan"
                                class="input-harga-satuan-penerimaan" id='harga${iterasi}' disabled required>
                                <input type="number" placeholder="jumlah|max:${data.kurang}" min="0" max='${data.kurang}'
                                class="input-jumlah-penerimaan" id='jumlah${iterasi}'>
                </div>`
                iterasi++
            })

            let simpanPenerimaan = document.getElementById('simpanPenerimaan')
            inputForm.addEventListener('input', (e) => {
                let parent = e.target.closest('.container-input-penerimaan')
                let harga = parent.querySelector('.input-harga-satuan-penerimaan')
                let jumlah = parent.querySelector('.input-jumlah-penerimaan')
                let idBarang = parent.querySelector('.idBarang')

                if (Number(jumlah.value) > Number(jumlah.max)) {
                    jumlah.value = Number(jumlah.max)
                }
                if (Number(harga.value) < 0 || typeof Number(harga.value) == NaN) {
                    harga.value = ''
                }
                harga.value = Number(harga.value)

                console.log(harga.value)
                // console.log(jumlah)

                if (jumlah.value != 0 && jumlah.value != '') {
                    harga.disabled = false
                    if (harga.value != 0 && harga.value != '') {

                        if (!(dataInput.some((e) => e.id == harga.id))) {
                            dataInput.push({
                                id: harga.id,
                                idBarang: idBarang.value,
                                harga: harga.value,
                                jumlah: jumlah.value
                            })
                            simpanPenerimaan.disabled = false
                        } else {
                            dataInput[dataInput.findIndex(item => item.id == harga.id)] = {
                                id: harga.id,
                                idBarang: idBarang.value,
                                harga: harga.value,
                                jumlah: jumlah.value
                            }
                        }
                    } else {
                        if (dataInput.findIndex(item => item.id == harga.id) != -1) {
                            dataInput.splice(dataInput.findIndex(item => item.id == harga.id), 1)
                        }
                        if (dataInput.length != 0) {
                            simpanPenerimaan.disabled = false
                        } else {
                            simpanPenerimaan.disabled = true
                        }
                    }
                    console.log('a')
                } else {
                    if ((dataInput.some((e) => e.id == harga.id))) {
                        dataInput.splice(dataInput.findIndex(item => item.id == harga.id), 1)
                    }
                    harga.disabled = true
                    if (dataInput.length != 0) {
                        simpanPenerimaan.disabled = false
                    } else {
                        simpanPenerimaan.disabled = true
                    }

                    console.log('b')
                }
                // console.log(jumlah.value)
                console.log(dataInput)
            })
        }


        function closeModal() {
            let bgModal = document.querySelector('.bg-modal')
            bgModal.style.display = 'none'
        }

        function prepareSubmit() {
            let dataArray = document.getElementById('dataArray')


            dataArray.value = JSON.stringify(dataInput)
            inputForm.innerHTML = ''
        }
    </script>
</body>

</html>

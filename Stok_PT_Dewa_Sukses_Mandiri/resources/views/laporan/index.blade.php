@extends('layout.layout')
@section('content')
<link rel="stylesheet" href="{{asset('css/laporanbarang.css')}}">
    <div class="title" style="font-weight:600">
            Pendataan Barang
        </div>
    <div class="sub-petunjuk-2">
        Petunjuk untuk Menginput Pendataan Barang :
        <div class="isi-petunjuk-2">
            <li>Klik menu Pendataan Barang</li>
            <li>Jika ingin menambah list barang, Klik Button + Barang</li>
            <li>Pilih Barang yang mau diinput</li>
            <li>Masukkan Jumlah Barang</li>
            <li>Masukkan Tanggal yang sesuai</li>
            <li>Masukkan Keterangan</li>
            <li>Pilih Opsi Barang</li>
        </div> 
    </div>
    <br>
    <div class="input">
        <form class="store" action="">
            <button class="laporan-tambah"type = "button" onclick="tambah_list()">
                + Barang
            </button>
            <br><br>
            <table class="" id="form">
                <tr>
                    <td>
                        ID BARANG
                    </td>
                    <td>
                        <div style="margin-left:10px">
                        JUMLAH MASUK/KELUAR
                        </div>
                    </td>
                </tr>
                <tr id="tr-1">
                    <td>
                        <select class="select2-script" name="id_barang[]">
                        </select>
                    </td>
                    <td>
                        <input required type="number" name="jumlah[]" id="" style="margin-left:10px">
                    </td>
                    <td>
                        <button type = "button" class="btn-remove" onclick="hapus_list('tr-1')" style="display:none">
                            - Barang
                        </button>
                    </td>
                </tr>
            </table>
            <br>
            <div style="display:flex">
                <div>
                    <label for="">TANGGAL</label>
                    <br>
                    <input required type="date" name="tanggal" id="" style="width:193px">
                </div>
                <div>
                    <label for="" style="margin-left:10px">
                        KETERANGAN
                    </label>
                    <br>
                    <input required type="text" name="keterangan" style="margin-left:10px">
                </div>
                <div class="opsi" style="margin-left:10px">
                    <label for="">
                        OPSI
                    </label>
                    <br>
                    <select name="is_masuk" id="">
                        <option value="1">MASUK</option>
                        <option value="0">KELUAR</option>
                    </select>
                </div>
            </div>
            <br>
            <button class="tambah-laporan"onclick="storeData()">
                TAMBAH
            </button>
        </form>
    </div>
    <br><br>
    <div class="table">
        <table id="isi">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>TANGGAL</th>
                    <th>NAMA BARANG</th>
                    <th>KETERANGAN</th>
                    <th>TIPE</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
               
            </tbody>
        </table>
    </div>
@endsection
@section('script')

<script>
    let i = 1;
    let j = 2;
    let data_barang = [];
    var dataTable = null;

    function tambah_list() {
        const table = document.querySelector('#form');
        let tambah_list = 
        `
        <tr id="tr-${j}">
            <td>
                <select class="select2-script" name="id_barang[]">
                    <option value="" style="display:none">Pilih ID Barang</option>
                </select>
            </td>
            <td>
                <input required type="number" name="jumlah[]" id="" style="margin-left:10px">
            </td>
            <td>
                <button type="button" class="btn-remove" onclick="hapus_list('tr-${j}')">
                    - Barang
                </button>
            </td>
        </tr>
        `
        table.insertAdjacentHTML("beforeend", tambah_list);
        i++;
        j++;
        if(i>1){
            document.querySelectorAll(".btn-remove").forEach(element => {
                element.style.display="inline";
            });;
        }
        render_select2();
    }
    function hapus_list(e) {
        const tr = document.querySelector("#"+e);
        tr.remove();
        --i;
        if (i < 2) {
            const btnRemoveElements = document.querySelectorAll('.btn-remove');
            btnRemoveElements.forEach(element => {
                element.style.display = 'none';
            });
        }
    }
    function render_select2() {
        const select = document.querySelectorAll('.select2-script');
            select.forEach(element2 => {
                let options = '';
                data_barang.forEach((element,index) => {
                    const newOption = 
                    `
                    <option value="${element.id}">${element.nama_barang}</option>
                    `
                    options += newOption;
                });
                element2.innerHTML = options;
            });
            $('.select2-script').select2({
                placeholder:'--Pilih ID Barang--'
            });
    }
    const formStore = document.querySelector('form.store');
    const innerHTML = formStore.innerHTML;
    const url = window.location.origin+"/api/penyimpananbarang";
    getData();
    ambilDataBuatSelect();
    async function ambilDataBuatSelect(){
        try{
            const response = await fetch(window.location.origin+"/api/barang");
            const data = await response.json();
            data_barang = data.data;
            render_select2();
        }
        catch(err){
            console.error(err);
        }
    }
    async function getData(){
        try{
            const response = await fetch(url);
            const data = await response.json();
            const table = document.querySelector('#isi tbody');
            let rows = '';
            data.data.forEach((element,index) => {
                let newRow = 
                `
                    <tr>
                        <td>
                            ${++index}
                        </td>
                        <td>
                            `
                            newRow+=new Date(element.tanggal).toISOString().slice(0, 10)
                            newRow+=`
                        </td>
                        <td>
                            `
                            for (let i = 0; i < element.laporan_barang_detail.length; i++) {
                                newRow+=`${element.laporan_barang_detail[i].barang.nama_barang}`
                            if (i != element.laporan_barang_detail.length-1) {
                                newRow+=', '
                            }}
                            newRow+=`
                        </td>
                        <td>
                            ${element.keterangan}
                        </td>
                        <td>
                            ${element.is_masuk?'masuk':'keluar'}
                        </td>
                        <td>
                        <a href="/penyimpananbarang/${element.id}">
                            <button class="detail">
                                DETAIL
                            </button>
                        </a>
                        </td>
                    </tr>
                `
                rows += newRow;
            });
            table.innerHTML = rows;
            if (dataTable !== null) {
                dataTable.destroy();
            }
            dataTable = $('#isi').dataTable({
                autoWidth: false,
                compact: true,
                scrollX: true,
                searching: true
            });
        }
        catch(err){
            console.error(err);
        }
    }
    async function storeData(){
        event.preventDefault();
        try{
            const form = document.querySelector('form.store');
            const formData = new FormData(form);
            console.log(JSON.stringify(formDataToObject(formData)));
            const response = await fetch(url,{
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-Token": "{{csrf_token()}}"
                },
                method: "post",
                credentials: "same-origin",
                body: JSON.stringify(formDataToObject(formData))
            });
            await getData();
        }
        catch(err){
            console.error(err);
        }
    }
    async function deleteData(id){
        event.preventDefault();
        try {
            const crsfToken = document.querySelector('#csrfToken').value;
            const response = await fetch(url+'/'+id,{
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-Token": csrfToken
                },
                method: "delete",
                credentials: "same-origin",
            });
            await getData();
        } 
        catch (err) {
            console.error(err);
        }
    }
    function formDataToObject(formData) {
        let object = {}

        const debug = (message) => {
            //console.log(message)
        }
        const parseKey = (key) => {
            const subKeyIdx = key.indexOf('[');

            if (subKeyIdx !== -1) {
                const keys = [key.substring(0, subKeyIdx)]
                key = key.substring(subKeyIdx)

                for (const match of key.matchAll(/\[(?<key>.*?)]/gm)) {
                    keys.push(match.groups.key)
                }
                return keys
            } else {
                return [key]
            }
        }
        const assign = (keys, value, object) => {
            const key = keys.shift()
            debug(key)
            debug(keys)

            if (key === '' || key === undefined) {
                return object.push(value)
            }

            if (Reflect.has(object, key)) {
                debug('hasKey ' + key)
                if (keys.length === 0) {
                    if (!Array.isArray(object[key])) {
                        debug('isArray ' + object[key])
                        object[key] = [object[key], value]
                        return
                    }
                }
                return assign(keys, value, object[key])
            }
            if (keys.length >= 1) {
                debug(`undefined '${key}' key: remaining ${keys.length}`)
                object[key] = keys[0] === '' ? [] : {}
                return assign(keys, value, object[key])
            } else {
                debug("set value: " + value)
                object[key] = value
            }
        }
        for (const pair of formData.entries()) {
            assign(parseKey(pair[0]), pair[1], object)
        }
        return object
    }
</script>
@endsection
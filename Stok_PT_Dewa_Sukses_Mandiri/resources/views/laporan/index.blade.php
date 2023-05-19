@extends('layout.layout')
@section('content')
<div class="title">
        Laporan Barang
        <div class="sub-title">
            Ketuk + Untuk Menambah List Barang
        </div>
    </div>
    <br>
    <div class="input">
        <form class="store" action="">
            <button type = "button" onclick="tambah_list()">
                + Barang
            </button>
            <br><br>
            <table id="form">
                <tr>
                    <td>
                        ID Barang
                    </td>
                    <td>
                        Stok
                    </td>
                    <td>
                        Jumlah Masuk/Keluar
                    </td>
                </tr>
                <tr id="tr-1">
                    <td>
                        <select class="select2-script" name="id_barang">
                            <option value="" style="display:none">Pilih ID Barang</option>
                        </select>
                    </td>
                    <td>
                        <input type="number"  id="stok">
                    </td>
                    <td>
                        <input type="number" name="jumlah" id="">
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
                    <label for="">
                        Keterangan
                    </label>
                    <br>
                    <input type="text" name="keterangan">
                </div>
                <div>
                    <label for="">
                        Tipe
                    </label>
                    <br>
                    <select name="is_masuk" id="">
                        <option value="1">Masuk</option>
                        <option value="0">Keluar</option>
                    </select>
                </div>
            </div>
            <br>
            <button>
                Tambah
            </button>
        </form>
    </div>
    <br><br>
    <div class="table">
        <table id="isi">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID Barang</th>
                    <th>Jumlah Masuk/Keluar</th>
                    <th>Keterangan</th>
                    <th>Tanggal</th>
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

    function tambah_list() {
        const table = document.querySelector('#form');
        let tambah_list = 
        `
        <tr id="tr-${j}">
            <td>
                <select class="select2-script" name="id_barang">
                    <option value="" style="display:none">Pilih ID Barang</option>
                </select>
            </td>
            <td>
                <input type="number"  id="stok">
            </td>
            <td>
                <input type="number" name="jumlah" id="">
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
    // $(document).ready(function(){
    //     $('#id').select2({
    //         placeholder:'--Pilih ID Barang--'
    //     });
    // })
    const formStore = document.querySelector('form.store');
    const innerHTML = formStore.innerHTML;
    const url = window.location.origin+"/api/laporanbarang";
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
                const newRow = 
                `
                    <tr>
                        <td>
                            ${++index}
                        </td>
                        <td>
                            ${element.jumlah}
                        </td>
                        <td>
                            ${element.keterangan}
                        </td>
                        <td>
                            <button class="edit-${element.id}"onClick = 'edit(${JSON.stringify(element)});'>
                                Edit
                            </button>
                        </td>
                    </tr>
                `
                rows += newRow;
            });
            table.innerHTML = rows;
        }
        catch(err){
            console.error(err);
        }
    }
    function edit(obj){
        formStore.innerHTML = 
        `
            <label for="">
                Nama Barang
            </label>
            <br>
            <input type="text" name="nama" id="" value=${obj.id_barang}>
            <br>
            <label for="">
                Stock
            </label>
            <br>
            <input type="number" name="stok" id="" value=${obj.stok}>
            <br><br>
            <button onClick = 'updateData(${obj.id})'>
                Simpan
            </button>
            <input type="hidden" id="csrfToken" value="{{ csrf_token()}}">
        `
    }
    async function storeData(){
        event.preventDefault();
        try{
            const crsfToken = document.querySelector('#csrfToken').value;
            const form = document.querySelector('form.store');
            const formData = new FormData(form);
            const response = await fetch(url,{
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-Token": csrfToken
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
    async function updateData(id){
        event.preventDefault();
        try {
            const crsfToken = document.querySelector('#csrfToken').value;
            const form = document.querySelector('form.store');
            const formData = new FormData(form);
            const response = await fetch(url+'/'+id,{
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-Token": csrfToken
                },
                method: "post",
                credentials: "same-origin",
                body: JSON.stringify(Object.fromEntries(formData))
            });
            await getData();
            tambah();
        } 
        catch (err) {
            console.error(err);
        }
    }
    function tambah() {
        formStore.innerHTML = innerHTML;
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
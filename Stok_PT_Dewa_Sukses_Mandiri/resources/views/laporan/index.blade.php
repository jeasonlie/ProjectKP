@extends('layout.layout')
@section('content')
<div class="title">
        Laporan Barang
    </div>
    <br>
    <div class="input">
        <form action="">
            <button>
                Tambah Barang
            </button>
            <br><br>
            <table id="form">
                <tr>
                    <th>
                        ID Barang
                    </th>
                    
                    <th>
                        Jumlah Masuk/Keluar
                    </th>
                </tr>
                <tr>
                    <td>
                    <input type="number" name="id_barang" id="">
                    </td>
                    <td>
                    <input type="number" name="jumlah" id="">
                    </td>
                </tr>
            </table>
            <br>
            <label for="">
                Keterangan
            </label>
            <br>
            <input type="text" name="keterangan">
            <br><br>
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
                    <th>Nama Barang</th>
                    <th>Jumlah Masuk/Keluar</th>
                    <th>Keterangan</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>

                    </td>
                    <td>

                    </td>
                    <td>

                    </td>
                    <td>

                    </td>
                    <td>

                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
@section('script')

<script>
    const url = window.location.origin+"/api/laporanbarang";
    getData();
    async function getData(){
        try{
            const response = await fetch(url);
            const data = await response.json();
            const table = document.querySelector('table tbody');
            let rows = '';
            data.data.forEach((element,index) => {
                const form = document.createElement('form');
                form.innerHTML = `
                    <tr>
                            <td>
                                ${++index}
                            </td>
                            <td>
                                <input class="input-${element.id}" type="text" name="nama" id="" value="${element.nama_barang}" readonly>
                            </td>
                            <td>
                                <input class="input-${element.id}" type="text" name="stok" id="" value="${element.stok}" readonly>
                            </td>
                            <td>
                                <button class="edit-${element.id}"onClick = 'toggle(${element.id});'>
                                    Edit
                                </button>
                                <button class="simpan-${element.id}" onClick = 'updateData(${element.id})' style = 'display:none;'>
                                    Simpan
                                </button>
                            </td>
                            <td>
                                <button onClick = 'deleteData(${element.id})'>
                                    Delete
                                </button>
                            </td>
                    </tr>
                `
                form.id = element.id;
                rows += form;
            });
            table.appendChild(rows);
        }
        catch(err){
            console.error(err);
        }
    }
    function toggle(id){
        const inputs = document.querySelectorAll('.input-'+id);
        inputs.forEach(input => {
            input.readOnly = !input.readOnly;
        });
        const edits = document.querySelector('.edit-'+id);
        edits.style.display = 'none';
        const simpans = document.querySelector('.simpan-'+id);
        simpans.style.display = 'block';
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
                body: JSON.stringify(Object.fromEntries(formData))
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
            const form = document.querySelector('#form-'+id);
            const formData = new FormData(form);
            console.log(form.innerHTML);
            console.log(url+'/'+id);
            const response = await fetch(url+'/'+id,{
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-Token": csrfToken
                },
                method: "patch",
                credentials: "same-origin",
                body: JSON.stringify(Object.fromEntries(formData))
            });
            await getData();
        } 
        catch (err) {
            console.error(err);
        }
    }
    async function deleteData(id){
        event.preventDefault();
        try {
            const crsfToken = document.querySelector('#csrfToken').value;
            const form = document.querySelector('#form-'+id);
            const formData = new FormData(form);
            const response = await fetch(url+'/'+id,{
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-Token": csrfToken
                },
                method: "delete",
                credentials: "same-origin",
                body: JSON.stringify(Object.fromEntries(formData))
            });
            await getData();
        } 
        catch (err) {
            console.error(err);
        }
    }
</script>
@endsection
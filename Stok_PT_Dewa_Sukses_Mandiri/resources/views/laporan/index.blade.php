@extends('layout.layout')
@section('content')
    <div class="title">
        Laporan Barang
    </div>
    <br>
    <div class="input">
        <form class="store">
            <label for="">
                Nama Barang
            </label>
            <br>
            <input type="text" name="nama" id="">
            <br>
            <label for="">
                Stock
            </label>
            <br>
            <input type="number" name="stok" id="">
            <br><br>
            <button onClick = 'storeData()'>
                Tambah 
            </button>
            <input type="hidden" id="csrfToken" value="{{ csrf_token()}}">
        </form>
    </div>
    <br><br>
    <div class="table">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Jumlah Masuk/Keluar Barang</th>
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
    const formStore = document.querySelector('form.store');
    const innerHTML = formStore.innerHTML;
    const url = window.location.origin+"/api/barang";
    getData();
    async function getData(){
        try{
            const response = await fetch(url);
            const data = await response.json();
            const table = document.querySelector('table tbody');
            let rows = '';
            data.data.forEach((element,index) => {
                const newRow = 
                `
                    <tr>
                        <td>
                            ${++index}
                        </td>
                        <td>
                            ${element.nama_barang}
                        </td>
                        <td>
                            ${element.stok}
                        </td>
                        <td>
                            <button class="edit-${element.id}"onClick = 'edit(${JSON.stringify(element)});'>
                                Edit
                            </button>
                        </td>
                        <td>
                            <button onClick = 'deleteData(${element.id})'>
                                Delete
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
            <input type="text" name="nama" id="" value=${obj.nama_barang}>
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
</script>
@endsection
@extends('layout.layout')
@section('content')
    <div class="title">
        BARANG
    </div>
    <br>
    <div class="input">
        <form class="store">
            <label for="">
                NAMA BARANG
            </label>
            <br>
            <input type="text" name="nama" id="">
            <br>
            <br>
            <button onClick = 'storeData()'>
                TAMBAH
            </button>
            <input type="hidden" id="csrfToken" value="{{ csrf_token()}}">
        </form>
    </div>
    <br><br>
    <div class="table">
        <table id="isi">
            <thead>
                <tr>
                    <th>ID BARANG</th>
                    <th>NAMA BARANG</th>
                    <th>STOCK</th>
                    <th>EDIT</th>
                    <th>DELETE</th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
        </table>
    </div>
@endsection
@section('script')

<script>
    var dataTable = null;

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
                            ${"B"+element.id}
                        </td>
                        <td>
                            ${element.nama_barang}
                        </td>
                        <td>
                            ${element.total_masuk - element.total_keluar}
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
    function edit(obj){
        formStore.innerHTML = 
        `
        <label for="">
                NAMA BARANG
            </label>
            <br>
            <input type="text" name="nama" id="" value=${obj.nama_barang}>
            <br>
            <br>
            <button onClick = 'updateData(${obj.id})'>
                SIMPAN
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
<form action="{{ route('barang.update', $data->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="modal-header">
        <h3 class="modal-title"><strong>Edit Barang</strong></h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label for="nama_barang">Nama Barang :</label>
            <input type="text" name="nama_barang" id="nama_barang" class="form-control" value="{{ $data->name }}" required>
        </div>

        <div class="form-group">
            <label for="stok">Stok :</label>
            <input type="number" name="stok" id="stok" class="form-control" value="{{ $data->stock }}" required>
        </div>

        <div class="form-group">
            <label for="satuan">Satuan :</label>
            <select name="satuan" id="satuan" class="form-control" required>
                <option value="" disabled>Pilih Satuan</option>
                <option value="Pcs" {{ $data->unit == "Pcs" ? 'selected' : '' }}>Pcs</option>
                <option value="Kg" {{ $data->unit == "Kg" ? 'selected' : '' }}>Kg</option>
                <option value="Set" {{ $data->unit == "Set" ? 'selected' : '' }}>Set</option>
                <option value="Meter" {{ $data->unit == "Meter" ? 'selected' : '' }}>Meter</option>
            </select>
        </div>

        <div class="form-group">
            <label for="harga_beli">Harga Beli :</label>
            <input type="number" name="harga_beli" id="harga_beli" class="form-control" value="{{ $data->price_buy }}" step="0.01" required>
        </div>

        <div class="form-group">
            <label for="harga_jual_rekomendasi">Harga Jual Rekomendasi :</label>
            <input type="number" name="harga_jual_rekomendasi" id="harga_jual_rekomendasi" class="form-control" value="{{ $data->price_sell_recomendation }}" step="0.01" required>
        </div>

        <div class="form-group">
            <label for="supplier_name">Nama Supplier :</label>
            <input type="text" name="supplier_name" id="supplier_name" class="form-control" value="{{ $data->supplier_name }}" required>
        </div>

        <div class="form-group">
            <label for="supplier_date">Tanggal Barang Datang :</label>
            <input type="date" name="supplier_date" id="supplier_date" class="form-control" value="{{ $data->supplier_date }}" required>
        </div>

        <div class="form-group">
            <label for="lokasi">Lokasi :</label>
            <input type="text" name="lokasi" id="lokasi" class="form-control" value="{{ $data->location }}" required>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-success">Simpan</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
    </div>
</form>

<style>
    .modal-header {
        background-color: #004C99;
        color: #fff;
    }

    .modal-title {
        margin: 0;
    }

    .form-group label {
        font-weight: bold;
    }
</style>

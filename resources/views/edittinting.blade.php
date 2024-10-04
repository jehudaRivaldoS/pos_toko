<form action="{{ route('productinting.update', $data->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="modal-header">
        <h3 class="modal-title"><strong>Edit Produk</strong></h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label for="name">Nama Produk :</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $data->name }}" required>
        </div>

        <div class="form-group">
            <label for="type">Type :</label>
            <select name="type" id="type" class="form-control" required>
                <option value="" disabled>Pilih Type</option>
                <option value="PASTEL" {{ $data->type == "PASTEL" ? 'selected' : '' }}>PASTEL</option>
                <option value="ACCENT" {{ $data->type == "ACCENT" ? 'selected' : '' }}>ACCENT</option>
                <option value="DEEP" {{ $data->type == "DEEP" ? 'selected' : '' }}>DEEP</option>
                <option value="TINT" {{ $data->type == "TINT" ? 'selected' : '' }}>TINT</option>
            </select>
        </div>

        <div class="form-group">
            <label for="weight">Weight :</label>
            <input type="text" name="weight" id="weight" class="form-control" value="{{ $data->weight }}" required>
        </div>

        <div class="form-group">
            <label for="stock">Stok :</label>
            <input type="number" name="stock" id="stock" class="form-control" value="{{ $data->stock }}" required>
        </div>

        <div class="form-group">
            <label for="sales_price">Harga Beli :</label>
            <input type="number" name="sales_price" id="sales_price" class="form-control" value="{{ $data->sales_price }}" step="0.01" required>
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

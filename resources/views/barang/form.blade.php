<div class="mb-3">

    <label>Nama Barang</label>

    <input
        type="text"
        name="nama_barang"
        class="form-control"
        value="{{ old('nama_barang',$barang->nama_barang ?? '') }}"
        required>

</div>

<div class="mb-3">

    <label>Satuan</label>

    <select
        name="satuan"
        class="form-control">

        <option value="Kg">Kg</option>

        <option value="Liter">Liter</option>

        <option value="Pcs">Pcs</option>

        <option value="Botol">Botol</option>

    </select>

</div>
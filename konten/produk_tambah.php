  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Tambah Produk</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Data Pokok</a></li>
              <li class="breadcrumb-item"><a href="index.php?p=produk">Produk</a></li>
              <li class="breadcrumb-item active">Tambah</li>

            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <form action="aksi/produk.php" method="post">
          <input type="hidden" name="aksi" value="tambah">
          <div>
            <label for="idkategori">Kategori</label>
            <select class="select2bs4 form-control" required="" name="idkategori">
              <option value="">-- Pilih Kategori --</option>

              <?php
              $sql1 = "select * from produk_kategori";
              $query1 = mysqli_query($koneksi, $sql1);
              while ($kolom1 = mysqli_fetch_array($query1)) {
                echo "<option value='$kolom1[id_produk_kategori]'>$kolom1[produk_kategori]</option>";
              }

              ?>
            </select>
          </div>
          <div>
            <label for="barcode">Barcode</label>
            <input type="text" required class="form-control" name="barcode">
          </div>
          <div>
            <label for="nama">Nama Produk</label>
            <input type="text" required class="form-control" name="nama">
          </div>
          <!-- <div>
            <label for="satuan">Satuan</label>
            <select class="form-control" required name="satuan">
              <option>PCS</option>
            </select>
          </div> -->
          <div>
            <label for="satuan">Satuan</label>
            <select name="satuan" class="form-control" required>
              <?= call_option($koneksi, "produk_satuan", "id_produk_satuan", "satuan", "satuan"); ?>
            </select>
          </div>
          <div>
            <label for="keterangan">Keterangan</label>
            <textarea name="keterangan" class="form-control" rows="3"></textarea>
          </div>
          <!-- <div>
            <label for="gambar">Gambar</label>
            <input type="file" class="form-control" name="gambar">
          </div> -->
          <div>
            <label for="stok_minimum">Stok Minimum</label>
            <input type="number" required class="form-control" name="stok_minimum">
          </div>
          <div>
            <label for="hargamodal">Harga Modal</label>
            <input type="number" required class="form-control" name="hargamodal">
          </div>
          <div>
            <label for="hargajual">Harga Jual</label>
            <input type="number" required class="form-control" name="hargajual">
          </div>
          <div>
            <label for="jasa">Produk Jasa</label>
            <select class="form-control" name="jasa" required>
              <option value="0">Tidak</option>
              <option value="1">Ya</option>
            </select>
          </div>
          <button type="submit" class="btn btn-primary mb-2 mt-2">Simpan</button>
        </form>

      </div><!-- /.container-fluid -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Modal Untuk Tambah Kategori -->
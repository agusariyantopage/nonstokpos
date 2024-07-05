<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Pembelian Produk</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Toko</a></li>
            <li class="breadcrumb-item"><a href="index.php?p=daftar-pembelian">Pembelian</a></li>
            <li class="breadcrumb-item active">Input Pembelian</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <row>
        <div class="col-12">
          <?php
          if (!empty($_GET['last'])) {
            echo "
                      <button type='button' class='btn btn-warning mb-2' data-toggle='modal' data-target='#cetakNota'>
                      <i class='fas fa-print'></i> Cetak Nota Terakhir</button>
                ";
          }
          ?>

          <div class="card">
            <div class="card-header">
              <h3>Input Transaksi Pembelian</h3>
            </div>
            <div class="card-body">

              <form action="aksi/pembelian.php" method="post">
                <input type="hidden" name="aksi" value="keranjang-tambah">
                <div class="form-row">
                  <div class="form-group col-sm-8">
                    Tekan tombol cari untuk memilih produk / tekan tambah produk bila produk belum terdaftar ,setelah menambahkan produk silahkan refresh halaman pembelian
                  </div>
                  <div class="form-group col-sm-2">
                    <a href="index.php?p=produk-tambah" target="blank">
                      <button type="button" class="btn btn-primary btn-block"><i class="fas fa-plus"></i> Tambah Produk</button>
                    </a>
                  </div>
                  <div class="form-group col-sm-2">
                    <button type="button" class="btn btn-warning btn-block" data-toggle="modal" data-target="#exampleModal" data-toggle='tooltip' data-placement='top' title='Klik Untuk Pencarian Produk Lanjutan . . .'><i class="fas fa-search"></i> Cari</button>
                  </div>
                </div>
              </form>
              <table class="table table-bordered table-striped" style="width:100%;">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">Hps</th>
                    <th scope="col">#</th>
                    <th scope="col">Produk</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Subtotal</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $id_user = $_SESSION['backend_user_id'];
                  $sql2 = "select keranjang_beli.*,produk.nama from keranjang_beli,produk where keranjang_beli.id_produk=produk.id_produk and id_user=$id_user";
                  $query2 = mysqli_query($koneksi, $sql2);
                  $no = 0;
                  $grandtotal = 0;
                  while ($kolom2 = mysqli_fetch_array($query2)) {
                    $no++;
                    $harga = number_format($kolom2['harga']);
                    $jumlah = number_format($kolom2['jumlah']);
                    $subtotal = number_format($kolom2['jumlah'] * $kolom2['harga']);
                    $grandtotal = $grandtotal + ($kolom2['jumlah'] * $kolom2['harga']);
                    $token = md5($kolom2['id_keranjang_beli']);
                    echo "
                    <form action='aksi/pembelian.php' method='post'>
                    <tr>
                      <td><a href='aksi/pembelian.php?aksi=keranjang-hapus&token=$token'><i class='fas fa-trash'></a></i></td>
                      <td>$no</td>
                      <td>$kolom2[nama]</td>
                      <td align=right style='min-width:130px;'><input type='number' name='harga' class='form-control form-control-sm mb-2' value='$kolom2[harga]'></td>
                      <td align=right style='width:150px;'>
                        <input type='hidden' name='aksi' value='keranjang-ubah'> 
                        <input type='hidden' name='id' value='$kolom2[id_keranjang_beli]'> 
                        <div class='form-row'>
                              <div class='col'>
                                  <input type='number' name='qty' class='form-control form-control-sm mb-2' value='$kolom2[jumlah]'>
                              </div>
                              <div class='col'>
                                  <button class='btn btn-sm btn-warning' type='submit' data-toggle='tooltip' data-placement='top' title='Klik Untuk Mengubah Jumlah . . .'><i class='fas fa-edit'></i></button>
                              </div>
                        </div>
                      </td>
                      <td align=right>$subtotal</td>
                    </tr>
                    </form>
                    ";
                  }
                  ?>

                </tbody>
                <tfoot>
                  <td align='center' colspan="5">GRANDTOTAL</td>
                  <td align='right'><?= number_format($grandtotal); ?></td>
                </tfoot>
              </table>

            </div>
          </div>
          <?php
          if ($grandtotal > 0) {
            echo "<button type='button' class='btn btn-success btn-block' data-toggle='modal' data-target='#simpanJualModal'><i class='fas fa-save'></i> Simpan</button>";
          }
          ?>
        </div>
        <br><br>

      </row>


    </div><!-- /.container-fluid -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Modal Cari Produk -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Pencarian Produk</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <table id="finditem" class="table table-bordered table-striped table-sm" style="width:100%;">
          <!-- Kepala Tabel -->
          <thead>
            <tr>
              <td>Nama Produk</td>
              <td>Barcode</td>
              <td>HPP Berjalan</td>
              <td>Stok</td>
              <td>Satuan</td>
              <td>Beli</td>
            </tr>
          </thead>
          <!-- Isi Tabel -->
          <?php
          $sql = "SELECT produk.*,produk_kategori from produk,produk_kategori where produk.id_produk_kategori=produk_kategori.id_produk_kategori AND produk.id_produk_kategori!=1 order by nama";
          $query = mysqli_query($koneksi, $sql);
          while ($kolom = mysqli_fetch_array($query)) {
          ?>
            <tr>
              <td><?= $kolom['nama']; ?></td>
              <td><?= $kolom['barcode']; ?></td>
              <td><?= number_format($kolom['hpp']); ?> (<?= number_format($kolom['hpp_awal']); ?>)</td>
              <td><?= number_format($kolom['qty']); ?></td>
              <td><?= $kolom['satuan']; ?></td>
              <td style="min-width:200px;">
                <form action="aksi/pembelian.php" method="post">
                  <input type="hidden" name="aksi" value="keranjang-tambah">
                  <input type="hidden" name="id_produk" value="<?= $kolom['id_produk']; ?>">
                  <input type="hidden" name="hpp" value="<?= $kolom['hpp']; ?>">
                  <div class='form-row'>
                    <div class='col'>
                      <input type="number" class="form-control form-control-sm" placeholder="Harga . . ." name="harga" required>
                    </div>
                    <div class='col'>
                      <input type="number" class="form-control form-control-sm" placeholder="Jumlah . . ." name="jumlah" required>
                    </div>
                    <div class='col'>
                      <button type="submit" class="btn btn-info btn-sm"><i class="fas fa-shopping-cart"></i> Beli</button>
                    </div>
                  </div>
                </form>
              </td>
            </tr>

          <?php
          }
          ?>
        </table>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Simpan Beli -->
<div class="modal fade" id="simpanJualModal" tabindex="-1" aria-labelledby="simpanJualModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="simpanJualModalLabel">Simpan Transaksi Pembelian</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="aksi/pembelian.php" method="post">
          <input type="hidden" name="aksi" value="simpan-pembelian">
          <input type="hidden" name="total" value="<?= $grandtotal; ?>">
          <div class="form-row">
            <!-- <div class="form-group col-sm-4">
              <label for="metode_bayar">Metode Pembayaran</label>
              <select name="metode_bayar" class="form-control" required>
                <option value="">-- Pilih Metode Pembayaran --</option>
                <option>KAS</option>
                <option>UTANG</option>
              </select>
            </div> -->
            <input type="hidden" name="metode_bayar" value="KAS">
            <div class="form-group col-sm-4">
              <label for="id_pemasok">Pemasok</label>
              <select name="id_pemasok" id="id_pemasok" class="form-control" required>
                <option value="">-- Pilih Pemasok --</option>
                <?php
                $sql1 = "select * from pemasok order by nama";
                $query1 = mysqli_query($koneksi, $sql1);
                while ($kolom1 = mysqli_fetch_array($query1)) {
                  echo "<option value='$kolom1[id_pemasok]'>$kolom1[nama]</option>";
                }

                ?>
              </select>
            </div>
            <div class="form-group col-sm-4">
              <label for="">Metode Bayar</label>
              <select name="id_akun" class="form-control" required>
                <option value="">-- Pilih Metode Bayar --</option>
                <?php
                $sql_non_tunai = "SELECT * from akun WHERE id_akun BETWEEN 3 AND 6 ORDER BY akun";
                $query_non_tunai = mysqli_query($koneksi, $sql_non_tunai);
                while ($kolom_non_tunai = mysqli_fetch_array($query_non_tunai)) {
                  echo "<option value='$kolom_non_tunai[id_akun]'>$kolom_non_tunai[akun]</option>";
                }

                ?>
              </select>
            </div>
            <div class="form-group col-sm-4">
              <label for="tanggal_transaksi">Tanggal Transaksi</label>
              <input type="date" name="tanggal_transaksi" value="<?php echo date('Y-m-d'); ?>" class="form-control">
            </div>
          </div>

      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Simpan</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal Cetak Nota -->
<div class="modal fade" id="cetakNota" tabindex="-1" aria-labelledby="cetakNotaLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cetakNotaLabel">Cetak Nota Transaksi</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <?php
        if (!empty($_GET['last'])) {
          $url_struk = $BASE_URL . "pdf/output/struk.php?token=" . $_GET['last'];
        }
        ?>
        <div class="embed-responsive embed-responsive-1by1">
          <iframe src="<?= $url_struk; ?>" class="embed-responsive-item"></iframe>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
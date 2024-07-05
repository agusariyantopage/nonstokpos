<?php
  if(!empty($_POST['diskon'])){
    $diskon=str_replace(',','',$_POST['diskon']);
  } else {
    $diskon=0;
  }
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Point Of Sales</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Item Out</a></li>
            <li class="breadcrumb-item"><a href="index.php?p=daftar-penjualan">Penjualan Ritel</a></li>
            <li class="breadcrumb-item active">Input Penjualan</li>
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
              <h3>Input Transaksi Penjualan</h3>
            </div>
            <div class="card-body">

              <form action="aksi/penjualan.php" method="post">
                <input type="hidden" name="aksi" value="keranjang-tambah">
                <div class="form-row">
                  <div class="form-group col-sm-1">
                    <label for="jumlah">Jumlah</label>
                    <input class="form-control" type="number" placeholder="Jumlah . . ." name="jumlah" value=1>
                  </div>
                  <div class="form-group col-sm-7">
                    <label for="deskripsi">Deskripsi Produk</label>
                    <input class="form-control" type="text" autofocus placeholder="Deskripsi . . ." name="produk" required>
                  </div>
                  <div class="form-group col-sm-2">
                    <label for="harga">Harga</label>
                    <input class="form-control" type="number" autofocus placeholder="Harga Jual . . ." name="harga" required>
                  </div>
                  <div class="form-group col-sm-2 align-self-end">
                    
                    <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-plus"></i> Tambah</button>
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
                  $sql2 = "SELECT keranjang.*from keranjang WHERE id_user=$id_user";
                  $query2 = mysqli_query($koneksi, $sql2);
                  $no = 0;
                  $grandtotal = 0;
                  $total = 0;
                  // $diskon = 0;
                  while ($kolom2 = mysqli_fetch_array($query2)) {
                    $no++;
                    $harga = number_format($kolom2['harga']);
                    $jumlah = number_format($kolom2['jumlah']);
                    $subtotal = number_format($kolom2['jumlah'] * $kolom2['harga']);
                    $total = $total + ($kolom2['jumlah'] * $kolom2['harga']);
                    
                    $token = md5($kolom2['id_keranjang']);
                    if ($ENABLE_EDIT_HARGA_JUAL) {
                      $view_harga = "<input type='text' name='harga' class='form-control form-control-sm mb-2 number-separator' value='$harga'>";
                    } else {
                      $view_harga = "<input type='text' name='harga' class='form-control form-control-sm mb-2 number-separator' value='$harga' readonly>";
                    }
                    echo "
                    <tr>
                    <form action='aksi/penjualan.php' method='post'>
                      <td><a href='aksi/penjualan.php?aksi=keranjang-hapus&token=$token'><i class='fas fa-trash'></a></i></td>
                      <td>$no</td>
                      <td><input type='text' name='produk' class='form-control form-control-sm mb-2' value='$kolom2[produk]'></td>
                      <td align=right style='width:150px;'>$view_harga</td>
                      <td align=right style='width:150px;'>                      
                        <input type='hidden' name='aksi' value='keranjang-ubah'> 
                        <input type='hidden' name='id' value='$kolom2[id_keranjang]'> 
                        <div class='form-row'>
                              <div class='col'>
                                  <input type='number' step='0.01' name='qty' class='form-control form-control-sm mb-2' value='$kolom2[jumlah]'>
                              </div>
                              <div class='col'>
                                  <button class='btn btn-sm btn-warning' type='submit' data-toggle='tooltip' data-placement='top' title='Klik Untuk Mengubah Jumlah . . .'><i class='fas fa-edit'></i></button>
                              </div>
                        </div>
                        </form>
                      </td>
                      <td align=right>$subtotal</td>
                    </tr>
                    ";
                  }
                  $grandtotal = $total - $diskon;
                  ?>

                </tbody>
                <tfoot>
                  <tr>
                    <td align='center' colspan="5">GRANDTOTAL</td>
                    <td align='right'>
                      <p><?= number_format($total); ?></p>
                    </td>
                  </tr>
                  <tr>
                    <td align='center' colspan="5">
                      DISKON <button type="button" class="btn btn-link" data-toggle="modal" data-target="#setDiskon"><i class="fas fa-calculator"></i></button>
                    </td>
                    <td align='right'>
                      <p>
                        <?= number_format($diskon); ?>
                      </p>
                    </td>
                  </tr>
                  <tr>
                    <td align='center' colspan="5">GRANDTOTAL</td>
                    <td align='right'>
                      <p><?= number_format($grandtotal); ?></p>
                    </td>
                  </tr>
                </tfoot>
              </table>

            </div>
          </div>
          <?php
          if ($grandtotal > 0) {
            echo "Pilih Metode Pembayaran : ";
            echo "<div class='row'>";
            echo "<div class='col-sm-6 mb-1'>";
            echo "<button type='button' class='btn btn-success btn-block' data-toggle='modal' data-target='#simpanJualModalKas'><i class='fas fa-money-bill-alt'></i> Pembayaran Tunai </button>";
            echo "</div>";
            echo "<div class='col-sm-6 mb-1'>";
            echo "<button type='button' class='btn btn-success btn-block' data-toggle='modal' data-target='#simpanJualModal'><i class='fas fa-address-book'></i> Pembayaran Non Tunai </button>";
            echo "</div>";
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

<!-- Modal Simpan Jual Kas -->
<div class="modal fade" id="simpanJualModalKas" tabindex="-1" aria-labelledby="simpanJualModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="simpanJualModalLabel">Simpan Transaksi Penjualan (Pembayaran Kas)</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="aksi/penjualan.php" method="post">
          <input type="hidden" name="aksi" value="simpan-penjualan">
          <input type="hidden" id="grandtotal" name="total" value="<?= $grandtotal; ?>">
          <input type="hidden" name="diskon" value="<?= $diskon; ?>">
          <input type="hidden" name="metode_bayar" value="TUNAI">
          <input type="hidden" name="id_akun" value="3"> <!-- Kode Akun 'KAS' -->
          <input type="hidden" name="keterangan_non_tunai" value="-"> <!-- Kode Akun 'KAS' -->
          <div class="form-row">
            <div class="form-group col-sm-6">
              <label for="id_anggota">Pelanggan</label>
              <select name="id_anggota" id="id_anggota1" class="select2bs4 form-control" required>
                <?= call_option_selected($koneksi, "anggota", "nama", "id_anggota", "nama", 1); ?>
              </select>
            </div>
            <div class="form-group col-sm-6">
              <label for="tanggal_transaksi">Tanggal Transaksi</label>
              <input type="date" name="tanggal_transaksi" value="<?php echo date('Y-m-d'); ?>" class="form-control" required>
            </div>
          </div>
          <table class="table">
            <tr>
              <td>GRANDTOTAL</td>
              <td>:</td>
              <td align="right">Rp. <?= $grandtotal; ?></td>
            </tr>
            <tr>
              <td>PEMBAYARAN</td>
              <td>:</td>
              <td align="right"><input id="bayar" name="terbayar" min="1" max="<?= $grandtotal; ?>" type="number" class="form-control text-right"></td>
            </tr>
            <tr>
              <td>KEMBALI / SISA PEMBAYARAN</td>
              <td>:</td>
              <td align="right">
                <p id="kembali"></p>
              </td>
            </tr>
          </table>
      </div>
      <div class="modal-footer">
        <button type="submit" onclick="return confirm('Yakin akan diproses??');" class="btn btn-primary">Simpan</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal Simpan Jual Non Tunai -->
<div class="modal fade" id="simpanJualModal" tabindex="-1" aria-labelledby="simpanJualModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="simpanJualModalLabel">Simpan Transaksi Penjualan</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="aksi/penjualan.php" method="post">
          <input type="hidden" name="aksi" value="simpan-penjualan">
          <input type="hidden" name="total" value="<?= $grandtotal; ?>">
          <input type="hidden" name="diskon" value="<?= $diskon; ?>">
          <input type="hidden" name="metode_bayar" value="NON TUNAI">
          <div class="form-row">

            <div class="form-group col-sm-6">
              <label for="id_anggota">Pelanggan</label>
              <select name="id_anggota" id="id_anggota2" class="select2bs4 form-control" required>
                <?= call_option_selected($koneksi, "anggota", "nama", "id_anggota", "nama", 1); ?>
              </select>
            </div>
            <div class="form-group col-sm-6">
              <label for="tanggal_transaksi">Tanggal Transaksi</label>
              <input type="date" name="tanggal_transaksi" value="<?php echo date('Y-m-d'); ?>" class="form-control">
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-sm-12">
              <label for="">Metode Bayar</label>
              <select name="id_akun" class="form-control" required>
                <option value="">-- Pilih Metode Bayar --</option>
                <?php
                $sql_non_tunai = "SELECT * from akun WHERE keterangan='Pembayaran Non Tunai' ORDER BY akun";
                $query_non_tunai = mysqli_query($koneksi, $sql_non_tunai);
                while ($kolom_non_tunai = mysqli_fetch_array($query_non_tunai)) {
                  echo "<option value='$kolom_non_tunai[id_akun]'>$kolom_non_tunai[akun]</option>";
                }

                ?>
              </select>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-sm-12">
              <label for="">Nominal Bayar</label>
              <td>:</td>
              <input name="terbayar" min="1" max="<?= $grandtotal; ?>" type="number" class="form-control text-right">
            </tr>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-sm-12">
              <label for="">Keterangan</label>
              <textarea name="keterangan_non_tunai" class="form-control" rows="4" placeholder="Silahkan diisi dengan no referensi transaksi ataupun catatan lain yang terkait dengan transaksi non tunai"></textarea>
            </div>
          </div>

      </div>
      <div class="modal-footer">
        <button type="submit" onclick="return confirm('Yakin akan diproses??');" class="btn btn-primary">Simpan</button>
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

<!-- Modal Set Diskon -->
<div class="modal fade" id="setDiskon" tabindex="-1" aria-labelledby="setDiskonLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="setDiskonLabel">Setup Diskon</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="post">
          <input type='text' style="text-align:right;" name='diskon' class='form-control form-control-sm mb-2 number-separator' value='<?= number_format($diskon); ?>'>

      </div>
      <div class="modal-footer">
        <button class='btn btn-info' type='submit'><i class='fas fa-check'></i> Proses</button>
        </form>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
<?php
$id_beli = $_GET['token'];
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Pembelian</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Toko</a></li>
            <li class="breadcrumb-item"><a href="index.php?p=daftar-pembelian ">Pembelian</a></li>
            <li class="breadcrumb-item active">Ubah Pembelian</li>
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
          <div class="card">
            <div class="card-header">
              <h3>Ubah Transaksi Pembelian</h3>
            </div>
            <div class="card-body">
              <form action="aksi/pembelian.php" method="post">
                <input type="hidden" name="aksi" value="ubah-pembelian">
                <?php
                $sql1 = "SELECT beli.*,pemasok.nama as nama_pemasok from beli,pemasok where beli.id_pemasok=pemasok.id_pemasok and id_beli='$id_beli'";

                $query1 = mysqli_query($koneksi, $sql1);
                $kolom1 = mysqli_fetch_array($query1);
                ?>

                <div class='row'>
                  <div class='col-md-6'>
                    <label for='id_beli'>Nomor Transaksi</label>
                    <input type='text' name='id_beli' readonly class='form-control' value='<?= $kolom1['id_beli']; ?>'>
                    <input type="hidden" name="id_akun_jurnal" value="<?= $kolom1['id_akun_jurnal']; ?>">
                  </div>
                  <div class='col-md-6'>
                    <label for='tanggal_transaksi'>Tanggal Transaksi</label>
                    <input type='date' name='tanggal_transaksi' class='form-control' value='<?= $kolom1['tanggal_transaksi']; ?>'>
                  </div>
                </div>
                <div class='row'>
                  <div class='col-md-6'>
                    <label for='id_pemasok'>Nama Pemasok</label>
                    <select name='id_pemasok' class='form-control select2bs4' required>
                      <option value="<?= $kolom1['id_pemasok']; ?>"><?= $kolom1['nama_pemasok']; ?></option>
                      <?php
                      $sql2 = 'select * from pemasok order by nama';
                      $query2 = mysqli_query($koneksi, $sql2);
                      while ($kolom2 = mysqli_fetch_array($query2)) {
                        echo "<option value='$kolom2[id_pemasok]'>$kolom2[nama]</option>";
                      }
                      ?>
                    </select>
                  </div>
                  <div class='col-md-6'>
                    <label for='id_akun'>Metode Bayar</label>
                    <select name='id_akun' class='form-control' required>
                      <?php
                      if ($kolom1['jenis_transaksi'] == "PRODUKSI") {
                        call_option_selected_parametered($koneksi, "akun", "akun", "id_akun", "akun", $kolom1['id_akun'], "id_akun=10");
                      } else {
                        call_option_selected_parametered($koneksi, "akun", "akun", "id_akun", "akun", $kolom1['id_akun'], "id_akun BETWEEN 3 AND 6");
                      }

                      ?>
                    </select>
                  </div>
                </div>




                <table class="table table-bordered table-striped mt-3" style="width:100%;">
                  <thead class="thead-dark">
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">ID</th>
                      <th scope="col">Produk</th>
                      <th scope="col">Harga</th>
                      <th scope="col">Jumlah</th>
                      <th scope="col">Subtotal</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php

                    $sql2 = "select beli_detail.*,produk.nama from beli_detail,produk where beli_detail.id_produk=produk.id_produk and id_beli='$id_beli'";
                    $query2 = mysqli_query($koneksi, $sql2);
                    $no = 0;
                    $grandtotal = 0;
                    while ($kolom2 = mysqli_fetch_array($query2)) {
                      $no++;
                      $harga = number_format($kolom2['harga_beli']);
                      $jumlah = number_format($kolom2['jumlah']);
                      $subtotal = number_format($kolom2['jumlah'] * $kolom2['harga_beli']);
                      $grandtotal = $grandtotal + ($kolom2['jumlah'] * $kolom2['harga_beli']);
                      $token = md5($kolom2['id_beli']);
                      echo "
                    <tr>
                      <td>$no</td>
                      <td>$kolom2[id_produk]</td>
                      <td>$kolom2[nama]</td>
                      <td align=right>
                      <input type='hidden' name='id_produk[]' value='$kolom2[id_produk]'>
                      <input type='hidden' name='qty_awal[]' value='$kolom2[jumlah]'>
                      <input type='number' name='harga[]' class='form-control form-control-sm mb-2' value='$kolom2[harga_beli]'>                      
                      </td>
                      <td style='width:150px;'>
                        <div class='form-row'>
                            <div class='col'>
                                <input type='number' name='qty[]' class='form-control form-control-sm mb-2' value='$jumlah'>
                            </div>    
                            
                        </div>    
                      </td>
                      <td align=right>$subtotal</td>
                    </tr>
                    ";
                    }
                    ?>

                  </tbody>
                  <tfoot>
                    <td align='center' colspan="5">GRANDTOTAL</td>
                    <td align='right'>
                      <p><?= number_format($grandtotal); ?></p>
                    </td>
                  </tfoot>
                </table>
                <input type='hidden' name='jumlah_data' value='<?= $no; ?>'>
                <input type='hidden' name='total' value='<?= $grandtotal; ?>'>
                <button type="submit" class="btn btn-info mt-2 mb-2"><i class="fas fa-save"></i> Perbaharui</button>
                <br>Pastikan Semua Data Sudah Benar Sebelum Menekan Tombol Perbaharui !!!
              </form>
            </div>
          </div>
        </div>
        <br><br>

      </row>


    </div><!-- /.container-fluid -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
 <?php
  if (!empty($_GET['tanggal_awal'])) {
    $tanggal_awal = $_GET['tanggal_awal'];
    $tanggal_akhir = $_GET['tanggal_akhir'];
  } else {
    $tanggal_awal = '';
    $tanggal_akhir = '';
  }
  $saldo_awal = 0;
  ?>
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
     <div class="container-fluid">
       <div class="row mb-2">
         <div class="col-sm-6">
           <h1 class="m-0">Kas Toko</h1>
         </div><!-- /.col -->
         <div class="col-sm-6">
           <ol class="breadcrumb float-sm-right">
             <li class="breadcrumb-item"><a href="#">Toko</a></li>
             <li class="breadcrumb-item active">Kas Toko</li>
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
               <h3>Data Mutasi Kas Toko</h3>
             </div>
             <div class="card-body">
               <div class="col-12">
                 <form action="index.php">
                   <input type="hidden" name="p" value="penjualan-info-kas">
                   <div class="row mb-2">
                     <div class="col-4">
                       <label for="tanggal_awal">Tanggal Awal</label>
                       <input type="date" value="<?= $tanggal_awal; ?>" name="tanggal_awal" class="form-control" required>
                     </div>
                     <div class="col-4">
                       <label for="tanggal_akhir">Tanggal Akhir</label>
                       <input type="date" value="<?= $tanggal_akhir; ?>" name="tanggal_akhir" class="form-control" required>
                     </div>
                     <div class="col-4 align-self-end">
                       <button type="submit" class="btn btn-info btn-block"><i class="fa fa-search"></i> Cari</button>
                     </div>
                 </form>
               </div>
               <button type="button" class="btn btn-primary mb-2 btn-block" data-toggle="modal" data-target="#tambahKasModal">
                 <i class="fas fa-plus"></i> Tambah Mutasi Kas</button>
               <br>Data Transaksi Toko
               <table class="table table-bordered table-striped">
                 <!-- Kepala Tabel -->
                 <thead>
                   <tr>
                     <td>#</td>
                     <td>Anggota</td>
                     <td>Tanggal Transaksi</td>
                     <td>Metode Pembayaran</td>
                     <td>Total Belanja</td>
                   </tr>
                 </thead>
                 <!-- Isi Tabel -->
                 <?php
                  $sql_belanja_awal = "SELECT SUM(total) AS belanja_awal FROM jual WHERE metode_bayar='KAS' AND tanggal_transaksi < '$tanggal_awal'";
                  $query_belanja_awal = mysqli_query($koneksi, $sql_belanja_awal);
                  $kolom_belanja_awal = mysqli_fetch_array($query_belanja_awal);
                  $belanja_awal = $kolom_belanja_awal['belanja_awal'];
                  //$sql = "select jual.*,anggota.nama as napel,user.nama as petugas from jual,anggota,user where jual.id_anggota=anggota.id_anggota and jual.id_user=user.id_user and metode_bayar='KAS' order by jual.id_jual desc";
                  $sql = "SELECT jual.*,anggota.nama AS napel,user.nama AS petugas FROM jual,anggota,user WHERE jual.id_anggota=anggota.id_anggota AND jual.id_user=user.id_user AND metode_bayar='KAS' AND jual.tanggal_transaksi BETWEEN '$tanggal_awal' AND '$tanggal_akhir' ORDER BY jual.id_jual desc";
                  $total_masuk = 0;
                  $query = mysqli_query($koneksi, $sql);
                  while ($kolom = mysqli_fetch_array($query)) {
                    $total_masuk = $total_masuk + $kolom['total'];
                  ?>
                   <tr>
                     <td>
                       <button type="button" data-id="<?= $kolom['id_jual']; ?>" class="btn btn-link infopenjualan" data-toggle="modal" data-target="#exampleModal9"><?= $kolom['id_jual']; ?></button>
                     </td>
                     <td><?= $kolom['napel']; ?></td>
                     <td><?= $kolom['tanggal_transaksi']; ?></td>
                     <td><?= $kolom['metode_bayar']; ?></td>
                     <td class="text-right"><?= number_format($kolom['total']); ?></td>
                   </tr>

                 <?php
                  }
                  ?>
                 <tr>
                   <td colspan="4">Total Kas Masuk</td>
                   <td class="text-right"><?= number_format($total_masuk); ?></td>
                 </tr>
               </table>
               <br>Data Mutasi Kas
               <table class="table table-bordered table-striped">
                 <!-- Kepala Tabel -->
                 <thead>
                   <tr>
                     <td>#</td>
                     <td>Tanggal Transaksi</td>
                     <td>Keterangan</td>
                     <td>Jumlah</td>
                   </tr>
                 </thead>
                 <?php
                  $sql_saldo_awal = "SELECT SUM(jumlah) AS saldo_awal FROM akun_mutasi WHERE akun='KAS' AND tanggal < '$tanggal_awal'";
                  $query_saldo_awal = mysqli_query($koneksi, $sql_saldo_awal);
                  $kolom_saldo_awal = mysqli_fetch_array($query_saldo_awal);
                  $saldo_awal = $kolom_saldo_awal['saldo_awal'];
                  ?>
                 <tr>
                   <td>0</td>
                   <td><?= $tanggal_awal; ?></td>
                   <td>Saldo Awal Periode Sebelumnya</td>
                   <td class="text-right"><?= number_format($belanja_awal+$saldo_awal); ?></td>
                 </tr>
                 <!-- Isi Tabel -->
                 <?php

                  //$sql2 = "select * from akun_mutasi where akun='KAS'";
                  $sql2 = "SELECT * FROM akun_mutasi WHERE akun='KAS' AND tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
                  $total_mutasi = $belanja_awal+$saldo_awal;
                  $query2 = mysqli_query($koneksi, $sql2);
                  while ($kolom2 = mysqli_fetch_array($query2)) {
                    $total_mutasi = $total_mutasi + $kolom2['jumlah'];

                  ?>
                   <tr>
                     <td><?= $kolom2['id_akun_mutasi']; ?></td>
                     <td><?= $kolom2['tanggal']; ?></td>
                     <td><?= $kolom2['keterangan']; ?></td>
                     <td class="text-right"><?= number_format($kolom2['jumlah']); ?></td>
                   </tr>

                 <?php
                  }
                  ?>
                 <tr>
                   <td colspan="3">Total Mutasi Kas</td>
                   <td class="text-right"><?= number_format($total_mutasi); ?></td>
                 </tr>
               </table>

               <table class="table table-bordered table-striped mb-2 mt-2">
                 <thead>
                   <tr>
                     <th class="text-right" style="width:33%;">Total Transaksi Toko</th>
                     <th class="text-right" style="width:33%;">Mutasi Kas</th>
                     <th class="text-right" style="width:34%;">Sisa Saldo</th>
                   </tr>
                   <tr>
                     <th class="text-right">Rp. <?= number_format($total_masuk); ?></th>
                     <th class="text-right">Rp. <?= number_format($total_mutasi); ?></th>
                     <th class="text-right">
                       <?php
                        if ($total_masuk + $total_mutasi >= 0) {
                          echo "<font class='text-success'>Rp. " . number_format($total_masuk + $total_mutasi) . "</font>";
                        } else {
                          echo "<font class='text-danger'>Rp. " . number_format($total_masuk + $total_mutasi) . "</font>";
                        }
                        ?>
                     </th>
                   </tr>
                 </thead>
               </table>
             </div>
           </div>
         </div>
       </row>


     </div><!-- /.container-fluid -->

   </section>
   <!-- /.content -->
 </div>
 <!-- /.content-wrapper -->

 <!-- Modal Untuk Informasi Penjualan -->
 <div class="modal fade" id="exampleModal9" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="editModalLabel">Informasi Transaksi Penjualan</h5>
         <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
       </div>
       <div class="modal-body">

       </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>


       </div>
     </div>
   </div>
 </div>

 <!-- Modal Untuk Mutasi Kas -->
 <div class="modal fade" id="tambahKasModal" tabindex="-2" aria-labelledby="editModalLabel" aria-hidden="true">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="editModalLabel">Tambah Mutasi Kas Toko</h5>
         <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
       </div>
       <div class="modal-body">
         <form method="post" enctype="multipart/form-data" action="aksi/akun_mutasi.php">
           <input type="hidden" name="aksi" value="tambah">
           <input type="hidden" name="akun" value="KAS">


           <div>
             <label for="tanggal">Tanggal</label>
             <input type="date" name="tanggal" class="form-control" required>
           </div>

           <div>
             <label for="keterangan">Keterangan</label>
             <textarea name="keterangan" id="keterangan" class="form-control" rows="3" required></textarea>
           </div>
           <div>
             <label for="jumlah">Jumlah (Jika Pengeluaran Tambahkan Simbol -)</label>
             <input type="number" name="jumlah" class="form-control" required>
           </div>


       </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
         <button type="submit" class="btn btn-primary">Tambah</button>
         </form>
       </div>
     </div>
   </div>
 </div>
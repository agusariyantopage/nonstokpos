 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <div class="content-header">
         <div class="container-fluid">
             <div class="row mb-2">
                 <div class="col-sm-6">
                     <h1 class="m-0">Pemeliharaan</h1>
                 </div><!-- /.col -->
                 <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                         <li class="breadcrumb-item"><a href="#">Pemeliharaan</a></li>
                         <li class="breadcrumb-item active">Transaksi Berbeda Total</li>
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
                     <div class="btn-group mb-3" role="group" aria-label="Basic example">
                         <a href="index.php?p=pemeliharaan"><button type="button" class="btn btn-warning mr-1">Data Ganda</button></a>
                         <a href="index.php?p=pemeliharaan-tidakwajar"><button type="button" class="btn btn-warning mr-1">Harga Tidak Wajar</button></a>
                         <a href="index.php?p=pemeliharaan-beda-total"><button type="button" class="btn btn-warning mr-1">Beda Total</button></a>
                     </div>

                     <div class="card">
                         <div class="card-header">
                             <h3>Data Suspend Transaksi Berbeda Total</h3>
                         </div>
                         <div class="card-body">


                             <table id="example1" class="table table-bordered table-striped">
                                 <!-- Kepala Tabel -->
                                 <thead>
                                     <tr>
                                         <td>#</td>
                                         <td>ID Trx</td>
                                         <td>Total Buku</td>
                                         <td>Total Akumulasi</td>
                                         <td>Selisih</td>
                                         <td>Aksi</td>
                                     </tr>
                                 </thead>
                                 <!-- Isi Tabel -->
                                 <?php
                                    $no = 0;
                                    $sql = "SELECT id_anggota,jual.id_jual,jual.total,SUM(jual_detail.harga_jual*jual_detail.jumlah) AS total_akumulasi,SUM(jual_detail.harga_jual*jual_detail.jumlah)-jual.total AS selisih FROM jual,jual_detail WHERE jual.id_jual=jual_detail.id_jual GROUP BY jual_detail.id_jual";
                                    $query = mysqli_query($koneksi, $sql);
                                    while ($kolom = mysqli_fetch_array($query)) {
                                        if ($kolom['selisih'] != 0) {
                                            $no++;
                                    ?>
                                         <tr>
                                             <td><?= $no; ?></td>
                                             <td><button type="button" class="btn btn-link infopenjualan" data-toggle="modal" data-target="#exampleModal" data-id="<?= $kolom['id_jual']; ?>"><?= $kolom['id_jual']; ?></button></td>
                                             <td><?= number_format($kolom['total']); ?></td>
                                             <td><?= number_format($kolom['total_akumulasi']); ?></td>
                                             <td><?= number_format($kolom['selisih']); ?></td>
                                             <td>
                                                 <form action="aksi/pemeliharaan.php" method="POST">
                                                     <input type="hidden" name="aksi" value="proses-beda-total">
                                                     <input type="hidden" name="id_jual" value="<?= $kolom['id_jual']; ?>">
                                                     <input type="hidden" name="selisih" value="<?= $kolom['selisih']; ?>">
                                                     <input type="hidden" name="id_anggota" value="<?= $kolom['id_anggota']; ?>">
                                                     <button type="submit" class="btn btn-info btn-small text-sm"><i class='fas fa-cog'></i> Sesuaikan</button>
                                                 </form>
                                             </td>
                                         </tr>

                                 <?php
                                        }
                                    }
                                    ?>
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

 <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
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
 <!-- Modal Untuk Informasi Penjualan -->

 <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-lg">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="editModalLabel">Penghapusan Transaksi Penjualan</h5>
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
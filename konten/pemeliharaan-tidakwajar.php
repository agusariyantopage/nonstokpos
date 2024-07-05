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
             <li class="breadcrumb-item active">Transaksi Harga Jual Tidak Wajar</li>
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
               <h3>Data Suspend Harga Jual Tidak Wajar</h3>
             </div>
             <div class="card-body">


               <table id="example1" class="table table-bordered table-striped">
                 <!-- Kepala Tabel -->
                 <thead>
                   <tr>
                     <td>#</td>
                     <td>ID Trx</td>
                     <td>ID Produk</td>
                     <td>Harga Pokok</td>
                     <td>Harga Jual</td>
                     <td>Aksi</td>
                   </tr>
                 </thead>
                 <!-- Isi Tabel -->
                 <?php
                  $no = 0;
                  $sql = "SELECT * FROM jual_detail WHERE harga_jual<hpp ORDER BY id_jual DESC";
                  $query = mysqli_query($koneksi, $sql);
                  while ($kolom = mysqli_fetch_array($query)) {
                    $no++;
                  ?>
                   <tr>
                     <td><?= $no; ?></td>
                     <td><button type="button" class="btn btn-link infopenjualan" data-toggle="modal" data-target="#exampleModal" data-id="<?= $kolom['id_jual']; ?>"><?= $kolom['id_jual']; ?></button></td>
                     <td><?= $kolom['id_produk']; ?></td>
                     <td><?= number_format($kolom['hpp']); ?></td>
                     <td><?= number_format($kolom['harga_jual']); ?></td>
                     <td></td>
                   </tr>

                 <?php
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
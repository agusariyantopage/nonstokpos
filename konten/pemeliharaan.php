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
             <li class="breadcrumb-item active">Beranda</li>
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
               <h3>Data Suspend Transaksi Ganda</h3>
             </div>
             <div class="card-body">
              

               <table id="example1" class="table table-bordered table-striped">
                 <!-- Kepala Tabel -->
                 <thead>
                   <tr>
                     <td>#</td>
                     <td>ID Anggota</td>
                     <td>Tanggal Transaksi</td>                     
                     <td>Metode Bayar</td>                     
                     <td>Total Belanja</td>                
                     <td>Nomor Transaksi</td>
                     <td>Merge</td>
                   </tr>
                 </thead>
                 <!-- Isi Tabel -->
                 <?php
                  $no=0;
                  $sql="SELECT id_jual,id_anggota,tanggal_transaksi,metode_bayar,total,count(*) as dup from jual GROUP BY id_anggota,tanggal_transaksi,metode_bayar,total HAVING dup>1 ORDER BY jual.tanggal_transaksi DESC";
                  $query = mysqli_query($koneksi, $sql);
                  while ($kolom = mysqli_fetch_array($query)) {
                    $id_anggota=$kolom['id_anggota'];
                    $tanggal_transaksi=$kolom['tanggal_transaksi'];
                    $total=$kolom['total'];
                    $no++;

                  ?>
                   <tr>
                     <td><?= $no; ?></td>
                     <td><?= $kolom['id_anggota']; ?></td>
                     <td><?= $kolom['tanggal_transaksi']; ?></td>                     
                     <td><?= $kolom['metode_bayar']; ?></td>                     
                     <td><?= number_format($kolom['total']); ?></td>              
                     <td>
                       <div class="row">       
                         
                         <?php
                          $sql1="select * from jual where id_anggota=$id_anggota and tanggal_transaksi='$tanggal_transaksi' and total=$total";
                          $noid=0;
                          $query1=mysqli_query($koneksi,$sql1);
                            while ($kolom1 = mysqli_fetch_array($query1)) {  
                              $noid++;
                              $idjual[$noid]=$kolom1['id_jual'];                            
                          ?>
                            <button type="button" class="btn btn-link infopenjualan" data-toggle="modal" data-target="#exampleModal" data-id="<?= $kolom1['id_jual']; ?>"><?= $kolom1['id_jual'];?></button>
                              
                          <?php    
                            }
                         ?>
                       </div>
                       <td><button type="button" class="btn btn-link"><a onclick="return confirm('Proses merge akan menghapus file duplikat dan semua data turunannya, yakin akan memproses??')" href="aksi/pemeliharaan.php?aksi=merge&id1=<?= $idjual[1]; ?>&id2=<?= $idjual[2]; ?>"><i class="fas fa-file-export"></i></a></button></td>

                     </td>
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
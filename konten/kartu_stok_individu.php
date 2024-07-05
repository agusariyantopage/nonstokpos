<?php
    $id=$_GET['id'];
    $sql1="select * from produk where id_produk=$id";
    $query1=mysqli_query($koneksi,$sql1);
    $data=mysqli_fetch_array($query1);
 ?>
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Kartu Stok Produk</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Toko</a></li>
                <li class="breadcrumb-item"><a href="index.php?p=kartu-stok">Kartu Stok</a></li>
                <li class="breadcrumb-item active">Kartu Stok Individual</li>
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
              <h3><?= $data['nama']; ?></h3>
            </div> 
            <div class="card-body">              
              
              <table id="noorder" class="table table-bordered table-striped table-sm">
                <!-- Kepala Tabel -->
                <thead>
                  <tr>
                    <td>No</td>                    
                    <td>Waktu Transaksi</td>
                    <td>Tipe Transaksi</td>
                    <td>HPP</td>
                    <td>Jumlah</td>
                    <td>Saldo</td>
                  </tr>
                </thead>
                <!-- Isi Tabel -->
<?php
   $no=0; 
   $saldo=0;
   $sql="select *, @saldo := @saldo+jumlah as saldo from (SELECT id_beli,id_produk,'Masuk' trans_type, harga_beli, jumlah, dibuat_pada, diubah_pada FROM beli_detail where id_produk=$id UNION SELECT id_jual,id_produk,'Keluar' trans_type, hpp, -jumlah, dibuat_pada, diubah_pada FROM jual_detail where id_produk=$id) tx join ( select @saldo:=0 ) sx on 1=1 order by dibuat_pada";
   $query=mysqli_query($koneksi,$sql);
   while($kolom=mysqli_fetch_array($query)){
     $no++;
?>                
                <tr>
                  <td><?= $no; ?></td>
                  <td><?= $kolom['dibuat_pada']; ?></td>
                  <td><?= $kolom['trans_type']." #".$kolom['id_beli']; ?></td>
                  <td><?= number_format($kolom['harga_beli']); ?></td>
                  <td><?= number_format($kolom['jumlah']); ?></td>
                  <td><?= number_format($kolom['saldo']); ?></td>
             
                </tr>
       
<?php
  $saldo=$kolom['saldo'];
  }
?>                
              </table>
              <label for=""><?= "Data Sistem Stok :".$data['qty']." | Data Historis :".$saldo;?></label>
              <br>
              <?php if($data['qty']!=$saldo && $data['servis']==0)
                {
              ?>  
              <form action="aksi/produk.php" method="post">
                <input type="hidden" name="aksi" value='penyesuaian-stok'>
                <input type="hidden" name="qty" value='<?= $saldo; ?>'>                
                <input type="hidden" name="id_produk" value='<?= $id; ?>'>                
                <button type="submit" class="btn btn-info"><i class="fas fa-calculator"></i> Proses Adjustment</button>
              </form>
              <?php } ?>
            </div> 
          </div>
        </div>
      </row>
             
        
      </div><!-- /.container-fluid -->
      
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
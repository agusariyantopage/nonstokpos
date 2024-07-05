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
              <li class="breadcrumb-item active">Kartu Stok</li>
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
              <h3>Data Kartu Stok Produk</h3>
            </div> 
            <div class="card-body">              
              
              <table id="noorder" class="table table-bordered table-striped table-sm">
                <!-- Kepala Tabel -->
                <thead>
                  <tr>
                    <td>Nama Produk</td>
                    <td>Satuan</td>                    
                    <td>Barcode</td>
                    <td>Kategori</td>
                    <td>Masuk</td>
                    <td>Keluar</td>
                    <td>Stok</td>
                    <td>Detail</td>
                  </tr>
                </thead>
                <!-- Isi Tabel -->
<?php
   $sql="select produk.*,produk_kategori,(select SUM(jumlah) from beli_detail where beli_detail.id_produk=produk.id_produk limit 1) as produk_in,(select SUM(jumlah) from jual_detail where jual_detail.id_produk=produk.id_produk limit 1) as produk_out from produk,produk_kategori where produk.id_produk_kategori=produk_kategori.id_produk_kategori order by nama";
   $query=mysqli_query($koneksi,$sql);
   while($kolom=mysqli_fetch_array($query)){
?>                
                <tr>
                  <td><?= $kolom['nama']; ?></td>
                  <td><?= $kolom['satuan']; ?></td>
                  <td><?= $kolom['barcode']; ?></td>
                  <td><?= $kolom['produk_kategori']; ?></td>
                  <td><?= number_format($kolom['produk_in']); ?></td>
                  <td><?= number_format($kolom['produk_out']); ?></td>
                  <td><?= number_format($kolom['qty']); ?></td>
                  <td><a target="_blank" href="index.php?p=kartu-stok-individu&id=<?= $kolom['id_produk']; ?>"><i class="fas fa-chart-line"></i></a>
                    
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
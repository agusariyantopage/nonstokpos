 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Produk Konsinyasi</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Data Pokok</a></li>
              <li class="breadcrumb-item"><a href="index.php?p=produk">Produk</a></li>
              <li class="breadcrumb-item active">Konsinyasi</li>
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
              <h3>Data Produk Konsinyasi</h3>
              <h6><i> *Centang Ya Pada Produk Konsinyasi</i></h6>
            </div> 
            <div class="card-body">
              
              
              <table id="finditem" class="table table-bordered table-striped">
                <!-- Kepala Tabel -->
                <thead>
                  <tr>
                    <td>ID</td>
                    <td>Nama Produk</td>
                    <td>Barcode</td>
                    <td>Kategori</td>
                    <td>Stok</td>
                    <td>Harga Modal</td>
                    <td>Harga Jual</td>
                    <td>Satuan</td>                    
                    <td>Ya?</td>
                  </tr>
                </thead>
                <!-- Isi Tabel -->
<?php
   $sql="select produk.*,produk_kategori from produk,produk_kategori where produk.id_produk_kategori=produk_kategori.id_produk_kategori order by nama";
   $query=mysqli_query($koneksi,$sql);
   while($kolom=mysqli_fetch_array($query)){
?>                
                <tr>
                  <td><?= $kolom['id_produk']; ?></td>
                  <td><?= $kolom['nama']; ?></td>
                  <td><?= $kolom['barcode']; ?></td>
                  <td><?= $kolom['produk_kategori']; ?></td>
                  <td><?= number_format($kolom['qty']); ?></td>
                  <td><?= number_format($kolom['hpp']); ?></td>
                  <td><?= number_format($kolom['harga_jual']); ?></td>
                  <td><?= $kolom['satuan']; ?></td>
                  <td align="right">
                    <?php
                        $id_check="cek-konsinyasi".$kolom['id_produk'];
                        if($kolom['konsinyasi']==1){
                            echo "<input type='checkbox' data-id='$kolom[id_produk]' checked id='$id_check' name='konsinyasi' class='form-check-input cek-konsinyasi'>";
                        } else {
                            echo "<input type='checkbox' data-id='$kolom[id_produk]' id='$id_check' name='konsinyasi' class='form-check-input cek-konsinyasi'>";
                        }
                    ?>
                                     
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
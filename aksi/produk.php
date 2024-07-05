<?php
    session_start();
    include "../koneksi.php";
    include "../function.php";

    if(!empty($_POST)){
        if($_POST['aksi']=='tambah'){
            $barcode=$_POST['barcode'];
            $id_produk_kategori=$_POST['idkategori']; 
            $nama=$_POST['nama'];
            $satuan=$_POST['satuan']; 
            $keterangan=$_POST['keterangan']; 
            $gambar=''; 
            $hpp=$_POST['hargamodal']; 
            $hpp_awal=0; 
            $qty=0; 
            $qty_awal=0; 
            $harga_jual=$_POST['hargajual']; 
            $stok_min=$_POST['stok_minimum']; 
            $servis=$_POST['jasa']; 
            
            $sql="insert into produk (barcode, id_produk_kategori, nama, satuan, keterangan, gambar, hpp, hpp_awal, qty, qty_awal, harga_jual, stok_min, servis, dibuat_pada, diubah_pada) values('$barcode', $id_produk_kategori, '$nama', '$satuan', '$keterangan', '$gambar', $hpp, $hpp_awal, $qty, $qty_awal, $harga_jual, $stok_min, $servis, DEFAULT, DEFAULT)";
            mysqli_query($koneksi,$sql);
            pesan_transaksi($koneksi);
            //echo $sql;
            header('location:../index.php?p=produk-tambah');
        }
        else if($_POST['aksi']=='ubah'){
            $id_produk=$_POST['id'];
            $barcode=$_POST['barcode'];
            $id_produk_kategori=$_POST['idkategori']; 
            $nama=$_POST['nama'];
            $satuan=$_POST['satuan']; 
            $keterangan=$_POST['keterangan']; 
            $gambar=''; 
            $hpp=$_POST['hargamodal']; 
            $harga_jual=$_POST['hargajual']; 
            $stok_min=$_POST['stok_minimum']; 
            $servis=$_POST['jasa']; 

            $sql="update produk set barcode='$barcode', id_produk_kategori=$id_produk_kategori, nama='$nama', satuan='$satuan', keterangan='$keterangan', gambar='$gambar', hpp=$hpp, harga_jual=$harga_jual, stok_min=$stok_min, servis=$servis, diubah_pada=DEFAULT where id_produk=$id_produk";
            mysqli_query($koneksi,$sql);
            pesan_transaksi($koneksi);
            header('location:../index.php?p=produk');
        }
        else if($_POST['aksi']=='penyesuaian-stok'){
            $id_produk=$_POST['id_produk'];
            $qty=$_POST['qty'];
            $sql="update produk set qty=$qty, diubah_pada=DEFAULT where id_produk=$id_produk";
            mysqli_query($koneksi,$sql);

            $sukses=mysqli_affected_rows($koneksi);
            if($sukses>=1){
                $_SESSION['status_proses'] ='SUKSES SIMPAN BELI';                    
            }
            //echo $sukses;
            $link="location:../index.php?p=kartu-stok-individu&id=$id_produk";
            header($link);
            

        }
        else if($_POST['aksi']=='ubah-status-konsinyasi'){
            $id_produk=$_POST['id_produk'];
            $konsinyasi=$_POST['konsinyasi'];
            $sql="update produk set konsinyasi=$konsinyasi, diubah_pada=DEFAULT where id_produk=$id_produk";            
            mysqli_query($koneksi,$sql);
        }
    }
    

    if(!empty($_GET['aksi'])){
        if($_GET['aksi']=='hapus'){
            $x0=$_GET['token'];
            // Jalankan Prosedur Cek Data
            $cek1="select * from beli_detail where md5(id_produk)='$x0'";
            $query1=mysqli_query($koneksi,$cek1);
            $ketemu1=mysqli_num_rows($query1);
            if($ketemu1==0){
                $cek2="select * from jual_detail where md5(id_produk)='$x0'";
                $query2=mysqli_query($koneksi,$cek2);
                $ketemu2=mysqli_num_rows($query2);
                if($ketemu2==0){
                    $sql="delete from produk where md5(id_produk)='$x0'";
                    mysqli_query($koneksi,$sql);
                    //echo $sql;
                }
            }
            
            //echo $sql;
            header('location:../index.php?p=produk');
        }
        if($_GET['aksi']=='buang-spasi'){
            $sql="update produk set nama=trim(nama)";
            mysqli_query($koneksi,$sql);
            //echo $sql;
            header('location:../index.php?p=produk');
        }
        if($_GET['aksi']=='set-kapital'){
            $sql="update produk set nama=upper(nama)";
            mysqli_query($koneksi,$sql);
            //echo $sql;
            header('location:../index.php?p=produk');
        }
        if($_GET['aksi']=='set-proper'){
            $sql="UPDATE produk SET nama = CONCAT(UPPER(SUBSTRING(nama, 1, 1)), LOWER(SUBSTRING(nama FROM 2)))";
            mysqli_query($koneksi,$sql);
            //echo $sql;
            header('location:../index.php?p=produk');
        }
        
    }
?>
<?php
    session_start();
    include "../koneksi.php";
    include "../function.php";

    if(!empty($_POST)){
        if($_POST['aksi']=='tambah'){
            $nama=$_POST['nama'];
            $alamat=$_POST['alamat'];
            $telepon=$_POST['telepon'];
            $email=$_POST['email'];
                       
            $sql="insert into pemasok (nama, alamat, telepon, email, dibuat_pada, diubah_pada) values('$nama', '$alamat', '$telepon', '$email', DEFAULT, DEFAULT)";
            mysqli_query($koneksi,$sql);
            pesan_transaksi($koneksi);
            //echo $sql;
            header('location:../index.php?p=pemasok');
        }
        else if($_POST['aksi']=='ubah'){
            $id_pemasok=$_POST['id_pemasok'];
            $nama=$_POST['nama'];
            $alamat=$_POST['alamat'];
            $telepon=$_POST['telepon'];
            $email=$_POST['email'];                       

            $sql="update pemasok set nama='$nama', alamat='$alamat', telepon='$telepon', email='$email', dibuat_pada=dibuat_pada, diubah_pada=DEFAULT where id_pemasok=$id_pemasok";
            mysqli_query($koneksi,$sql);
            pesan_transaksi($koneksi);
            header('location:../index.php?p=pemasok');
        }
    }

    if(!empty($_GET['aksi'])){
        if($_GET['aksi']=='hapus'){
            $x0=$_GET['token'];
            // Jalankan Prosedur Cek Data
            $sql="delete from pemasok where md5(id_pemasok)='$x0'";
            mysqli_query($koneksi,$sql);
            pesan_transaksi($koneksi);
            //echo $sql;
            header('location:../index.php?p=pemasok');
        }
        if($_GET['aksi']=='buang-spasi'){
            $sql="update pemasok set nama=trim(nama)";
            mysqli_query($koneksi,$sql);
            //echo $sql;
            header('location:../index.php?p=pemasok');
        }
        if($_GET['aksi']=='set-kapital'){
            $sql="update pemasok set nama=upper(nama)";
            mysqli_query($koneksi,$sql);
            //echo $sql;
            header('location:../index.php?p=pemasok');
        }
        if($_GET['aksi']=='set-proper'){
            $sql="UPDATE pemasok SET nama = CONCAT(UPPER(SUBSTRING(nama, 1, 1)), LOWER(SUBSTRING(nama FROM 2)))";
            mysqli_query($koneksi,$sql);
            //echo $sql;
            header('location:../index.php?p=pemasok');
        }
        
    }
?>
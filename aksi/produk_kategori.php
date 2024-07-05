<?php
    session_start();
    include "../koneksi.php";

    if(!empty($_POST)){
        if($_POST['aksi']=='tambah'){
            $x1=$_POST['kategori'];
            $sql="insert into produk_kategori (produk_kategori,dibuat_pada,diubah_pada) values('$x1',DEFAULT,DEFAULT)";
            mysqli_query($koneksi,$sql);
            header('location:../index.php?p=kategori');
        }
        else if($_POST['aksi']=='ubah'){
            $x0=$_POST['id'];
            $x1=$_POST['kategori'];
            $sql="update produk_kategori set produk_kategori='$x1',diubah_pada=DEFAULT where id_produk_kategori=$x0";
            mysqli_query($koneksi,$sql);
            header('location:../index.php?p=kategori');
        }
    }

    if(!empty($_GET['aksi'])){
        $x0=$_GET['id'];
        $sql="delete from produk_kategori where id_produk_kategori=$x0";
        mysqli_query($koneksi,$sql);
        header('location:../index.php?p=kategori');
    }
?>
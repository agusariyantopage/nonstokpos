<?php
function call_option($koneksi, $nama_tabel, $order_by, $value, $display)
{
    $sql = "SELECT * FROM " . $nama_tabel . " ORDER BY " . $order_by;
    $query = mysqli_query($koneksi, $sql);
    while ($kolom = mysqli_fetch_array($query)) {
        echo "<option value='$kolom[$value]'>$kolom[$display]</option>";
    }
}

function call_option_selected($koneksi, $nama_tabel, $order_by, $value, $display, $selected_id)
{
    $sql = "SELECT * FROM " . $nama_tabel . " ORDER BY " . $order_by;
    $query = mysqli_query($koneksi, $sql);
    while ($kolom = mysqli_fetch_array($query)) {
        echo ($selected_id == $kolom[$value]) ? "<option value='$kolom[$value]' selected>$kolom[$display]</option>" : "<option value='$kolom[$value]'>$kolom[$display]</option>";
    }
}

function call_option_selected_parametered($koneksi, $nama_tabel, $order_by, $value, $display, $selected_id,$parameter)
{
    $sql = "SELECT * FROM " . $nama_tabel . " WHERE ".$parameter." ORDER BY " . $order_by;
    $query = mysqli_query($koneksi, $sql);
    while ($kolom = mysqli_fetch_array($query)) {
        echo ($selected_id == $kolom[$value]) ? "<option value='$kolom[$value]' selected>$kolom[$display]</option>" : "<option value='$kolom[$value]'>$kolom[$display]</option>";
    }
}

// Fungsi  Get Data
function get_all_data($koneksi,$nama_tabel,$kolom_ditampilkan)
{
    $sql = "SELECT * FROM " . $nama_tabel;
    $query = mysqli_query($koneksi, $sql);    
    while($kolom = mysqli_fetch_array($query)){
        echo "<tr>";
            $array=explode(",",$kolom_ditampilkan);
            $jumlah_data=count($array);
            for($i=0;$i<$jumlah_data;$i++){
                echo "<td>".$kolom[$array[$i]]."</td>";
            }
        echo "</tr>";
    }   
    
}

// Fungsi  Get Single Data
function get_single_data($koneksi,$nama_tabel,$kolom_kunci,$nilai_kunci)
{
    $sql = "SELECT * FROM " . $nama_tabel . " WHERE " . $kolom_kunci ."=".$nilai_kunci;
    $query = mysqli_query($koneksi, $sql);
    $data = mysqli_fetch_array($query);
    return $data;
}

// Fungsi  Get Single Data 2 Paramater
function get_single_data_2param($koneksi,$nama_tabel,$kolom_kunci1,$nilai_kunci1,$kolom_kunci2,$nilai_kunci2)
{
    $sql = "SELECT * FROM " . $nama_tabel . " WHERE " . $kolom_kunci1 ."=".$nilai_kunci1." AND ".$kolom_kunci2 ."=".$nilai_kunci2;
    $query = mysqli_query($koneksi, $sql);
    $data = mysqli_fetch_array($query);
    return $data;
}

// Fungsi  Get Last Data
function get_last_data($koneksi,$nama_tabel,$order_by)
{
    $sql = "SELECT * FROM " . $nama_tabel . " ORDER BY ".$order_by." DESC LIMIT 1";
    $query = mysqli_query($koneksi, $sql);
    $data = mysqli_fetch_array($query);
    return $data;
}

// Fungsi  Get Jumlah Data (Menampilkan Jumlah Data Dari Hasil Query)
function get_jumlah_data($koneksi,$nama_tabel,$kolom_kunci,$nilai_kunci)
{
    $sql = "SELECT * FROM " . $nama_tabel . " WHERE " . $kolom_kunci ."='".$nilai_kunci."'";
    $query = mysqli_query($koneksi, $sql);
    $data = mysqli_num_rows($query);
    return $data;
}

//Fungsi Cek Status Lunas
function cek_status_lunas_penjualan($koneksi,$id_jual)
{
    $sql1="SELECT SUM(jumlah) AS total_bayar FROM jual_pembayaran WHERE id_jual=$id_jual";
    $query1=mysqli_query($koneksi,$sql1);
    $data1=mysqli_fetch_array($query1);
    $total_bayar=$data1['total_bayar'];

    $sql2="SELECT * FROM jual WHERE id_jual=$id_jual";
    $query2=mysqli_query($koneksi,$sql2);
    $data2=mysqli_fetch_array($query2);
    $total_tagihan=$data2['total']-$data2['diskon']+$data2['pajak'];
    $sisa=$total_tagihan-$total_bayar;

    if($sisa>=1){
        $sql3="UPDATE jual SET status_bayar='Belum Lunas',terbayar=$total_bayar,diubah_pada=DEFAULT WHERE id_jual=$id_jual";
    } else {
        $sql3="UPDATE jual SET status_bayar='Lunas',terbayar=$total_bayar,diubah_pada=DEFAULT WHERE id_jual=$id_jual";
    }
    mysqli_query($koneksi,$sql3);

}

// Fungsi Akuntansi Posting Jurnal
function get_id_jurnal($koneksi)
{
    $sql = "SELECT * FROM akun_jurnal ORDER BY id_akun_jurnal DESC LIMIT 1";
    $query = mysqli_query($koneksi, $sql);
    $data = mysqli_fetch_array($query);
    return $data['id_akun_jurnal'];
}

function posting_jurnal($koneksi, $tanggal_transaksi, $deskripsi,$deskripsi_transaksi, $id_akun_debet, $id_akun_kredit, $nominal_transaksi)
{
    $nomor_jurnal='';
    $sql = "INSERT INTO akun_jurnal(id_akun_jurnal, nomor_jurnal, deskripsi,deskripsi_transaksi, tanggal_transaksi, dibuat_pada, diubah_pada) VALUES(DEFAULT,'$nomor_jurnal','$deskripsi','$deskripsi_transaksi','$tanggal_transaksi',DEFAULT,DEFAULT)";
    mysqli_query($koneksi, $sql);

    $id_akun_jurnal = get_id_jurnal($koneksi);
    
    $sql_debet = "INSERT INTO akun_mutasi(id_akun_mutasi, id_akun_jurnal, id_akun, debet, kredit, dibuat_pada, diubah_pada) VALUES(DEFAULT, $id_akun_jurnal, $id_akun_debet, $nominal_transaksi, 0, DEFAULT, DEFAULT)";
    mysqli_query($koneksi, $sql_debet);
    //echo $id_akun_jurnal;    
    $sql_kredit = "INSERT INTO akun_mutasi(id_akun_mutasi, id_akun_jurnal, id_akun, kredit, debet, dibuat_pada, diubah_pada) VALUES(DEFAULT, $id_akun_jurnal, $id_akun_kredit, $nominal_transaksi, 0, DEFAULT, DEFAULT)";
    mysqli_query($koneksi, $sql_kredit);
}

function unposting_jurnal($koneksi,$id_akun_jurnal){
    $sql1="DELETE FROM akun_jurnal WHERE id_akun_jurnal=$id_akun_jurnal";
    mysqli_query($koneksi,$sql1);

    $sql2="DELETE FROM akun_mutasi WHERE id_akun_jurnal=$id_akun_jurnal";
    mysqli_query($koneksi,$sql2);
    // echo $sql1;
    // echo $sql2;

}

function get_nama_akun($koneksi, $id_akun)
{
    $sql = "SELECT * FROM akun WHERE id_akun=$id_akun";
    $query = mysqli_query($koneksi, $sql);
    $kolom = mysqli_fetch_array($query);
    return $kolom['akun'];
}
function pesan_transaksi($koneksi)
    {
        $sukses = mysqli_affected_rows($koneksi);
        if ($sukses >= 1) {
            $_SESSION['status_proses'] = 'SUKSES';
        } else {
            $_SESSION['status_proses'] = 'GAGAL';
        }
    }


?>

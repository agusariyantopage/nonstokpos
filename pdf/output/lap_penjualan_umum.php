<?php
session_start();
include '../../koneksi.php';
include '../../function.php';

//============================================================+
// File name   : example_006.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 006 for TCPDF class
//               WriteHTML and RTL support
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: WriteHTML and RTL support
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

class MYPDF extends TCPDF {   

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number        
        
        $this->Cell(0, 10, 'Dicetak Oleh : '.$_SESSION['backend_user_nama'].' pada '.date("d-M-Y H:i:s"), 0, false, 'L', 0, '', 0, false, 'T','M');
        $this->Cell(0, 10, 'Halaman '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
        
        // output the HTML content
        // $pdf->writeHTML($html_footer, true, false, true, false, '');
    }
}

// create new PDF document
$pdf = new MYPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Agus Ariyanto');
$pdf->SetTitle('Laporan Penjualan - Umum');
$pdf->SetSubject('Laporan Penjualan');
$pdf->SetKeywords('Laporan Penjualan');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
    require_once(dirname(__FILE__) . '/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('dejavusans', '', 10);

// add a page
$pdf->AddPage();
$tanggal_awal = $_GET['tanggal_awal'];
$tanggal_akhir = $_GET['tanggal_akhir'];
// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)

// create some HTML content
$html = '<p style="text-align: center;"><strong>Laporan Periodik</strong></p>
<table style="width:100%;">    
    <tr>
        <td style="width:10%;">Periode</td>
        <td style="width:50%;">: ' . date("d-M-Y", strtotime($tanggal_awal)) . ' S/D ' . date("d-M-Y", strtotime($tanggal_akhir)) . ' </td>
        
    </tr>
</table>
<br><br>
<b>Transaksi Toko</b><br>
<table style=" border-collapse: collapse;" border="1">
    <tr>      
      <th align="center" style="width:5%;">#</th>
      <th align="center" style="width:30%;">Konsumen</th>
      <th align="center" style="width:15%;">Tanggal Transaksi</th>
      <th align="center" style="width:20%;">Total Nilai Transaksi</th>
      <th align="center" style="width:15%;">Terbayar</th>
      <th align="center" style="width:15%;">Sisa</th>
    </tr>

<tbody>';

$sql1 = "select jual.*,nama from jual,anggota where jual.id_anggota=anggota.id_anggota and (tanggal_transaksi BETWEEN '$tanggal_awal' and '$tanggal_akhir')";
$query1 = mysqli_query($koneksi, $sql1);

$no = 0;
$grandtotal = 0;
$terbayar = 0;
while ($kolom1 = mysqli_fetch_array($query1)) {
    $no++;
    $grandtotal = $grandtotal + $kolom1['total'];
    $terbayar = $terbayar + $kolom1['terbayar'];
    $html .= '
        <tr>
            <td>' . $no . '</td>
            <td> TRX#'.$kolom1['id_jual'].' '. $kolom1['nama'] . '</td>
            <td>' . date("d-m-Y", strtotime($kolom1['tanggal_transaksi'])) . '</td>            
            <td align="right">' . number_format($kolom1['total']) . '</td>
            <td align="right">' . number_format($kolom1['terbayar']) . '</td>
            <td align="right">' . number_format($kolom1['total']-$kolom1['terbayar']) . '</td>
        </tr>
        ';
}

$html .= '<tr class="text-weight:bold;">
        <td align="center" colspan="3"><b>GRANDTOTAL</b></td>
        <td align="right"><b>' . number_format($grandtotal) . '</b></td>
        <td align="right"><b>' . number_format($terbayar) . '</b></td>
        <td align="right"><b>' . number_format($grandtotal-$terbayar) . '</b></td>
        </tr>
</tbody>
</table>
';

// Awal Mutasi Kas
$id_akun_kas=3;
$akun_kas=get_nama_akun($koneksi,$id_akun_kas);
$html.='
<br><br><b>Mutasi Kas</b><br>
<table style=" border-collapse: collapse;" border="1">
    <tr>      
      <th align="center" style="width:10%;">#</th>
      <th align="center" style="width:15%;">Tanggal Transaksi</th>
      <th align="center" style="width:30%;">Keterangan Transaksi</th>
      <th align="center" style="width:20%;">Total</th>
      <th align="center" style="width:25%;">Saldo</th>
    </tr>

<tbody>';

    // Hitung Saldo Awal
$sql_saldo_awal="SELECT SUM(debet-kredit) as total_transaksi from akun_mutasi,akun_jurnal where akun_mutasi.id_akun_jurnal=akun_jurnal.id_akun_jurnal and akun_mutasi.id_akun=$id_akun_kas and tanggal_transaksi < '$tanggal_awal'";
$query_saldo_awal = mysqli_query($koneksi, $sql_saldo_awal);
$kolom_saldo = mysqli_fetch_array($query_saldo_awal);
$saldo_awal=$kolom_saldo['total_transaksi'];
$html .= ' 
    <tr>        
        <td>#0</td>
        <td>' . date("d-M-Y", strtotime($tanggal_awal)) . '</td>
        <td>Saldo Awal</td>
        <td align="right"> Rp. ' . number_format($saldo_awal) . '</td>
        <td align="right"> Rp. ' . number_format($saldo_awal) . '</td>
    </tr>
    ';



$grandtotal=$saldo_awal;
$sql_biaya = "SELECT akun_jurnal.id_akun_jurnal,tanggal_transaksi,deskripsi,debet-kredit as total_transaksi from akun_mutasi,akun_jurnal,akun where akun_mutasi.id_akun_jurnal=akun_jurnal.id_akun_jurnal and akun_mutasi.id_akun=akun.id_akun and akun_mutasi.id_akun=$id_akun_kas and (tanggal_transaksi BETWEEN '$tanggal_awal' and '$tanggal_akhir') ORDER BY tanggal_transaksi";
$query_biaya = mysqli_query($koneksi, $sql_biaya);
while ($kolom_biaya = mysqli_fetch_array($query_biaya)) {
    $grandtotal = $grandtotal + $kolom_biaya['total_transaksi'];
    $html .= ' 
    <tr>        
        <td>#' . $kolom_biaya['id_akun_jurnal'] . '</td>
        <td>' . date("d-M-Y", strtotime($kolom_biaya['tanggal_transaksi'])) . '</td>
        <td>' . $kolom_biaya['deskripsi'] . '</td>
        <td align="right"> Rp. ' . number_format($kolom_biaya['total_transaksi']) . '</td>
        <td align="right"> Rp. ' . number_format($grandtotal) . '</td>
    </tr>
    ';
}

$html .= '
    <tr class="text-weight:bold;">
        <td align="center" colspan="4"><b>SALDO AKHIR</b></td>
        <td align="right"><b>Rp. ' . number_format($grandtotal) . '</b></td>        
    </tr>
</tbody>
</table>
';
// Akhir Mutasi Kas

// Awal Mutasi Bank BCA
$id_akun_bca=5;
$akun_bca=get_nama_akun($koneksi,$id_akun_bca);
$html.='
<br><br><b>Mutasi Bank BCA</b><br>
<table style=" border-collapse: collapse;" border="1">
    <tr>      
      <th align="center" style="width:10%;">#</th>
      <th align="center" style="width:15%;">Tanggal Transaksi</th>
      <th align="center" style="width:30%;">Keterangan Transaksi</th>
      <th align="center" style="width:20%;">Total</th>
      <th align="center" style="width:25%;">Saldo</th>
    </tr>

<tbody>';

    // Hitung Saldo Awal
$sql_saldo_awal="SELECT SUM(debet-kredit) as total_transaksi from akun_mutasi,akun_jurnal where akun_mutasi.id_akun_jurnal=akun_jurnal.id_akun_jurnal and akun_mutasi.id_akun=$id_akun_bca and tanggal_transaksi < '$tanggal_awal'";
$query_saldo_awal = mysqli_query($koneksi, $sql_saldo_awal);
$kolom_saldo = mysqli_fetch_array($query_saldo_awal);
$saldo_awal=$kolom_saldo['total_transaksi'];
$html .= ' 
    <tr>        
        <td>#0</td>
        <td>' . date("d-M-Y", strtotime($tanggal_awal)) . '</td>
        <td>Saldo Awal</td>
        <td align="right"> Rp. ' . number_format($saldo_awal) . '</td>
        <td align="right"> Rp. ' . number_format($saldo_awal) . '</td>
    </tr>
    ';



$grandtotal=$saldo_awal;
$sql_biaya = "SELECT akun_jurnal.id_akun_jurnal,tanggal_transaksi,deskripsi,debet-kredit as total_transaksi from akun_mutasi,akun_jurnal,akun where akun_mutasi.id_akun_jurnal=akun_jurnal.id_akun_jurnal and akun_mutasi.id_akun=akun.id_akun and akun_mutasi.id_akun=$id_akun_bca and (tanggal_transaksi BETWEEN '$tanggal_awal' and '$tanggal_akhir') ORDER BY tanggal_transaksi";
$query_biaya = mysqli_query($koneksi, $sql_biaya);
while ($kolom_biaya = mysqli_fetch_array($query_biaya)) {
    $grandtotal = $grandtotal + $kolom_biaya['total_transaksi'];
    $html .= ' 
    <tr>        
        <td>#' . $kolom_biaya['id_akun_jurnal'] . '</td>
        <td>' . date("d-M-Y", strtotime($kolom_biaya['tanggal_transaksi'])) . '</td>
        <td>' . $kolom_biaya['deskripsi'] . '</td>
        <td align="right"> Rp. ' . number_format($kolom_biaya['total_transaksi']) . '</td>
        <td align="right"> Rp. ' . number_format($grandtotal) . '</td>
    </tr>
    ';
}

$html .= '
    <tr class="text-weight:bold;">
        <td align="center" colspan="4"><b>SALDO AKHIR</b></td>
        <td align="right"><b>Rp. ' . number_format($grandtotal) . '</b></td>        
    </tr>
</tbody>
</table>
';
// Akhir Mutasi Bank BCA

// Awal Mutasi Piutang
$id_akun_piutang=84;
$akun_piutang=get_nama_akun($koneksi,$id_akun_piutang);
$html.='
<br><br><b>Mutasi Piutang</b><br>
<table style=" border-collapse: collapse;" border="1">
    <tr>      
      <th align="center" style="width:10%;">#</th>
      <th align="center" style="width:15%;">Tanggal Transaksi</th>
      <th align="center" style="width:30%;">Keterangan Transaksi</th>
      <th align="center" style="width:20%;">Total</th>
      <th align="center" style="width:25%;">Saldo</th>
    </tr>

<tbody>';

    // Hitung Saldo Awal
$sql_saldo_awal="SELECT SUM(debet-kredit) as total_transaksi from akun_mutasi,akun_jurnal where akun_mutasi.id_akun_jurnal=akun_jurnal.id_akun_jurnal and akun_mutasi.id_akun=$id_akun_piutang and tanggal_transaksi < '$tanggal_awal'";
$query_saldo_awal = mysqli_query($koneksi, $sql_saldo_awal);
$kolom_saldo = mysqli_fetch_array($query_saldo_awal);
$saldo_awal=$kolom_saldo['total_transaksi'];
$html .= ' 
    <tr>        
        <td>#0</td>
        <td>' . date("d-M-Y", strtotime($tanggal_awal)) . '</td>
        <td>Saldo Awal</td>
        <td align="right"> Rp. ' . number_format($saldo_awal) . '</td>
        <td align="right"> Rp. ' . number_format($saldo_awal) . '</td>
    </tr>
    ';



$grandtotal=$saldo_awal;
$sql_biaya = "SELECT akun_jurnal.id_akun_jurnal,tanggal_transaksi,deskripsi,debet-kredit as total_transaksi from akun_mutasi,akun_jurnal,akun where akun_mutasi.id_akun_jurnal=akun_jurnal.id_akun_jurnal and akun_mutasi.id_akun=akun.id_akun and akun_mutasi.id_akun=$id_akun_piutang and (tanggal_transaksi BETWEEN '$tanggal_awal' and '$tanggal_akhir') ORDER BY tanggal_transaksi";
$query_biaya = mysqli_query($koneksi, $sql_biaya);
while ($kolom_biaya = mysqli_fetch_array($query_biaya)) {
    $grandtotal = $grandtotal + $kolom_biaya['total_transaksi'];
    $html .= ' 
    <tr>        
        <td>#' . $kolom_biaya['id_akun_jurnal'] . '</td>
        <td>' . date("d-M-Y", strtotime($kolom_biaya['tanggal_transaksi'])) . '</td>
        <td>' . $kolom_biaya['deskripsi'] . '</td>
        <td align="right"> Rp. ' . number_format($kolom_biaya['total_transaksi']) . '</td>
        <td align="right"> Rp. ' . number_format($grandtotal) . '</td>
    </tr>
    ';
}

$html .= '
    <tr class="text-weight:bold;">
        <td align="center" colspan="4"><b>SALDO AKHIR</b></td>
        <td align="right"><b>Rp. ' . number_format($grandtotal) . '</b></td>        
    </tr>
</tbody>
</table>
';
// Akhir Mutasi Piutang

// Awal Mutasi Biaya
$id_akun_piutang=84;
$akun_piutang=get_nama_akun($koneksi,$id_akun_piutang);
$html.='
<br><br><b>Mutasi Biaya</b><br>
<table style=" border-collapse: collapse;" border="1">
    <tr>      
      <th align="center" style="width:10%;">#</th>
      <th align="center" style="width:15%;">Tanggal Transaksi</th>
      <th align="center" style="width:30%;">Keterangan Transaksi</th>
      <th align="center" style="width:20%;">Total</th>
      <th align="center" style="width:25%;">Saldo</th>
    </tr>

<tbody>';

    // Hitung Saldo Awal
$sql_saldo_awal="SELECT SUM(debet-kredit) as total_transaksi from akun_mutasi,akun_jurnal where akun_mutasi.id_akun_jurnal=akun_jurnal.id_akun_jurnal and akun_mutasi.id_akun=$id_akun_piutang and tanggal_transaksi < '$tanggal_awal'";
$query_saldo_awal = mysqli_query($koneksi, $sql_saldo_awal);
$kolom_saldo = mysqli_fetch_array($query_saldo_awal);
$saldo_awal=$kolom_saldo['total_transaksi'];
$html .= ' 
    <tr>        
        <td>#0</td>
        <td>' . date("d-M-Y", strtotime($tanggal_awal)) . '</td>
        <td>Saldo Awal</td>
        <td align="right"> Rp. ' . number_format($saldo_awal) . '</td>
        <td align="right"> Rp. ' . number_format($saldo_awal) . '</td>
    </tr>
    ';



$grandtotal=$saldo_awal;
$sql_biaya = "SELECT akun_jurnal.id_akun_jurnal,tanggal_transaksi,deskripsi,debet-kredit as total_transaksi from akun_mutasi,akun_jurnal,akun where akun_mutasi.id_akun_jurnal=akun_jurnal.id_akun_jurnal and akun_mutasi.id_akun=akun.id_akun and akun.akun LIKE '%Biaya%' and (tanggal_transaksi BETWEEN '$tanggal_awal' and '$tanggal_akhir') ORDER BY tanggal_transaksi";
$query_biaya = mysqli_query($koneksi, $sql_biaya);
while ($kolom_biaya = mysqli_fetch_array($query_biaya)) {
    $grandtotal = $grandtotal + $kolom_biaya['total_transaksi'];
    $html .= ' 
    <tr>        
        <td>#' . $kolom_biaya['id_akun_jurnal'] . '</td>
        <td>' . date("d-M-Y", strtotime($kolom_biaya['tanggal_transaksi'])) . '</td>
        <td>' . $kolom_biaya['deskripsi'] . '</td>
        <td align="right"> Rp. ' . number_format($kolom_biaya['total_transaksi']) . '</td>
        <td align="right"> Rp. ' . number_format($grandtotal) . '</td>
    </tr>
    ';
}

$html .= '
    <tr class="text-weight:bold;">
        <td align="center" colspan="4"><b>SALDO AKHIR</b></td>
        <td align="right"><b>Rp. ' . number_format($grandtotal) . '</b></td>        
    </tr>
</tbody>
</table>
';
// Akhir Mutasi Biaya



// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

//Close and output PDF document
$nama_file="laporan_penjualan_umum_".date('Y_m_d_H_i_s').".pdf";
$pdf->Output($nama_file, 'I');

//============================================================+
// END OF FILE
//============================================================+

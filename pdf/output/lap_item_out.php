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

// create new PDF document
$pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Agus Ariyanto');
$pdf->SetTitle('Laporan Item Keluar');
$pdf->SetSubject('Laporan Item Keluar');
$pdf->SetKeywords('Laporan Item Keluar');

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
$html = '<p style="text-align: center;"><strong>Laporan Transaksi Item Keluar</strong></p>
<table style="width:100%;">    
    <tr>
        <td style="width:10%;">Periode</td>
        <td style="width:50%;">: ' . $tanggal_awal . ' S/D ' . $tanggal_akhir . ' </td>
        <td style="width:15%;">Metode Bayar</td>
        <td style="width:25%;">: Semua Metode Bayar</td>
    </tr>
</table>
<br><br>';
$sql = "SELECT * FROM produk_kategori";
$query = mysqli_query($koneksi, $sql);

while ($kolom = mysqli_fetch_array($query)) {
    $id_produk_kategori=$kolom['id_produk_kategori'];
    $html .= '        
        Kategori :<b>' . $kolom['produk_kategori'] . '</b>
        <br>
     
        <table style=" border-collapse: collapse;" border="1">
            <tr>      
            <th align="center" style="width:5%;">#</th>
            <th align="center" style="width:20%;">Transaksi</th>
            <th align="center" style="width:35%;">Produk</th>
            <th align="center" style="width:15%;">Harga Jual</th>
            <th align="center" style="width:10%;">Jml</th>
            <th align="center" style="width:15%;">Subotal</th>
            </tr>

        <tbody>';


    $sql1 = "SELECT jual_detail.*,produk.nama,jual.tanggal_transaksi FROM jual_detail,produk,jual WHERE jual_detail.id_produk = produk.id_produk AND jual_detail.id_jual=jual.id_jual AND id_produk_kategori=$id_produk_kategori AND (tanggal_transaksi BETWEEN '$tanggal_awal' and '$tanggal_akhir')";

    // $sql1 = "select jual.*,nama from jual,anggota where jual.id_anggota=anggota.id_anggota and (tanggal_transaksi BETWEEN '$tanggal_awal' and '$tanggal_akhir')";
    $query1 = mysqli_query($koneksi, $sql1);

    $no = 0;
    $grandtotal = 0;
    while ($kolom1 = mysqli_fetch_array($query1)) {
        $no++;
        $grandtotal = $grandtotal + ($kolom1['harga_jual'] * $kolom1['jumlah']);
        $html .= '
        <tr>
            <td>' . $no . '</td>
            <td>#' . $kolom1['id_jual'] . ' ' . $kolom1['tanggal_transaksi'] . '</td>
            <td>' . $kolom1['nama'] . '</td>
            <td align="right">' . number_format($kolom1['harga_jual']) . '</td>
            <td align="right">' . number_format($kolom1['jumlah'],2) . '</td>
            <td align="right">' . number_format($kolom1['harga_jual'] * $kolom1['jumlah']) . '</td>
        </tr>
        ';
    }

    $html .= '<tr><td align="center" colspan="5">GRANDTOTAL</td>
        <td align="right">' . number_format($grandtotal) . '</td></tr>
        </tbody>
        </table>
        <br><br>';
}
$html .= '
<i>-- Dicetak Pada : ' . date('Y-m-d H:i:s') . ' --</i>
<p>&nbsp;</p>';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

//Close and output PDF document
$nama_file = "laporan_penjualan_umum_" . date('Y_m_d_H_i_s') . ".pdf";
$pdf->Output($nama_file, 'I');

//============================================================+
// END OF FILE
//============================================================+

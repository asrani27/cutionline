<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="en-us" http-equiv="Content-Language" />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Untitled 1</title>
<style type="text/css">
.auto-style1 {
	text-align: center;
}
.auto-style2 {
	font-family: Verdana, Geneva, Tahoma, sans-serif;
	font-size: xx-small;
}
.auto-style3 {
	border-color: #000000;
	border-width: 0;
}
.auto-style4 {
	border-style: solid;
	border-width: 1px;
	font-family: Arial, Helvetica, sans-serif;
	font-size: xx-small;
    padding:2px;
}
.auto-style5 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: xx-small;
	border-style: solid;
	border-width: 1px;
}
.auto-style6 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: xx-small;
	text-align: center;
	border-style: solid;
	border-width: 1px;
}
</style>
</head>

<body>

<p class="auto-style1"><span class="auto-style2"><strong>DAFTAR PEGAWAI NEGERI 
SIPIL PEMERINTAH KOTA BANJARMASIN YANG MENJALANKAN CUTI TAHUNAN</strong></span><strong><br class="auto-style2" />
</strong><span class="auto-style2"><strong>PERIODE: {{\Carbon\Carbon::parse($mulai)->format('d-m-Y')}} s/d {{\Carbon\Carbon::parse($sampai)->format('d-m-Y')}}</strong></span></p>
<table cellpadding="0" cellspacing="0" class="auto-style3" style="width: 100%">
	<tr>
		<td class="auto-style6" rowspan="2"><strong>No</strong></td>
		<td class="auto-style6" rowspan="2"><strong>Nama/Nip</strong></td>
		<td class="auto-style6" rowspan="2"><strong>Jabatan</strong></td>
		<td class="auto-style6" rowspan="2"><strong>Instansi</strong></td>
		<td class="auto-style6" colspan="2"><strong>Tanggal Cuti</strong></td>
		<td class="auto-style6" rowspan="2"><strong>Lama Cuti</strong></td>
		<td class="auto-style6" rowspan="2"><strong>Keterangan</strong></td>
	</tr>
	<tr>
		<td class="auto-style6"><strong>Dari</strong></td>
		<td class="auto-style6"><strong>Sampai</strong></td>
	</tr>
    @php
     $no=1;   
    @endphp
    @foreach ($cuti as $item)
	<tr>
		<td class="auto-style4" align="center">{{$no++}}</td>
		<td class="auto-style4">{{$item['nama']}}<br/>{{$item['nip']}}</td>
		<td class="auto-style4">{{$item['jabatan']}}</td>
		<td class="auto-style4">{{$item['instansi']}}</td>
		<td class="auto-style4">{{\Carbon\Carbon::parse($item['mulai'])->isoFormat('d MMMM Y')}}</td>
		<td class="auto-style4">{{\Carbon\Carbon::parse($item['sampai'])->isoFormat('d MMMM Y')}}</td>
		<td class="auto-style4" align="center">{{$item['lama']}} Hari Kerja</td>
		<td class="auto-style4">{{$item['keterangan']}}</td>
	</tr>
    @endforeach
</table>

</body>

</html>

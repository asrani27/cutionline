<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="en-us" http-equiv="Content-Language" />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>-24-</title>
<style type="text/css">
.auto-style1 {
	border-style: solid;
	border-width: 1px;
}
.auto-style2 {
	font-family: Cambria, Cochin, Georgia, Times, "Times New Roman", serif;
	font-size: small;
}
.auto-style3 {
	margin-left: 298px;
}
.auto-style4 {
	text-align: center;
}
.auto-style5 {
	border: 1px solid #000000;
	margin-left: 21px;
}

.auto-style11 {
	border: 0px solid #000000;
	margin-left: 21px;
}
.auto-style6 {
	text-align: left;
	border-style: solid;
	border-width: 1px;
}
.auto-style7 {
	border-style: solid;
	border-width: 1px;
	font-size: x-small;
}
.auto-style8 {
	text-align: left;
	border-style: solid;
	border-width: 1px;
	font-size: x-small;
}
.auto-style9 {
	text-align: left;
}
</style>
</head>

<body>

<div class="auto-style1">
	<div class="auto-style4">
		<span class="auto-style2">-24-</span><br class="auto-style2" />
	</div>
	<table class="auto-style3" style="width: 100%">
		<tr>
			<td><span class="auto-style2">ANAK LAMPIRAN 1.b<br />
			PERATURAN BADAN KEPEGAWAIAN NEGARA<br />
			REPUBLIK INDONESIA<br />
			NOMOR 24 TAHUN 2017<br />
			TENTANG<br />
			TATA CARA PEMBERIAN CUTI PEGAWAI NEGERI SIPIL<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Banjarmasin, {{\Carbon\Carbon::now()->isoFormat('d MMMM Y')}}<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			Kepada<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Yth. Kepala 
			Dinas Kesehatan Kota Banjarmasin<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			Di<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			Banjarmasin</span></td>
		</tr>
	</table>
	<div class="auto-style9">
		<div class="auto-style4">
		<br class="auto-style2" />
		<span class="auto-style2">FORMULIR PERMINTAAN DAN PEMBERIAN CUTI<br />
		</div>
		<table cellpadding="2" cellspacing="0" class="auto-style5" style="width: 47%">
			<tr style="font-size:12px; font-family:Arial, Helvetica, sans-serif">
				<td class="auto-style6" colspan="4">I. DATA PEGAWAI</td>
			</tr>
			<tr style="font-size:12px; font-family:Arial, Helvetica, sans-serif">
				<td class="auto-style6" style="width: 85px">Nama</td>
				<td class="auto-style1" style="width: 282px">{{$cuti->pegawai->nama}}</td>
				<td class="auto-style6" style="width: 101px">NIP</td>
				<td class="auto-style1" style="width: 180px">{{$cuti->pegawai->nip}}</td>
			</tr>
			<tr style="font-size:12px; font-family:Arial, Helvetica, sans-serif">
				<td class="auto-style6" style="width: 85px">Jabatan</td>
				<td class="auto-style1" style="width: 282px">
					@if ($cuti->pegawai->kai != null)
						Kepala {{$cuti->pegawai->kai->nama}}
					@else
						{{$cuti->jabatan == null ? '-': $cuti->jabatan->nama}}
					@endif
				</td>
				<td class="auto-style6" style="width: 101px">Masa Kerja</td>
				<td class="auto-style1" style="width: 180px">{{$cuti->pegawai->tmt == null ? '' : \Carbon\Carbon::parse($cuti->pegawai->tmt)->diff(\Carbon\Carbon::now())->format('%y Tahun, %m Bulan and %d Hari')}}</td>
			</tr>
			<tr style="font-size:12px; font-family:Arial, Helvetica, sans-serif">
				<td class="auto-style6" style="width: 85px">Unit Kerja</td>
				<td class="auto-style1" style="width: 282px">{{$cuti->pegawai->unit_kerja}}</td>
				<td class="auto-style1" style="width: 101px">&nbsp;</td>
				<td class="auto-style1" style="width: 180px">&nbsp;</td>
			</tr>
		</table>
		<br />
		<table cellpadding="2" cellspacing="0" class="auto-style5" style="width: 47%">
			<tr style="font-size:12px; font-family:Arial, Helvetica, sans-serif">
				<td class="auto-style6" colspan="4">II. JENIS CUTI YANG DIAMBIL 
				**</td>
			</tr>
			<tr style="font-size:12px; font-family:Arial, Helvetica, sans-serif">
				<td class="auto-style6" style="width: 148px">1. Cuti Tahunan</td>
				<td class="auto-style1" style="width: 182px;text-align:center;">{{$cuti->jenis_cuti_id == 1 ? 'V':'-'}}</td>
				<td class="auto-style6" style="width: 163px">2. Cuti Besar</td>
				<td class="auto-style1" style="width: 155px;text-align:center;">{{$cuti->jenis_cuti_id == 2 ? 'V':'-'}}</td>
			</tr>
			<tr style="font-size:12px; font-family:Arial, Helvetica, sans-serif">
				<td class="auto-style6" style="width: 148px">3. Cuti Sakit</td>
				<td class="auto-style1" style="width: 182px;text-align:center;">{{$cuti->jenis_cuti_id == 3 ? 'V':'-'}}</td>
				<td class="auto-style6" style="width: 163px">4. Cuti Melahirkan</td>
				<td class="auto-style1" style="width: 155px;text-align:center;">{{$cuti->jenis_cuti_id == 4 ? 'V':'-'}}</td>
			</tr>
			<tr style="font-size:12px; font-family:Arial, Helvetica, sans-serif">
				<td class="auto-style6" style="width: 148px">5. Cuti Karena 
				Alasan Penting</td>
				<td class="auto-style1" style="width: 182px;text-align:center;">{{$cuti->jenis_cuti_id == 5 ? 'V':'-'}}</td>
				<td class="auto-style6" style="width: 163px">6. Cuti Diluar 
				Tanggungan Negara</td>
				<td class="auto-style1" style="width: 155px;text-align:center;">{{$cuti->jenis_cuti_id == 6 ? 'V':'-'}}</td>
			</tr>
		</table>		

		<br />

		<table cellpadding="2" cellspacing="0" class="auto-style5" style="width: 47%">
			<tr style="font-size:12px; font-family:Arial, Helvetica, sans-serif">
		<span class="auto-style2">
				<td class="auto-style6">III. ALASAN CUTI</td>
				</span>
			</tr>
			<tr>
		<span class="auto-style2">
				<td class="auto-style6" style="width: 665px">-</td>
				</span>
		<span class="auto-style2"></span>
		<span class="auto-style2"></span>
			</tr>
		</table>		

		<br />
		<table cellpadding="2" cellspacing="0" class="auto-style5" style="width: 47%">
			<tr style="font-size:12px; font-family:Arial, Helvetica, sans-serif">
		<span class="auto-style2">
				<td class="auto-style6" colspan="4">IV. LAMANYA CUTI</td>
				</span>
			</tr>
			<tr class="auto-style2" style="font-size:12px; font-family:Arial, Helvetica, sans-serif">
				<td class="auto-style6" style="width: 148px">Selama&nbsp;</td>
				<td class="auto-style1" style="width: 182px">{{$cuti->lama}} Hari</td>
				<td class="auto-style6" style="width: 163px">mulai tanggal : {{\Carbon\Carbon::parse($cuti->mulai)->format('d/m/Y')}}</td>
				<td class="auto-style1" style="width: 155px">s/d  {{\Carbon\Carbon::parse($cuti->sampai)->format('d/m/Y')}}</td>
			</tr>
		</table>		

		<br />
		<table cellpadding="2" cellspacing="0" class="auto-style5" style="width: 47%">
			<tr style="font-size:12px; font-family:Arial, Helvetica, sans-serif">
				<td class="auto-style6" colspan="5">V. CATATAN CUTI ***</td>
			</tr>
			<tr class="auto-style2" style="font-size:12px; font-family:Arial, Helvetica, sans-serif">
				<td class="auto-style6" colspan="3">1. CUTI TAHUNAN</td>
				<td class="auto-style6" style="width: 338px">2. CUTI BESAR</td>
				<td class="auto-style1" style="width: 110px">&nbsp;</td>
			</tr>
			<tr class="auto-style2" style="font-size:12px; font-family:Arial, Helvetica, sans-serif">
				<td class="auto-style6" style="width: 56px">Tahun</td>
				<td class="auto-style1" style="width: 73px">Sisa</td>
				<td class="auto-style1" style="width: 26px">Keterangan</td>
				<td class="auto-style6" style="width: 338px">3. CUTI SAKIT</td>
				<td class="auto-style1" style="width: 110px">&nbsp;</td>
			</tr>
			<tr class="auto-style2" style="font-size:12px; font-family:Arial, Helvetica, sans-serif">
				<td class="auto-style6" style="width: 56px">N-2</td>
				<td class="auto-style1" style="width: 73px">&nbsp;</td>
				<td class="auto-style1" style="width: 26px">&nbsp;</td>
				<td class="auto-style6" style="width: 338px">4. CUTI MELAHIRKAN</td>
				<td class="auto-style1" style="width: 110px">&nbsp;</td>
			</tr>
			<tr class="auto-style2" style="font-size:12px; font-family:Arial, Helvetica, sans-serif">
				<td class="auto-style6" style="width: 56px">N-1</td>
				<td class="auto-style1" style="width: 73px">&nbsp;</td>
				<td class="auto-style1" style="width: 26px">&nbsp;</td>
				<td class="auto-style6" style="width: 338px">5. CUTI KARENA 
				ALASAN PENTING</td>
				<td class="auto-style1" style="width: 110px">&nbsp;</td>
			</tr>
			<tr class="auto-style2" style="font-size:12px; font-family:Arial, Helvetica, sans-serif">
				<td class="auto-style6" style="width: 56px">N</td>
				<td class="auto-style1" style="width: 73px">{{$sisaCuti}}</td>
				<td class="auto-style1" style="width: 26px">&nbsp;</td>
				<td class="auto-style6" style="width: 338px">6. CUTI DI LUAR 
				TANGGUNGAN NEGARA</td>
				<td class="auto-style1" style="width: 110px">&nbsp;</td>
			</tr>
		</table>	
		
		<br />
		<table cellpadding="2" cellspacing="0" class="auto-style5" style="width: 47%">
			<tr style="font-size:12px; font-family:Arial, Helvetica, sans-serif">
				<td class="auto-style6" colspan="3">VI. ALAMAT SELAMA 
				MENJALANKAN CUTI</td>
			</tr>
			<tr class="auto-style2" style="font-size:12px; font-family:Arial, Helvetica, sans-serif">
				<td class="auto-style6" rowspan="2" style="width: 335px">&nbsp;</td>
				<td class="auto-style6" style="width: 163px">TEL</td>
				<td class="auto-style1" style="width: 155px">&nbsp;</td>
			</tr>
			<tr class="auto-style2" style="font-size:12px; font-family:Arial, Helvetica, sans-serif">
				<td class="auto-style6" style="height: 46px;" colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
				Hormat Saya,<br />
				<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
				({{$cuti->pegawai->nama}})<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
				NIP. {{$cuti->pegawai->nip}}</td>
			</tr>
		</table>	
		<br />
		<table cellpadding="2" cellspacing="0" class="auto-style5" style="width: 47%">
			<tr style="font-size:12px; font-family:Arial, Helvetica, sans-serif">
				<td class="auto-style6" colspan="4">VII. PERTIMBANGAN ATASAN 
				LANGSUNG **</td>
			</tr>
			<tr class="auto-style2" style="font-size:12px; font-family:Arial, Helvetica, sans-serif">
				<td class="auto-style8" style="width: 148px">DISETUJUI&nbsp;</td>
				<td class="auto-style7" style="width: 182px">PERUBAHAN****</td>
				<td class="auto-style8" style="width: 163px">DITANGGUHKAN****</td>
				<td class="auto-style7" style="width: 155px">TIDAK DISETUJUI****</td>
			</tr>
			<tr class="auto-style2" style="font-size:12px; font-family:Arial, Helvetica, sans-serif">
				<td class="auto-style8" style="width: 148px; text-align:center">{{$cuti->status == 1 ? 'V':''}}</td>
				<td class="auto-style7" style="width: 182px">&nbsp;</td>
				<td class="auto-style8" style="width: 163px">&nbsp;</td>
				<td class="auto-style7" style="width: 155px">{{$cuti->status == 2 ? 'V':''}}</td>
			</tr>
		</table>		

		<br />	
		
		<table cellpadding="2" cellspacing="0" class="auto-style5" style="width: 47%">
			<tr class="auto-style2" style="font-size:12px; font-family:Arial, Helvetica, sans-serif">
				<td class="auto-style8" style="width: 138px">Ka. Ruangan&nbsp;</td>
				<td class="auto-style7" style="width: 172px">Ka. Instalasi</td>
				<td class="auto-style8" style="width: 153px">Kasie</td>
				<td class="auto-style7" style="width: 185px"></td>
			</tr>
			<tr class="auto-style2" style="font-size:12px; font-family:Arial, Helvetica, sans-serif">
				<td class="auto-style8" style="width: 100px;"></td>
				<td class="auto-style7" style="width: 150px"></td>
				<td class="auto-style8" style="width: 150px"></td>
				<td class="auto-style7" style="width: 208px" align="center">
				{{$direktur->nama}}<br/>
				v<br/>
				{{$direktur->pegawai->first()->nama}}<br/>NIP.{{$direktur->pegawai->first()->nip}}</td>
			</tr>
		</table>	
		<br/>
		<table cellpadding="2" cellspacing="0" class="auto-style5" style="width: 47%">
			<tr>
				<td class="auto-style6" colspan="4" style="font-size:12px; font-family:Arial, Helvetica, sans-serif">VIII. KEPUTUSAN PEJABATAN 
				YANG BERWENANG MEMBERIKAN CUTI **</td>
			</tr>
			<tr class="auto-style2" style="font-size:12px; font-family:Arial, Helvetica, sans-serif">
				<td class="auto-style8" style="width: 148px">DISETUJUI&nbsp;</td>
				<td class="auto-style7" style="width: 182px">PERUBAHAN****</td>
				<td class="auto-style8" style="width: 163px">DITANGGUHKAN****</td>
				<td class="auto-style7" style="width: 155px">TIDAK DISETUJUI****</td>
			</tr>
			<tr class="auto-style2">
				<td class="auto-style8" style="width: 148px">&nbsp;</td>
				<td class="auto-style7" style="width: 182px">&nbsp;</td>
				<td class="auto-style8" style="width: 163px">&nbsp;</td>
				<td class="auto-style7" style="width: 155px">&nbsp;</td>
			</tr>
		</table>		

		<table cellpadding="2" border=0 cellspacing="0" style="width: 47%">
			<tr class="auto-style2" style="font-size:12px; font-family:Arial, Helvetica, sans-serif">
				<td style="width: 148px"></td>
				<td style="width: 182px"></td>
				<td style="width: 163px"></td>
				<td style="width: 155px"></td>
			</tr>
			<tr class="auto-style2" style="font-size:12px; font-family:Arial, Helvetica, sans-serif">
				<td style="width: 108px">&nbsp;</td>
				<td style="width: 182px">&nbsp;</td>
				<td style="width: 163px">&nbsp;</td>
				<td style="width: 195px" align="center">Kepala Dinas Kesehatan
				<br/><br/><br/>
				<img src="data:image/png;base64, {!! $qrcode !!}" width="80" height="80">
				<br/>
				{{$kadinkes->nama}}<br/>
				NIP.{{$kadinkes->nip}}
				</td>
			</tr>
		</table>	
		
	</div>
</div>

</body>

</html>

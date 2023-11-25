<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Inovation Report</title>
	<style type="text/css">
		table.border,
		table.border tr,
		table.border td,
		table.border th {
			border: 1px solid black;
			border-collapse: collapse !important;
			padding: 5px 4px;
		}

		table.no-border,
		table.no-border tr,
		table.no-border td,
		table.no-border th {
			padding: 5px 4px;
		}
		.w-100 {
			width: 100% !important
		}
		.text-center {
            text-align: center !important;
        }

		.text-uppercase {
            text-transform: uppercase !important;
            font-weight: 600;
        }
		
	</style>
</head>
<body>
	<p style="line-height: 1; text-align: center;"><img src="{{ realpath('img/logo.png') }}" style="margin-left: auto; margin-right: auto; display: block; width: 81px; height: 100.703px;"></p>
	<p style="text-align: center; line-height: 1;"><strong><span style="font-family: Tahoma,Geneva, sans-serif;">KABUPATEN TANAH BUMBU</span></strong></p>
	<p style="text-align: center; line-height: 1;"><strong><span style="font-family: Tahoma,Geneva, sans-serif;">LAPORAN INOVASI DAERAH</span></strong></p>
	<div class="column">
		<div class="page" title="Page 1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
			<div class="column">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<p><span style="font-size: 13pt; font-weight: 700;">1. PROFIL INOVASI</span></p>
				<p><span style="font-size: 12pt; font-weight: 700;">1.1. Nama Inovasi</span></p>
				<p><span style="font-size: 12pt;">{{ $proposal->nama }}</span></p>
				<p><span style="font-size: 12pt; font-weight: 700;">1.2. Dibuat Oleh</span></p>
				<p><span style="font-size: 12pt;">{{$proposal->skpd->nama}}</span></p>
				<p><span style="font-size: 12pt; font-weight: 700;">1.3. Tahapan Inovasi</span></p>
				<p><span style="font-size: 12pt;">{{$proposal->tahapan->nama}}</span></p>
				<p><span style="font-size: 12pt; font-weight: 700;">1.4. Inisiator Inovasi Daerah</span></p>
				<p><span style="font-size: 12pt;">{{$proposal->inisiator->nama}}</span></p>
				<p><span style="font-size: 12pt; font-weight: 700;">1.5. Jenis Inovasi</span></p>
				<p><span style="font-size: 12pt;">{{$proposal->category->name}}</span></p>
				<p><span style="font-size: 12pt; font-weight: 700;">1.6. Bentuk Inovasi Daerah</span></p>
				<p><span style="font-size: 12pt;">{{$proposal->bentuk->nama}}</span></p>
				<p><span style="font-size: 12pt; font-weight: 700;">1.7. Urusan Inovasi Daerah</span></p>
				<p><span style="font-size: 12pt;">{{ $proposal->urusans->pluck('nama')->implode(', ') }}</span></p>
				<p><span style="font-size: 12pt; font-weight: 700;">1.8. Rancang Bangun dan Pokok Perubahan Yang Dilakukan</span></p>
				<p><span style="font-size: 12pt;">{!!$proposal->rancang_bangun!!}&nbsp;</span></p>
				<p><span style="font-size: 12pt; font-weight: 700;">1.9. Tujuan Inovasi Daerah</span></p>
				<p><span style="font-size: 12pt;">{{$proposal->tujuan}}</span></p>
				<p><span style="font-size: 12pt; font-weight: 700;">1.12. Manfaat Yang Diperoleh</span></p>
				<p><span style="font-size: 12pt;">{!!$proposal->manfaat!!}</span></p>
				<p><span style="font-size: 12pt; font-weight: 700;">1.11. Hasil Inovasi</span>
				<p><span style="font-size: 12pt;">{!!$proposal->hasil!!}</span></p></p>
				<p></p>
				<p><span style="font-size: 12pt; font-weight: 700;">1.12. Waktu Uji Coba Inovasi Daerah</span></p>
				<p><span style="font-size: 12pt;">{{$proposal->ujicoba}}</span></p>
				<p><span style="font-size: 12pt; font-weight: 700;">1.13. Waktu Implementasi</span></p>
				<p><span style="font-size: 12pt;">{{$proposal->implementasi}}</span></p>
				<p><span style="font-size: 12pt; font-weight: 700;">1.14. Anggaran</span></p>
				<p><span style="font-size: 12pt;"><a href="{{URL::to('anggaran/'. $proposal->anggaran )}}" target="_blank">{{$proposal->anggaran}}</a></span></p>
				<p><span style="font-size: 12pt; font-weight: 700;">1.15. Profil</span></p>
				<p><span style="font-size: 12pt;"><a href="{{URL::to('/profil/'. $proposal->profil )}}" target="_blank">{{$proposal->profil}}</a></span></p>
				</div>
			</div>
	</div>
	<div title="Page 2">
		<div style="color: rgb(100%, 100%, 100%);background-color: rgb(100%, 100%, 100%);">
		</div>
	</div>
	<p><span style="font-size: 13pt; font-weight: 700;">2. INDIKATOR INOVASI</span></p>
	<table class="border w-100">
		<tr>
			<th class="text-center text-uppercase" style="width: 2%">No</th>
			<th class="text-center text-uppercase" style="width: 11%">Indikator</th>
			<th class="text-center text-uppercase" style="width: 20%">Informasi</th>
			<th class="text-center text-uppercase" style="width: 40%">Bukti</th>
		</tr>
	<tbody>
		@foreach ($proposal->indikators()->get() as $item)
		<tr>
			<td class="text-center align-middle"> {{$loop->iteration}} </td>
			<td class="text-center align-middle"> {{$item->nama}} </td>
			<td class="text-center align-middle"> @foreach ($item->files()->where('proposal_id', $proposal->id)->get() as $file){{$file->bukti->nama}} @endforeach</td>
			<td class="text-center align-middle">@foreach ($item->files()->where('proposal_id', $proposal->id)->get() as $file){{$file->informasi}} @endforeach</td>
		</tr>
		@endforeach
	</tbody>
	</table></body></html>
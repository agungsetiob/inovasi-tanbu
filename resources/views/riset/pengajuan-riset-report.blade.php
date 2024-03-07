<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Proposal Riset</title>
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
	<p style="text-align: center; line-height: 1;"><strong><span style="font-family: Tahoma,Geneva, sans-serif;">PROPOSAL PENGAJAUAN RISET</span></strong></p>
	<div class="column">
		<div class="page" title="Page 1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
			<div class="column">
				<p><span style="font-size: 12pt; font-weight: 700;">1. Judul Riset</span></p>
				<p><span style="font-size: 12pt;">{!! $riset->judul !!}</span></p>
				<p><span style="font-size: 12pt; font-weight: 700;">2. Latar Belakang</span></p>
				<p><span style="font-size: 12pt;">{!!$riset->latar!!}</span></p>
				<p><span style="font-size: 12pt; font-weight: 700;">3. Dasar Hukum</span></p>
				<p><span style="font-size: 12pt;">{!!$riset->hukum!!}</span></p>
				<p><span style="font-size: 12pt; font-weight: 700;">4. Maksud dan Tujuan</span></p>
				<p><span style="font-size: 12pt;">{!!$riset->maksud!!}</span></p>
				<p><span style="font-size: 12pt; font-weight: 700;">5. Ruang Lingkup</span></p>
				<p><span style="font-size: 12pt;">{!!$riset->ruang_lingkup!!}</span></p>
				<p><span style="font-size: 12pt; font-weight: 700;">6. Target dan Sasaran</span></p>
				<p><span style="font-size: 12pt;">{!!$riset->target!!}</span></p>
				<p><span style="font-size: 12pt; font-weight: 700;">7. Output</span></p>
				<p><span style="font-size: 12pt;">{!! $riset->output !!}</span></p>
				<p><span style="font-size: 12pt; font-weight: 700;">8. Manfaat</span></p>
				<p><span style="font-size: 12pt;">{!!$riset->manfaat!!}&nbsp;</span></p>
				<p><span style="font-size: 12pt; font-weight: 700;">9. Nama Organisasi</span></p>
				<p><span style="font-size: 12pt;">{!!$riset->skpd->nama!!}</span></p>
				<p><span style="font-size: 12pt; font-weight: 700;">10. Sumber Pendanaan</span></p>
				<p><span style="font-size: 12pt;">{!!$riset->manfaat!!}</span></p>
				<p><span style="font-size: 12pt; font-weight: 700;">11. Rencana Anggaran Biaya</span>
				<p><span style="font-size: 12pt;"><a href="{{URL::to('storage/'. $riset->rab )}}" target="_blank">Download rab</a></span></p>
				<p><span style="font-size: 12pt; font-weight: 700;">12. Spesifikasi Peneliti</span></p>
				<p><span style="font-size: 12pt;">{!!$riset->peneliti!!}</span></p>
				<p><span style="font-size: 12pt; font-weight: 700;">13. Tahapan Kegiatan</span></p>
				<p><span style="font-size: 12pt;">{!!$riset->tahapan!!}</span></p>
                <p><span style="font-size: 16pt; font-weight: 700;">14. METODOLOGI</span></p>
				<p><span style="font-size: 12pt; font-weight: 700;">A. Jenis dan Sumber Data </span></p>
				<p><span style="font-size: 12pt;">{!!$riset->jenis_sumber_data!!}</span></p>
				<p><span style="font-size: 12pt; font-weight: 700;">B. Teknik Pengumpulan Data</span></p>
				<p><span style="font-size: 12pt;">{!!$riset->teknik!!}</span></p>
                <p><span style="font-size: 12pt; font-weight: 700;">C. Teknik Analisa Data</span></p>
                <p><span style="font-size: 12pt;">{!!$riset->analisa!!}</span></p>
                <p><span style="font-size: 12pt; font-weight: 700;">15. Jangka Waktu Pelaksanaan</span></p>
                <p><span style="font-size: 12pt;">{!!$riset->jangka!!}</span></p>
			</div>
	    </div>
        {{--<div title="Page 2">
            <div style="color: rgb(100%, 100%, 100%);background-color: rgb(100%, 100%, 100%);">
            </div>
        </div>
        <p><span style="font-size: 13pt; font-weight: 700;">2. INDIKATOR INOVASI</span></p>
        <table class="border w-100">
            <thead>
                <tr>
                    <th class="text-center text-uppercase" style="width: 2%">No</th>
                    <th class="text-center text-uppercase" style="width: 11%">Indikator</th>
                    <th class="text-center text-uppercase" style="width: 20%">Informasi</th>
                    <th class="text-center text-uppercase" style="width: 40%">Bukti</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($riset->indikators()->get() as $item)
                <tr>
                    <td class="text-center align-middle"> {{$loop->iteration}} </td>
                    <td class="text-center align-middle"> {{$item->nama}} </td>
                    <td class="text-center align-middle"> @foreach ($item->files()->where('riset_id', $riset->id)->get() as $file){{$file->bukti->nama}} @endforeach</td>
                    <td class="text-center align-middle">@foreach ($item->files()->where('riset_id', $riset->id)->get() as $file){{$file->informasi}} @endforeach</td>
                </tr>
                @endforeach
            </tbody>
        </table>--}}
    </div>
</body></html>
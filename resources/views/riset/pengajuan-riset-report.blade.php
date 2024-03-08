<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proposal Riset</title>
    <style type="text/css">
        table, tr, td, th {
            border: 1px solid black;
            border-collapse: collapse !important;
            padding: 5px 4px;
        }

        table.no-border, table.no-border tr, table.no-border td, table.no-border th {
            padding: 5px 4px;
        }

        .w-100 {
            width: 100% !important;
        }

        .text-center {
            text-align: center !important;
        }

        .text-uppercase {
            text-transform: uppercase !important;
            font-weight: 600;
        }

        .section-title {
            font-size: 12pt;
            font-weight: 700;
            margin-bottom: 5px; /* Adjusted margin */
        }
		.jus {
			text-align:justify;
		}
    </style>
</head>
<body>
    <p style="line-height: 1; text-align: center;">
        <img src="{{ realpath('img/logo.png') }}" style="margin-left: auto; margin-right: auto; display: block; width: 81px; height: 100.703px;">
    </p>
    <p style="text-align: center; line-height: 1;">
        <strong><span style="font-family: Tahoma, Geneva, sans-serif;">KABUPATEN TANAH BUMBU</span></strong>
    </p>
    <p style="text-align: center; line-height: 1;">
        <strong><span style="font-family: Tahoma, Geneva, sans-serif;">PROPOSAL PENGAJUAN RISET</span></strong>
    </p>

    <div>
        <p class="section-title">1. Judul Riset</p>
        <p class="jus"><span style="font-size: 12pt;">{!! $riset->judul !!}</span></p>

        <p class="section-title">2. Latar Belakang</p>
        <p class="jus"><span style="font-size: 12pt;">{!!$riset->latar!!}</span></p>

        <p class="section-title">3. Dasar Hukum</p>
        <p><span style="font-size: 12pt;">{!!$riset->hukum!!}</span></p>

        <p class="section-title">4. Maksud dan Tujuan</p>
        <p><span style="font-size: 12pt;">{!!$riset->maksud!!}</span></p>

        <p class="section-title">5. Ruang Lingkup</p>
        <p><span style="font-size: 12pt;">{!!$riset->ruang_lingkup!!}</span></p>

        <p class="section-title">6. Target dan Sasaran</p>
        <p><span style="font-size: 12pt;">{!!$riset->target!!}</span></p>

        <p class="section-title">7. Output</p>
        <p><span style="font-size: 12pt;">{!! $riset->output !!}</span></p>

        <p class="section-title">8. Manfaat</p>
        <p><span style="font-size: 12pt;">{!!$riset->manfaat!!}&nbsp;</span></p>

        <p class="section-title">9. Nama Organisasi</p>
        <p><span style="font-size: 12pt;">{!!$riset->skpd->nama!!}</span></p>

        <p class="section-title">10. Sumber Pendanaan</p>
        <p><span style="font-size: 12pt;">{!!$riset->manfaat!!}</span></p>

        <p class="section-title">11. Rencana Anggaran Biaya</p>
        <p><span style="font-size: 12pt;"><a href="{{URL::to('storage/'. $riset->rab )}}" target="_blank">Download rab</a></span></p>

        <p class="section-title">12. Spesifikasi Peneliti</p>
        <p><span style="font-size: 12pt;">{!!$riset->peneliti!!}</span></p>

        <p class="section-title">13. Tahapan Kegiatan</p>
        <p><span style="font-size: 12pt;">{!!$riset->tahapan!!}</span></p>

        <p class="section-title">14. METODOLOGI</p>

        <p class="section-title">A. Jenis dan Sumber Data</p>
        <p><span style="font-size: 12pt;">{!!$riset->jenis_sumber_data!!}</span></p>

        <p class="section-title">B. Teknik Pengumpulan Data</p>
        <p><span style="font-size: 12pt;">{!!$riset->teknik!!}</span></p>

        <p class="section-title">C. Teknik Analisa Data</p>
        <p><span style="font-size: 12pt;">{!!$riset->analisa!!}</span></p>

        <p class="section-title">15. Jangka Waktu Pelaksanaan</p>
        <p><span style="font-size: 12pt;">{!!$riset->jangka!!}</span></p>
    </div>
</body>
</html>

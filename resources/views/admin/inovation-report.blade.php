<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report</title>
    <style>
        body {
            font-family: Tahoma, "Trebuchet MS", sans-serif;
            /* background: rgb(103, 100, 100); */
        }

        .text-center {
            text-align: center !important;
        }

        .align-middle {
            vertical-align: middle !important;
        }

        .text-start {
            text-align: left !important
        }

        .fs-20 {
            font-size: 20px;
        }

        .fs-18 {
            font-size: 18px;
        }

        .fs-16 {
            font-size: 16px;
        }

        .fs-14 {
            font-size: 14px;
        }

        .fs-12 {
            font-size: 12px;
        }

        .fs-10 {
            font-size: 10px;
        }

        .bold {
            font-weight: bold;
        }

        .text-end {
            text-align: right !important
        }

        .d-flex {
            display: flex !important
        }

        .justify-content-start {
            justify-content: flex-start !important
        }

        .justify-content-end {
            justify-content: flex-end !important
        }

        .justify-content-center {
            justify-content: center !important
        }

        .justify-content-between {
            justify-content: space-between !important
        }

        .justify-content-around {
            justify-content: space-around !important
        }

        .justify-content-evenly {
            justify-content: space-evenly !important
        }

        .w-100 {
            width: 100% !important
        }

        .text-uppercase {
            text-transform: uppercase !important;
        }

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
    </style>
    <style>
        /**
                Set the margins of the page to 0, so the footer and the header
                can be of the full height and width !
             **/
        @page {
            /* margin: 0cm 0cm; */
            margin-top: 1cm;
            margin-left: 2cm;
            margin-right: 2cm;
            margin-bottom: 0cm;
        }

        /** Define the header rules **/
        header {
            position: fixed;
            top: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;

        }

        main {
            position: fixed;
            top: 3.7cm;
            left: 0cm;
            right: 0cm;

        }

        /** Define the footer rules **/
        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
        }
    </style>
</head>

<body>
    <div style="page-break-after: always; page-break-inside: avoid;">
        <table class="w-100">
            <thead>
                <tr>
                    <td class="text-center">
                        <img src="{{ url('img/logo.png') }}" alt="Kop Header" width="70px">
                    </td>
                    <td class="text-center" style="padding-top: 0px; padding-bottom: 0px">
                        <span class="fs-16">PEMERINTAH KABUPATEN TANAH BUMBU <br></span>
                        <span class="fs-20">Badan Perencanaan Daerah Penelitian dan Pengembangan <br></span>
                        <span style="font-size: 9px">Jl. H. M. Amin KM.10 RT 03 Desa Sepunggur Kec. Kusan Tengah Kab. Tanah Bumbu <br> 
                        Prov. Kalimantan Selatan KP. 72273 Email: bappedalitbang@tanahbumbukab.go.id
                        Telepon 0811 5040 540 / (0518) 6070 767
                        <br></span>
                    </td>
                </tr>
            </thead>
        </table>
        <hr>
        <div class="text-center fs-20">Laporan Inovasi</div>
        <table class="border w-100">
                <tr>
                    <td class="text-center text-uppercase" style="width: 2%">No</td>
                    <td class="text-center text-uppercase" style="width: 30%">SKPD/UPTD</td>
                    <td class="text-center text-uppercase" style="width: 63%">INOVASI</td>
                    <td class="text-center text-uppercase" style="width: 5%">TAHUN</td>
                </tr>
            <tbody>
              @foreach ($inovations as $item)
              <tr>
                  <td class="text-center align-middle">{{ $loop->iteration }}</td>
                  <td class="text-center align-middle">{{ $item->skpd->nama }}</td>
                  <td class="text-center align-middle">{{ $item->nama }}</td>
                  <td class="text-center align-middle">{{ $item->created_at->format('Y')}}</td>
              </tr>
              @endforeach
            </tbody>
        </table>
    </div></body></html>
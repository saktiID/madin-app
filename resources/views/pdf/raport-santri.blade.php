<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Raport Santri - {{ $santri->nama_santri }} | MadinApp</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('storage/logo/' . $logo_madin) }}" />
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />

    <style>
        @font-face {
            font-family: AlHadari;
            src: url("{{ asset('assets/fonts/Alhadari.ttf') }}");
        }

        @font-face {
            font-family: Jameel;
            src: url("{{ asset('assets/fonts/Jameel.ttf') }}");
        }

        .alhadari {
            font-family: Alhadari;
            font-size: 18pt;
            font-weight: 500;
        }

        .arabic {
            font-family: Jameel;
            font-size: 15pt;
        }

        .press {
            margin: 0;
            padding: 0;
        }

        .box-brand-title>h4,
        .box-brand-title>h2 {
            margin: 0;
            padding: 0;
        }

        .box-stripped {
            margin-bottom: 1px;
            width: 100%;
            height: 1px;
            background-color: #393939;
            -webkit-print-color-adjust: exact;
        }

        .text-content {
            margin: 0
        }

        thead {
            background-color: #e4e4e4;
        }

        tfoot {
            background-color: #e4e4e4;
            font-weight: 500;
        }


        @media print {
            .box-stripped {
                margin-bottom: 1px;
                width: 100%;
                height: 1px;
                background-color: #393939;
                -webkit-print-color-adjust: exact;
            }

            thead {
                background-color: #e4e4e4;
                -webkit-print-color-adjust: exact;
            }

            tfoot {
                background-color: #e4e4e4;
                font-weight: 500;
                -webkit-print-color-adjust: exact;
            }
        }

    </style>

</head>

<body>
    <div class="container mt-3">

        <div class="wrapper-brand">
            <table width="100%" class="mb-2">
                <tr>
                    <td width="15%">
                        <img src="{{ asset('storage/logo/' . $logo_madin) }}" width="113" alt="logo">
                    </td>
                    <td width="70%" class="text-center">
                        <h4 class="press alhadari">تقرير عن نتائج تقييم الطلاب</h4>
                        <h4 class="press">IMTIHAN AKHIR SEMESTER</h4>
                        <h2 style="text-transform: uppercase">{{ $nama_madin }}</h2>
                        <h6 class="press">{{ $alamat_madin }}</h6>
                    </td>
                    <td width="15%"></td>
                </tr>
            </table>
        </div>

        <div class="box-stripped hr"></div>
        <div class="box-stripped hr"></div>

        <div class="wrapper-identity">
            <div class="box-content">
                <table class="text-start">
                    <tr>
                        <td width="120px">Nama</td>
                        <td width="530px">: <strong style="text-transform: uppercase">{{ $santri->nama_santri }}</strong></td>
                        <td width="120px">Kelas</td>
                        <td>: <strong style="text-transform: uppercase"> {{ $santri->nama_kelas . ' '. $santri->bagian_kelas}}</strong></td>
                    </tr>
                    <tr>
                        <td width="120px">NIS</td>
                        <td>: <strong>{{ $santri->nis }}</strong></td>
                        <td width="120px">Semester</td>
                        <td>: <strong>{{ $santri->semester }}</strong></td>

                    </tr>
                    <tr>
                        <td width="120px">No. Raport</td>
                        <td>: <strong>{{ $no_raport }}</strong></td>
                        <td width="120px">Tahun Ajaran</td>
                        <td>: <strong>{{ $santri->tahun_ajaran }}</strong></td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="box-stripped hr"></div>
        <div class="box-stripped hr"></div>

        <div class="wrapper-content">
            <div class="box-text-content my-3 text-center" width="100%">
                <p class="text-content alhadari">تحقيق الدرجات للإمتحانات النهاية الدراسية </p>
                <p class="text-content font-weight-bold">CAPAIAN NILAI IMTIHAN AKHIR SEMESTER</p>
            </div>

            <table id="raport" width="100%" border="1">

                <thead class="text-center">
                    <tr>
                        <th rowspan="2">
                            <p class="press arabic">النمرة</p>
                            <p class="press">No</p>
                        </th>
                        <th rowspan="2">
                            <p class="press arabic">المادة الدراسية</p>
                            <p class="press">Mata Pelajaran</p>
                        </th>
                        <th colspan="2">
                            <p class="press arabic">الدرجة</p>
                            <p class="press">Nilai</p>
                        </th>
                    </tr>
                    <tr>
                        <th width="20%">
                            <p class="press arabic">مشافهة</p>
                            <p class="press">Musyafahat</p>
                        </th>
                        <th width="20%">
                            <p class="press arabic">كتابة</p>
                            <p class="press">Kitabah</p>
                        </th>
                    </tr>
                </thead>

                <tbody>

                    @php
                    $no = 1;
                    $i = 0;
                    @endphp
                    @foreach ($pelajaran as $pljrn)

                    <tr>
                        <td class="text-center">{{ $no }}</td>
                        <td class="p-2">
                            <p class="press">{{ $pljrn->nama_pelajaran }}</p>
                            <small class="press text-secondary">{{ $pljrn->deskripsi }}</small>
                        </td>
                        <td class="text-center">{{ $nilai_raport[$i]['musyafahat'] }}</td>
                        <td class="text-center">{{ $nilai_raport[$i]['kitabah'] }}</td>
                    </tr>

                    @php
                    $no++;
                    $i++;
                    @endphp
                    @endforeach

                </tbody>

                <tfoot>
                    <tr>
                        <td colspan="2" class="text-right pr-2">
                            <p class="press arabic">مجموع الدرجات</p>
                            <p class="press">Total</p>
                        </td>
                        <td class="text-center">{{ $total_musyafahat }}</td>
                        <td class="text-center">{{ $total_kitabah }}</td>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-right pr-2">
                            <p class="press arabic">نتيجة المعادلة</p>
                            <p class="press">Rata-rata</p>
                        </td>
                        <td class="text-center">{{ $rata_musyafahat }}</td>
                        <td class="text-center">{{ $rata_kitabah }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="wrapper-bottom">
            <table width="100%" class="mt-3 mb-5">
                <tr>
                    <td width="70%">Mengetahui,</td>
                    <td>{{ $kota_madin }}, {{ $tanggal_raport }}</td>
                </tr>
                <tr>
                    <td>Kepala Madrasah Diniyah</td>
                    <td>Mustahiq Kelas</td>
                </tr>
                <tr>
                    <td height="65px"></td>
                    <td height="65px"></td>
                </tr>
                <tr>
                    <td>
                        <strong>
                            {{ $nama_kepala_madin }}
                        </strong>
                    </td>
                    <td>
                        <strong>
                            {{ $santri->nama_mustahiq }}
                        </strong>
                    </td>
                </tr>
            </table>
        </div>

    </div>


    <script>
        // window.print()

    </script>

</body>
</html>

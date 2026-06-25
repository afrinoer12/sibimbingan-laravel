<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Bimbingan Skripsi</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            color: #111827;
        }

        h2, h4 {
            text-align: center;
            margin: 0;
        }

        .subtitle {
            text-align: center;
            margin-top: 5px;
            margin-bottom: 20px;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th {
            background: #e5e7eb;
            font-weight: bold;
        }

        table th,
        table td {
            border: 1px solid #374151;
            padding: 6px;
            vertical-align: top;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>

    <h2>LAPORAN BIMBINGAN SKRIPSI</h2>
    <h4>Sistem Bimbingan Skripsi Online</h4>
    <div class="subtitle">
        Dicetak pada: {{ now()->format('d-m-Y H:i') }}
    </div>

    <table>
        <thead>
            <tr>
                <th width="4%">No</th>
                <th width="14%">Mahasiswa</th>
                <th width="14%">Dosen</th>
                <th width="22%">Judul</th>
                <th width="10%">Tanggal</th>
                <th width="14%">Topik</th>
                <th width="8%">Status</th>
                <th width="14%">Catatan</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($bimbingan as $item)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $item->mahasiswa->nama ?? '-' }}</td>
                    <td>{{ $item->dosen->nama ?? '-' }}</td>
                    <td>{{ $item->pengajuanJudul->judul ?? '-' }}</td>
                    <td>{{ $item->tanggal_bimbingan }}</td>
                    <td>{{ $item->topik_bimbingan }}</td>
                    <td>{{ ucfirst($item->status) }}</td>
                    <td>{{ $item->catatan_dosen ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">
                        Belum ada data bimbingan.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>
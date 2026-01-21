<!DOCTYPE html>
<html>

<head>
    <title>Published Documents</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
        }

        h1 {
            text-align: center;
            font-size: 16px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>

<body>
    <h1>LAPORAN DOKUMEN TERPUBLIKASI</h1>

    <table>
        <thead>
            <tr>
                <th width="4%">No</th>
                <th width="15%">Unit Penginput</th>
                <th width="20%">Judul Form</th>
                <th width="10%">Kategori</th>
                <th width="15%">Disetujui Oleh</th>
                <th width="12%">Tanggal Publish</th>
                <th width="12%">Penulis</th>
                <th width="12%">Risiko</th>
            </tr>
        </thead>
        <tbody>
            @foreach($documents as $doc)
                @php
                    $lastApproval = $doc->approvals()->where('action', 'approved')->latest()->first();
                    $approver = $lastApproval ? ($lastApproval->approver->nama_user ?? '-') : '-';
                @endphp
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $doc->unit->nama_unit ?? '-' }}</td>
                    <td>{{ $doc->judul_dokumen ?? '-' }}</td>
                    <td>{{ $doc->kategori }}</td>
                    <td>{{ $approver }}</td>
                    <td>
                        {{ $doc->published_at ? $doc->published_at->format('d M Y') : '-' }}<br>
                        <small>{{ $doc->published_at ? $doc->published_at->format('H:i') : '' }} WIB</small>
                    </td>
                    <td>{{ $doc->user->nama_user ?? '-' }}</td>
                    <td>{{ $doc->risk_level ?? 'High' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
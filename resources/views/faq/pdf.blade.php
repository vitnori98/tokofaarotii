<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data FAQ</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'DejaVu Sans', 'Arial', sans-serif;
            font-size: 11px;
            color: #1e293b;
            padding: 24px;
            background: #fff;
        }

        /* Header */
        .doc-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 2px solid #f97316;
            padding-bottom: 12px;
            margin-bottom: 20px;
        }
        .doc-title { font-size: 16px; font-weight: 700; color: #1e293b; }
        .doc-meta  { font-size: 10px; color: #64748b; text-align: right; line-height: 1.6; }
        .doc-badge {
            display: inline-block;
            background: #f97316;
            color: #fff;
            font-size: 9px;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 99px;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            margin-bottom: 4px;
        }

        /* Table */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 4px;
        }
        thead tr {
            background: #f97316;
            color: #fff;
        }
        thead th {
            padding: 8px 10px;
            text-align: left;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 0.06em;
            text-transform: uppercase;
        }
        tbody tr { border-bottom: 1px solid #f1f5f9; }
        tbody tr:nth-child(even) { background: #fff7ed; }
        tbody td {
            padding: 8px 10px;
            vertical-align: top;
            line-height: 1.5;
        }
        .td-no {
            width: 36px;
            text-align: center;
            font-weight: 700;
            color: #f97316;
        }
        .td-question { width: 35%; font-weight: 600; }
        .td-answer   { color: #475569; }

        /* Footer */
        .doc-footer {
            margin-top: 20px;
            padding-top: 10px;
            border-top: 1px solid #f1f5f9;
            font-size: 9px;
            color: #94a3b8;
            display: flex;
            justify-content: space-between;
        }

        /* Print button (hanya muncul di browser, bukan PDF) */
        .print-btn {
            display: block;
            margin: 0 auto 20px;
            padding: 8px 24px;
            background: #f97316;
            color: #fff;
            border: none;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
        }
        @media print {
            .print-btn { display: none; }
        }
    </style>
</head>
<body>

    {{-- Tombol print hanya muncul saat fallback HTML --}}
    @if(!class_exists(\Barryvdh\DomPDF\Facade\Pdf::class))
    <button class="print-btn" onclick="window.print()">🖨️ Cetak / Simpan PDF</button>
    @endif

    <div class="doc-header">
        <div>
            <div class="doc-badge">Toko FAA</div>
            <div class="doc-title">Data FAQ</div>
        </div>
        <div class="doc-meta">
            Dicetak: {{ now()->translatedFormat('d F Y, H:i') }}<br>
            Total: {{ $faqs->count() }} FAQ
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th class="td-no">No</th>
                <th class="td-question">Pertanyaan</th>
                <th class="td-answer">Jawaban</th>
            </tr>
        </thead>
        <tbody>
            @forelse($faqs as $i => $faq)
            <tr>
                <td class="td-no">{{ $i + 1 }}</td>
                <td class="td-question">{{ $faq->pertanyaan }}</td>
                <td class="td-answer">{{ strip_tags($faq->jawaban) }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="3" style="text-align:center;padding:20px;color:#94a3b8;">
                    Belum ada data FAQ
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="doc-footer">
        <span>Toko FAA &mdash; Admin Master</span>
        <span>vTKFAA</span>
    </div>

</body>
</html>
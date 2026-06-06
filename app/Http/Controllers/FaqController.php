<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class FaqController extends Controller
{
    // ── PUBLIC VIEW ───────────────────────────────────────
    public function publicIndex()
    {
        $faqs = Faq::latest()->get();
        return view('faq-pertanyaan', compact('faqs'));
    }

    // ── INDEX (ADMIN) ──────────────────────────────────────
    public function index()
    {
        $faqs = Faq::latest()->get();
        return view('faq.index', compact('faqs'));
    }

    // ── STORE ──────────────────────────────────────────────
    public function store(Request $request)
    {
        $request->validate([
            'pertanyaan' => 'required|string|max:500',
            'jawaban'    => 'required|string',
        ]);

        Faq::create([
            'pertanyaan' => $request->pertanyaan,
            'jawaban'    => $request->jawaban,
        ]);

        return redirect()->route('faq.index')
                         ->with('success', 'FAQ berhasil ditambahkan.');
    }

    // ── UPDATE ─────────────────────────────────────────────
    public function update(Request $request, Faq $faq)
    {
        $request->validate([
            'pertanyaan' => 'required|string|max:500',
            'jawaban'    => 'required|string',
        ]);

        $faq->update([
            'pertanyaan' => $request->pertanyaan,
            'jawaban'    => $request->jawaban,
        ]);

        return redirect()->route('faq.index')
                         ->with('success', 'FAQ berhasil diperbarui.');
    }

    // ── DESTROY ────────────────────────────────────────────
    public function destroy(Faq $faq)
    {
        $faq->delete();

        return redirect()->route('faq.index')
                         ->with('success', 'FAQ berhasil dihapus.');
    }

    // ── EXPORT EXCEL ───────────────────────────────────────
    // Menggunakan output CSV yang bisa dibuka di Excel
    // (tanpa library tambahan — pure PHP)
    public function exportExcel()
    {
        $faqs = Faq::latest()->get();

        $filename = 'data-faq-' . now()->format('Ymd-His') . '.csv';

        $headers = [
            'Content-Type'        => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
            'Pragma'              => 'no-cache',
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
            'Expires'             => '0',
        ];

        $callback = function () use ($faqs) {
            $handle = fopen('php://output', 'w');

            // BOM agar Excel bisa baca UTF-8 dengan benar
            fprintf($handle, chr(0xEF) . chr(0xBB) . chr(0xBF));

            // Header kolom
            fputcsv($handle, ['No', 'Pertanyaan', 'Jawaban'], ';');

            foreach ($faqs as $index => $faq) {
                fputcsv($handle, [
                    $index + 1,
                    $faq->pertanyaan,
                    strip_tags($faq->jawaban), // hapus HTML tag jika jawaban rich text
                ], ';');
            }

            fclose($handle);
        };

        return Response::stream($callback, 200, $headers);
    }

    // ── EXPORT PDF ─────────────────────────────────────────
    public function exportPdf()
    {
        $faqs = Faq::latest()->get();
        $filename = 'data-faq-' . now()->format('Ymd-His') . '.pdf';

        // Header agar langsung download (sama persis dengan pola Excel)
        $headers = [
            'Content-Type'        => 'application/pdf',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
            'Pragma'              => 'no-cache',
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
            'Expires'             => '0',
        ];

        // Cek library DomPDF
        if (!class_exists(\Barryvdh\DomPDF\Facade\Pdf::class)) {
            return redirect()->back()->with('error', 'Library PDF belum terpasang. Jalankan: composer require barryvdh/laravel-dompdf');
        }

        // Generate PDF
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('faq.pdf', compact('faqs'))
                    ->setPaper('a4', 'portrait');

        // Mengembalikan response stream/output (mirip pola Excel)
        return response($pdf->output(), 200, $headers);
    }
}
<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\PostTooLargeException;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });

        // Form survei: jangan tampilkan halaman error di /nilaiUnsur,
        // kembalikan ke /skm dengan pesan yang bisa dipahami responden.
        // TokenMismatchException sudah diubah Laravel menjadi HttpException 419 sebelum sampai sini
        $this->renderable(function (HttpException $e, Request $request) {
            if ($e->getStatusCode() === 419 && $request->is('nilaiUnsur')) {
                return redirect('/skm')
                    ->withInput($request->except(['_token', 'foto_ktp']))
                    ->with('error', 'Sesi formulir sudah habis karena halaman terbuka terlalu lama. Silakan periksa kembali isian Anda lalu kirim ulang.');
            }
        });

        $this->renderable(function (PostTooLargeException $e, Request $request) {
            if ($request->is('nilaiUnsur')) {
                // error ini terjadi sebelum session aktif, jadi pesan dikirim lewat URL
                return redirect('/skm?gagal=foto-terlalu-besar');
            }
        });
    }
}

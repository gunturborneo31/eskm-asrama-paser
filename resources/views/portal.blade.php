<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Portal - E-SKM Unit Penghubung Kabupaten Paser Juanda, Samarinda</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    boxShadow: {
                        soft: '0 8px 30px rgba(15, 23, 42, 0.08)'
                    }
                }
            }
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="text-slate-800 relative" style="background-color: #06336b;">
    @include('partials.paser-bg')
    @include('partials.toast-success')
    <div class="min-h-screen flex items-center justify-center p-4 sm:p-6">
        <div class="w-full max-w-md">
            <div class="bg-white rounded-[28px] shadow-[0_20px_60px_rgba(0,141,213,0.12)] p-6 sm:p-7 border border-[#CFE8F8]">
                <div class="flex justify-center mb-6">
                    <img src="{{ asset('assets/logo_paser.png') }}" alt="Logo Paser" class="w-24 h-24 sm:w-28 sm:h-28 object-contain drop-shadow-[0_8px_20px_rgba(0,141,213,0.2)]" />
                </div>

                <div class="text-center space-y-2">
                    <h1 class="text-xl sm:text-2xl font-extrabold leading-tight text-[#008DD5]">
                        <span class="inline-block">UNIT PENGHUBUNG</span>
                        <span class="inline-block">KABUPATEN PASER</span><br>JUANDA, SAMARINDA
                    </h1>
                    <p class="text-sm text-slate-500">JL. Juanda 4 No. 102 Samarinda</p>
                </div>

                <div class="mt-10 pt-6 border-t border-slate-200">
                    <p class="text-center text-sm font-semibold text-slate-700 mb-4">Hubungi Kami:</p>
                    <div class="flex flex-col gap-3">
                        <a href="https://www.instagram.com/perpaser_2912/" target="_blank" rel="noopener noreferrer"
                            class="flex items-center justify-center gap-3 w-full rounded-xl bg-gradient-to-r from-[#0EA5E9] to-[#2563EB] text-white font-medium py-3 shadow-sm hover:opacity-95 active:scale-[0.99] transition-all">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                <path d="M7 2h10a5 5 0 0 1 5 5v10a5 5 0 0 1-5 5H7a5 5 0 0 1-5-5V7a5 5 0 0 1 5-5zm0 2a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3V7a3 3 0 0 0-3-3H7zm5 3.5A5.5 5.5 0 1 1 6.5 13 5.5 5.5 0 0 1 12 7.5zm0 2A3.5 3.5 0 1 0 15.5 13 3.5 3.5 0 0 0 12 9.5zm5.75-3.38a1.37 1.37 0 1 1-1.37-1.37 1.37 1.37 0 0 1 1.37 1.37z"/>
                            </svg>
                            <span>Instagram</span>
                        </a>

                        <a href="http://wa.me/+6281239297967" target="_blank" rel="noopener noreferrer"
                            class="flex items-center justify-center gap-3 w-full rounded-xl bg-[#0DBB5B] text-white font-medium py-3 shadow-sm hover:opacity-95 active:scale-[0.99] transition-all">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                <path d="M20.52 3.48A11.8 11.8 0 0 0 12.07 0C5.52 0 .2 5.31.2 11.86c0 2.09.55 4.13 1.59 5.92L0 24l6.4-1.67a11.85 11.85 0 0 0 5.67 1.71h.01c6.55 0 11.87-5.31 11.87-11.85 0-3.17-1.23-6.16-3.44-8.38zM12.08 21.6h-.01a9.83 9.83 0 0 1-5-1.37l-.36-.21-3.8.99 1.01-3.7-.23-.38a9.82 9.82 0 0 1-1.52-5.17c0-5.44 4.43-9.86 9.89-9.86A9.82 9.82 0 0 1 21.96 11.9c0 5.45-4.43 9.86-9.88 9.86zm5.42-7.39c-.3-.15-1.73-.85-2-.95-.27-.1-.47-.15-.67.15-.2.3-.77.95-.94 1.14-.17.2-.35.22-.65.08-.3-.15-1.27-.46-2.42-1.48-.9-.8-1.5-1.78-1.67-2.08-.17-.3-.02-.46.13-.62.13-.13.3-.35.45-.52.15-.17.2-.3.3-.5.1-.2.05-.37-.02-.52-.08-.15-.67-1.62-.92-2.22-.24-.58-.49-.5-.67-.51l-.57-.01c-.2 0-.52.07-.8.37-.27.3-1.05 1.02-1.05 2.49s1.07 2.88 1.22 3.08c.15.2 2.1 3.2 5.08 4.56.71.31 1.27.49 1.71.62.71.23 1.36.2 1.87.12.57-.09 1.73-.7 1.97-1.39.24-.69.24-1.28.17-1.4-.08-.12-.28-.2-.58-.35z"/>
                            </svg>
                            <span>WhatsApp</span>
                        </a>
                    </div>
                </div>

                <div class="mt-8">
                    <a href="{{ url('/nilai-skm') }}"
                        class="mb-3 flex items-center justify-center w-full rounded-xl border-2 border-[#008DD5] bg-white hover:bg-sky-50 active:scale-[0.99] transition-all duration-200 text-[#008DD5] font-semibold text-base sm:text-lg py-3.5">
                        Lihat Nilai SKM
                    </a>
                    <a href="{{ url('/skm') }}"
                        class="group flex items-center justify-center w-full rounded-xl bg-[#008DD5] hover:bg-[#0077B8] active:scale-[0.99] transition-all duration-200 text-white font-semibold text-base sm:text-lg py-4 shadow-[0_12px_25px_rgba(0,141,213,0.3)]">
                        Isi Buku Tamu & Survey
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

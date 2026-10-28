{{-- Notifikasi sukses (mis. setelah survei terkirim), hilang sendiri setelah 4 detik --}}
    @if (session('success'))
        <div id="toast-success"
            class="fixed top-4 left-1/2 -translate-x-1/2 z-50 w-[calc(100%-2rem)] max-w-md flex items-center gap-3 rounded-2xl bg-white px-4 py-3 shadow-2xl border-l-8 border-green-500 transition-opacity duration-500">
            <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-green-500 text-white font-black">✓</span>
            <p class="flex-1 text-sm sm:text-base font-semibold text-slate-800">{{ session('success') }}</p>
            <button type="button" onclick="this.parentElement.remove()" class="text-slate-400 hover:text-slate-600 text-xl leading-none" aria-label="Tutup">&times;</button>
        </div>
        <script>
            setTimeout(function () {
                var t = document.getElementById('toast-success');
                if (t) { t.style.opacity = '0'; setTimeout(function () { t.remove(); }, 500); }
            }, 4000);
        </script>
    @endif

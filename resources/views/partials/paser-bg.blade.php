{{--
    Background bersama E-SKM: gradien mesh + pola motif + siluet Kabupaten Paser
    (Gunung Lumut, rumah panggung Sadurengas, masjid, nyiur/sawit, Sungai Kandilo).

    Pemakaian:
      @include('partials.paser-bg')                         -> fixed di belakang seluruh halaman
      @include('partials.paser-bg', ['contained' => true])  -> hanya mengisi parent (parent butuh class "relative isolate overflow-hidden")
--}}
@php($contained = $contained ?? false)

@once
<style>
    .paser-bg {
        position: fixed;
        inset: 0;
        z-index: -1;
        overflow: hidden;
        pointer-events: none;
        background:
            radial-gradient(ellipse 60% 50% at 12% 8%, rgba(255, 255, 255, .22), transparent 60%),
            radial-gradient(ellipse 45% 40% at 82% 72%, rgba(255, 200, 110, .30), transparent 65%),
            radial-gradient(ellipse 55% 45% at 95% 5%, rgba(34, 211, 238, .35), transparent 60%),
            linear-gradient(165deg, #06336b 0%, #0067b8 38%, #008dd5 62%, #14b3c9 100%);
    }

    .paser-bg.paser-bg--contained {
        position: absolute;
    }

    /* pola motif belah ketupat ala anyaman, memudar ke bawah */
    .paser-bg::before {
        content: "";
        position: absolute;
        inset: 0;
        opacity: .09;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='48' height='48' viewBox='0 0 48 48'%3E%3Cg fill='none' stroke='%23fff' stroke-width='1.2'%3E%3Cpath d='M24 2 46 24 24 46 2 24Z'/%3E%3Cpath d='M24 12 36 24 24 36 12 24Z'/%3E%3C/g%3E%3Ccircle cx='24' cy='24' r='2' fill='%23fff'/%3E%3C/svg%3E");
        background-size: 48px 48px;
        -webkit-mask-image: linear-gradient(to bottom, #000 0%, rgba(0, 0, 0, .4) 45%, transparent 75%);
        mask-image: linear-gradient(to bottom, #000 0%, rgba(0, 0, 0, .4) 45%, transparent 75%);
    }

    /* butiran halus agar gradien tidak terlihat "plastik" */
    .paser-bg::after {
        content: "";
        position: absolute;
        inset: 0;
        opacity: .06;
        background-image: radial-gradient(rgba(255, 255, 255, .9) 1px, transparent 1px);
        background-size: 22px 22px;
    }

    .paser-bg__blob {
        position: absolute;
        border-radius: 9999px;
        filter: blur(70px);
        opacity: .55;
        animation: paser-float 22s ease-in-out infinite alternate;
    }

    .paser-bg__blob--a {
        width: 42vmax; height: 42vmax; left: -12vmax; top: -14vmax;
        background: #38bdf8;
    }

    .paser-bg__blob--b {
        width: 34vmax; height: 34vmax; right: -10vmax; top: 20vh;
        background: #2dd4bf;
        animation-duration: 28s;
        animation-direction: alternate-reverse;
    }

    .paser-bg__blob--c {
        width: 26vmax; height: 26vmax; left: 35vw; top: 30vh;
        background: #1d4ed8;
        opacity: .35;
        animation-duration: 34s;
    }

    .paser-bg__sun {
        position: absolute;
        right: 22%;
        bottom: calc(min(36vh, 340px) - 4vh);
        width: 16vmin; height: 16vmin;
        border-radius: 9999px;
        background: radial-gradient(circle, rgba(255, 236, 179, .85) 0%, rgba(255, 196, 92, .35) 45%, transparent 70%);
        filter: blur(2px);
    }

    .paser-bg__cloud {
        position: absolute;
        height: 3.2vmin;
        border-radius: 9999px;
        background: rgba(255, 255, 255, .16);
        filter: blur(1px);
        animation: paser-drift 70s linear infinite;
    }

    .paser-bg__cloud::before {
        content: "";
        position: absolute;
        left: 22%;
        bottom: 40%;
        width: 45%;
        height: 160%;
        border-radius: 9999px;
        background: inherit;
    }

    .paser-bg__cloud--1 { width: 18vmin; top: 14%; left: -20%; }
    .paser-bg__cloud--2 { width: 12vmin; top: 26%; left: -20%; animation-duration: 95s; animation-delay: -40s; }
    .paser-bg__cloud--3 { width: 22vmin; top: 8%;  left: -20%; animation-duration: 120s; animation-delay: -80s; opacity: .7; }

    .paser-bg__scene {
        position: absolute;
        left: 0;
        right: 0;
        bottom: 0;
        width: 100%;
        height: min(36vh, 340px);
    }

    .paser-bg--contained .paser-bg__scene {
        height: 38%;
    }

    @keyframes paser-float {
        0%   { transform: translate3d(0, 0, 0) scale(1); }
        50%  { transform: translate3d(4vw, 3vh, 0) scale(1.08); }
        100% { transform: translate3d(-3vw, 6vh, 0) scale(.95); }
    }

    @keyframes paser-drift {
        from { transform: translateX(0); }
        to   { transform: translateX(150vw); }
    }

    @media (max-width: 640px) {
        .paser-bg__scene { height: 24vh; }
    }

    @media (prefers-reduced-motion: reduce) {
        .paser-bg__blob,
        .paser-bg__cloud { animation: none; }
    }
</style>
@endonce

<div class="paser-bg {{ $contained ? 'paser-bg--contained' : '' }}" aria-hidden="true">
    <span class="paser-bg__blob paser-bg__blob--a"></span>
    <span class="paser-bg__blob paser-bg__blob--b"></span>
    <span class="paser-bg__blob paser-bg__blob--c"></span>
    <span class="paser-bg__sun"></span>
    <span class="paser-bg__cloud paser-bg__cloud--1"></span>
    <span class="paser-bg__cloud paser-bg__cloud--2"></span>
    <span class="paser-bg__cloud paser-bg__cloud--3"></span>

    <svg class="paser-bg__scene" viewBox="0 0 1440 320" preserveAspectRatio="xMidYMax slice"
        xmlns="http://www.w3.org/2000/svg">
        <defs>
            <symbol id="paser-palm" viewBox="0 0 100 140">
                <path d="M52 140 C48 110 46 80 56 40" fill="none" stroke="currentColor" stroke-width="5"
                    stroke-linecap="round" />
                <path d="M56 40 C40 26 20 28 6 42 C24 34 40 36 56 44Z" />
                <path d="M56 40 C72 24 90 26 100 40 C84 34 70 36 56 44Z" />
                <path d="M56 40 C46 20 34 10 18 8 C34 16 44 26 54 42Z" />
                <path d="M56 40 C64 18 78 8 94 10 C78 16 66 28 58 42Z" />
                <path d="M56 40 C50 52 40 62 28 74 C42 60 50 52 58 44Z" />
                <path d="M56 40 C64 52 74 62 86 72 C72 60 62 52 56 44Z" />
                <circle cx="53" cy="45" r="3.5" />
                <circle cx="59" cy="46" r="3.5" />
            </symbol>
            <symbol id="paser-tree" viewBox="0 0 60 80">
                <rect x="27" y="50" width="6" height="30" />
                <circle cx="30" cy="30" r="20" />
                <circle cx="16" cy="44" r="13" />
                <circle cx="44" cy="44" r="13" />
            </symbol>
        </defs>

        {{-- burung --}}
        <g fill="none" stroke="#ffffff" stroke-opacity=".55" stroke-width="2.2" stroke-linecap="round">
            <path d="M560 70 q8 -8 16 0 q8 -8 16 0" />
            <path d="M605 52 q6 -6 12 0 q6 -6 12 0" />
            <path d="M640 82 q5 -5 10 0 q5 -5 10 0" />
        </g>

        {{-- lapis 1: punggungan Gunung Lumut di kejauhan --}}
        <path fill="#ffffff" fill-opacity=".10"
            d="M0 210 C60 190 100 170 150 172 C210 175 240 140 300 128 C350 118 380 150 430 146 C480 142 500 100 560 92 C620 84 650 128 700 130 C760 132 790 110 840 118 C900 128 930 160 980 150 C1030 140 1060 84 1120 76 C1180 70 1210 118 1260 122 C1320 126 1370 150 1440 140 V320 H0Z" />

        {{-- lapis 2: perbukitan + hutan --}}
        <g fill="#03294d" color="#03294d" opacity=".38">
            <path
                d="M0 250 C120 222 220 228 320 236 C420 244 520 214 640 220 C760 226 860 244 980 236 C1100 228 1220 214 1440 232 V320 H0Z" />
            <use href="#paser-tree" x="40" y="196" width="40" height="54" />
            <use href="#paser-tree" x="70" y="186" width="50" height="66" />
            <use href="#paser-tree" x="520" y="178" width="46" height="60" />
            <use href="#paser-tree" x="556" y="190" width="36" height="48" />
            <use href="#paser-tree" x="1240" y="176" width="44" height="58" />
            <use href="#paser-tree" x="1276" y="186" width="34" height="46" />
            <use href="#paser-tree" x="1380" y="180" width="44" height="58" />
        </g>

        {{-- lapis 3: ikon Paser --}}
        <g fill="#021d38" color="#021d38" opacity=".55">
            {{-- rumah panggung / Museum Sadurengas --}}
            <g>
                <rect x="300" y="200" width="150" height="34" />
                <path d="M282 204 L375 150 L468 204 Z" />
                <path d="M330 168 L375 124 L420 168 Z" />
                <path d="M366 128 L360 112 L375 122 L390 112 L384 128 Z" />
                <rect x="308" y="232" width="5" height="30" />
                <rect x="340" y="232" width="5" height="30" />
                <rect x="372" y="232" width="5" height="30" />
                <rect x="404" y="232" width="5" height="30" />
                <rect x="437" y="232" width="5" height="30" />
                <path d="M450 222 L486 262 L478 262 L446 226 Z" />
                <rect x="292" y="232" width="166" height="4" />
            </g>

            {{-- masjid kubah + dua menara --}}
            <g>
                <rect x="1000" y="206" width="110" height="56" />
                <path d="M1012 208 C1012 172 1030 154 1055 148 C1080 154 1098 172 1098 208 Z" />
                <rect x="1053" y="128" width="4" height="22" />
                <path d="M1055 118 a8 8 0 1 0 6 13 a6 6 0 1 1 -6 -13 Z" />
                <rect x="976" y="150" width="14" height="112" />
                <path d="M972 152 L983 128 L994 152 Z" />
                <rect x="972" y="176" width="22" height="4" />
                <rect x="1120" y="150" width="14" height="112" />
                <path d="M1116 152 L1127 128 L1138 152 Z" />
                <rect x="1116" y="176" width="22" height="4" />
            </g>

            {{-- nyiur / sawit --}}
            <use href="#paser-palm" x="150" y="150" width="80" height="112" />
            <use href="#paser-palm" x="210" y="172" width="64" height="90" />
            <use href="#paser-palm" x="690" y="160" width="74" height="104" />
            <use href="#paser-palm" x="760" y="178" width="58" height="84" />
            <use href="#paser-palm" x="1180" y="156" width="78" height="108" />
            <use href="#paser-palm" x="1340" y="170" width="62" height="92" />

            {{-- tanah --}}
            <path
                d="M0 262 C160 254 300 266 480 260 C660 254 820 268 1000 262 C1180 256 1320 266 1440 260 V320 H0Z" />
        </g>

        {{-- lapis 4: Sungai Kandilo + perahu ketinting --}}
        <path fill="#ffffff" fill-opacity=".10"
            d="M0 286 Q90 274 180 286 T360 286 T540 286 T720 286 T900 286 T1080 286 T1260 286 T1440 286 V320 H0Z" />
        <path fill="#ffffff" fill-opacity=".07"
            d="M0 300 Q120 290 240 300 T480 300 T720 300 T960 300 T1200 300 T1440 300 V320 H0Z" />
        <g fill="#021d38" opacity=".6">
            <path d="M590 282 Q640 294 700 282 L692 291 Q640 298 598 291 Z" />
            <circle cx="652" cy="268" r="4" />
            <path d="M647 273 h10 l3 11 h-16 Z" />
            <rect x="618" y="260" width="2" height="26" transform="rotate(-25 619 273)" />
        </g>
    </svg>
</div>

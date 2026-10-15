<!doctype html>
<html class="scroll-smooth">

<head>
    <title>E-SKM - Unit Penghubung Kabupaten Paser Juanda, Samarinda</title>
    <meta charset="utf-8">
    <meta name="viewport" conteitial-scale="1.0">
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="items-center relative" style="background-color: #06336b;">
    @include('partials.paser-bg')
    <div class="m-auto flex flex-col h-screen items-center justify-center">
        <div class="fixed insert-0 bg-opacity-50 overflow-y-auto w-full" id="modal">
            <div class="relative mx-auto p-5 border lg:w-1/2 w-5/6 shadow-lg rounded-md bg-white">
                <div class="mt-3 text-center">
                    <div class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-[#008DD5] mb-5">
                        <svg class="lg:h-12 lg:w-12 h-24 w-24 text-white" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlnx="http://www.w.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                    </div>
                    <h3 class="lg:text-2xl text-5xl leading-tight font-medium text-gray-900">Input Data SKM Berhasil</h3>
                    <div class="mt-2 px-7 py-3">
                        <p class="lg:text-xl text-5xl text-gray-600 capitalize">terimakasih sudah berpartisipasi dalam
                            pengisian
                            <br>survey kepuasan masyarakat
                        </p>
                    </div>
                    <div class="items-center px-4 py-3">
                        <a href="/">
                            <button id="ok-btn"
                                class="px-4 py-2 bg-[#008DD5] text-white
                            lg:text-base text-5xl font-medium rounded-md w-full
                            shadow-sm hover:bg-[#008DD5] focus:outline-none focus:ring-2 focus:ring-purple-300">
                                OK
                            </button></a>

                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
</body>

</html>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DESAKU</title>
    <link href="{{ asset('desain/welcome.css') }}" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <header class="bg-black/90 text-white py-4 shadow-md">
        <div class="container mx-auto px-6 flex items-center justify-between">
            <h1 class="text-5xl font-extrabold fade-in">DESAKU</h1>
            <nav>
                @if (Route::has('login'))
                    <div class="flex space-x-4">
                        @auth
                            <a href="{{ url('/dashboard') }}"
                                class="px-6 py-3 bg-white text-blue-600 rounded-lg shadow-md hover:bg-gray-100 transition transform hover:scale-105">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                                class="px-6 py-3 bg-white text-blue-600 rounded-lg shadow-md hover:bg-gray-100 transition transform hover:scale-105">
                                Login
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                    class="px-6 py-3 bg-white text-blue-600 rounded-lg shadow-md hover:bg-gray-100 transition transform hover:scale-105">
                                    Register
                                </a>
                            @endif
                        @endauth
                    </div>
                @endif
            </nav>
        </div>
    </header>

    <main class="main-container">
        <div class="content-box">
            <div class="text-section">
                <h1 class="title">Selamat Datang</h1>
                <p class="subtitle">
                    Halo! Terima kasih telah mengunjungi <strong>DESAKU</strong>. Kami siap memberikan informasi terbaik
                    untuk Anda.
                </p>
                <div class="konten-wrapper">
                    @foreach ($konten as $item)
                        <div class="konten-card">
                            @if ($item->gambar)
                                <img src="{{ asset('storage/' . $item->gambar) }}" alt="Gambar Konten"
                                    class="konten-gambar">
                            @endif

                            <h2 class="konten-judul">{{ $item->judul }}</h2>
                            <p class="konten-kategori">Kategori: {{ $item->kategori->nama }}</p>

                            
                            <span id="konten-{{ $item->id }}">
                                {{ Str::limit(strip_tags($item->isi), 200, '...') }}
                            </span>

                            <br>

                            @if (strlen(strip_tags($item->isi)) > 200)
                                
                                <button class="btn-detail" id="btn-selengkapnya-{{ $item->id }}"
                                    onclick="bacaSelengkapnya({{ $item->id }}, `{!! e(strip_tags($item->isi)) !!}`)">
                                    Baca Selengkapnya.
                                </button>

                                
                                <button class="btn-detail" id="btn-sedikit-{{ $item->id }}"
                                    onclick="lebihSedikit({{ $item->id }}, `{!! e(Str::limit(strip_tags($item->isi), 200, '...')) !!}`)"
                                    style="display: none;">
                                    Lebih Sedikit.
                                </button>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
    <div class="footer text-center py-2 text-sm">
        &copy; {{ date('Y') }} <strong>DESAKU</strong>. All rights reserved.
    </div>
    <script>
        function bacaSelengkapnya(id, fullText) {
            document.getElementById(`konten-${id}`).innerHTML = fullText;
            document.getElementById(`btn-selengkapnya-${id}`).style.display = "none";
            document.getElementById(`btn-sedikit-${id}`).style.display = "inline-block";
        }

        function lebihSedikit(id, shortText) {
            document.getElementById(`konten-${id}`).innerHTML = shortText;
            document.getElementById(`btn-selengkapnya-${id}`).style.display = "inline-block";
            document.getElementById(`btn-sedikit-${id}`).style.display = "none";
        }
    </script>
</body>

</html>

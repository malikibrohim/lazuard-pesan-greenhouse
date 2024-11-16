<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT. Lazuard Agritech</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css" rel="stylesheet">
    @vite('resources/css/app.css')

    <style>
        html {
            scroll-behavior: smooth;
        }

        @media (max-width: 640px) {
            .carousel-inner {
                width: 100%;
                padding: 10px;
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animated {
            opacity: 0;
            animation-fill-mode: forwards;
        }

        .fadeInUp {
            animation-name: fadeInUp;
            animation-duration: 1s;
            animation-delay: 0.3s;
            /* Atur delay sesuai kebutuhan */
        }
    </style>


</head>

<body class="bg-gray-100">
    <header class="bg-white shadow-lg fixed top-0 left-0 z-50 w-full h-24">
        <nav class="container mx-auto p-5 flex justify-between items-center h-full">
            <x-application-logo class="w-12 h-auto">Brand</x-application-logo>
            <div>
                <a onclick="navigateTo('about-us')" class="text-nav border-0 ml-2 cursor-pointer" onmouseover="this.style.color='#06D001';" onmouseout="this.style.color='';">Tentang Kami</a>
                <a onclick="navigateTo('produk-kami')" class="text-nav border-0 ml-2 cursor-pointer" onmouseover="this.style.color='#06D001';" onmouseout="this.style.color='';">Produk Kami</a>
            </div>
            <script>
                function navigateTo(sectionId) {
                    const section = document.getElementById(sectionId);
                    if (section) {
                        section.scrollIntoView({
                            behavior: 'smooth'
                        });
                    }
                }
            </script>
        </nav>
    </header>

    @if (session('success'))
    <div class="fixed inset-0 z-50 flex items-center justify-center" id="flash-message-container">
        <div class="bg-white rounded-md shadow-lg p-4 animate-fade-in-up" id="flash-message">
            <p class="text-green-600 text-center">{{ session('success') }}</p>
        </div>
    </div>
    <script>
        setTimeout(function() {
            const flashMessage = document.getElementById('flash-message');
            const flashMessageContainer = document.getElementById('flash-message-container');
            flashMessage.classList.add('opacity-100');
            flashMessage.classList.remove('opacity-0');
            setTimeout(function() {
                flashMessage.classList.add('opacity-0');
                flashMessage.classList.remove('opacity-100');
                setTimeout(function() {
                    flashMessage.remove();
                    flashMessageContainer.remove();
                }, 500);
            }, 2500);
        }, 500);
    </script>
    @endif

    <section class="bg-black min-h-screen mt-24 animated" id="awal">
        <div class="container mx-auto p-4 text-center">
            <div class="flex flex-col items-center justify-center">
                <x-application-logo class="mb-4 mt-4 text-white w-48 h-auto"></x-application-logo>
                <h1 class="text-5xl font-bold text-gray-600">Selamat Datang di</h1>
                <h1 class="text-6xl font-bold bg-gradient-to-r from-green-500 to-green-700 text-transparent bg-clip-text pb-6">PT. Lazuard Agritech</h1>
                <p class="pb- text-gray-600">Menerima pemesanan Greenhouse sekaligus pemasangan.</p>
                <p class="pb-9 text-gray-600">Kami siap melayani dengan kualitas dan harga terbaik.</p>
                <button onclick="navigateTo('produk-kami')" class="bg-gradient-to-r from-green-500 to-green-700 text-white px-4 py-2 rounded">Lihat Produk Kami</button>
            </div>
        </div>
    </section>

    <section class="container mx-auto py-20 my-8 animated" id="about-us">
        <h2 class="text-4xl font-bold text-center mt-12 mb-12 text-gray-600">Tentang Kami</h2>
        <div class="flex justify-center items-center px-5">
            <div class="card bg-black shadow-md rounded-lg overflow-hidden mr-4 ml-6">
                <div class="card-body p-4">
                    <h5 class="text-lg font-bold text-green-600">Profil Perusahaan</h5>
                    <p class="text-md text-gray-400 mt-2">PT. LAZUARD AGRITECH INDONESIA adalah perusahan yang bergerak dibidang jasa produksi dan pembangunan kontruksi Green House yang sudah berpengalaman sejak tahun 2013</p>
                </div>
            </div>
        </div>
        <div class="flex justify-center items-center px-5 mt-5">
            <div class="card bg-black shadow-md rounded-lg overflow-hidden ml-6 mr-4">
                <div class="card-body p-4">
                    <h5 class="text-lg font-bold text-green-600">Keunggulan Produk</h5>
                    <p class="text-md text-gray-400 mt-2">PT. LAZUARD AGRITECH INDONESIA memiliki berbagai kegunggulan struktur greenhouse yang sesuai dengan iklim tropis Indonesai, Menggunakan material besi galvanis yang tahan korosi, Sistem kontruksi knock down untuk mempermudah setup, Didukung tim teknisi yang profesional dan berpengalaman harga yang kompetitif dengan jaminan kualitas </p>
                </div>
            </div>
        </div>
    </section>

    <section class="container mx-auto py-20 my-8 animated" id="produk-kami">
        <h2 class="text-4xl font-bold text-center mt-12 mb-4 text-gray-600">Produk Kami</h2>
        <div class="flex flex-row justify-center">
            @foreach ($produks as $index => $produk)
            <div class="card bg-black rounded-lg shadow-lg m-2 border-0 w-64 h-100 hover:shadow-lg transition duration-200 hover:scale-105">
                <img src="{{ asset('storage/' . $produk->image_produk) }}" alt="{{ $produk->nama_produk }}" class="w-full h-40 object-cover rounded-t-lg" />
                <div class="p-4">
                    <h2 class="text-2xl font-bold text-center text-green-600">{{ $produk->nama_produk }}</h2>
                    <p class="mt-2 text-left text-gray-400">{{ $produk->deskripsi_produk }}</p>
                    <p class="mt-2 text-left text-gray-400">Harga : Rp. {{ number_format($produk->harga_produk, 0, ',', '.') }} /m</p>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center">
            <p class="text-md text-gray-600 mt-5 mb-5">Greenhouse kami dirancang khusus untuk iklim tropis Indonesia dengan spesifikasi sebagai berikut: menggunakan material besi galvanis yang tahan korosi, dilengkapi dengan sistem konstruksi knock down untuk mempermudah setup, serta didukung oleh tim teknisi profesional dan berpengalaman. Kami menawarkan harga yang kompetitif dengan jaminan kualitas terbaik.</p>
        </div>
        <div class="p-4 flex justify-center">
            <button class="bg-gradient-to-r from-green-400 to-green-700 text-white py-2 px-4 rounded shadow-md hover:shadow-lg transition duration-200 hover:scale-105" data-toggle="modal" data-target="#pesanModal" id="pesanButton">Pesan Sekarang</button>
        </div>
    </section>

    <!--modal pesan -->
    <div class="modal fade" id="pesanModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header text-black">
                    <h5 class="modal-title" id="addModalLabel">Pesan Produk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute; right: 0.5rem; top: 0.5rem;">
                        <span aria-hidden="true" class="text-black text-2xl pr-2">x</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('pesan-produk') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="status" value="pending">
                        <div class="mb-3">
                            <label for="nama_customer" class="form-label">Nama Customer</label>
                            <input type="text" class="form-control rounded-md border-gray-300" id="nama_customer" name="nama_customer" required>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat Pengiriman</label>
                            <textarea class="form-control rounded-md border-gray-300" id="alamat" name="alamat" rows="3" oninput="this.value = this.value.replace(/(^\w{1})|(\s+\w{1})|(\.\s[aeiou]\w{1})|(\,\s[aeiou]\w{1})/g, letter => letter.toUpperCase())" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="no_telp" class="form-label">No WhatsApp</label>
                            <input type="text" class="form-control rounded border-gray-300" id="no_telp" name="no_telp" required oninput="formatPhoneNumber(this, '+62')">
                        </div>
                        <div class="mb-3">
                            <label for="nama_produk" class="form-label">Pilih Produk</label>
                            <select class="form-select rounded-md border-gray-300" id="nama_produk" name="nama_produk" required onchange="getHarga(this.value)">
                                <option value="">-- Pilih Produk --</option>
                                @foreach ($produks as $produk)
                                <option value="{{ $produk->nama_produk }}" data-harga="{{ $produk->harga_produk }}">{{ $produk->nama_produk }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="harga" class="form-label">Harga</label>
                            <input type="number" class="form-control rounded-md border-gray-300" id="harga" name="harga" required readonly>
                        </div>
                        <div class="mb-3">
                            <label for="jumlah" class="form-label">Ukuran Meter²</label>
                            <input type="number" class="form-control rounded-md border-gray-300" id="jumlah" name="jumlah" required onchange="hitungTotalHarga()">
                        </div>
                        <div class="mb-3">
                            <label for="total_harga" class="form-label">Total Harga</label>
                            <input type="number" class="form-control rounded-md border-gray-300" id="total_harga" name="total_harga" readonly>
                        </div>

                        <script>
                            function getHarga(id) {
                                var harga = document.querySelector(`#nama_produk option[value="${id}"]`).getAttribute('data-harga');
                                document.getElementById('harga').value = harga;
                                hitungTotalHarga();
                            }

                            function hitungTotalHarga() {
                                var harga = document.getElementById('harga').value;
                                var jumlah = document.getElementById('jumlah').value;
                                var totalHarga = harga * jumlah;
                                document.getElementById('total_harga').value = totalHarga;
                            }
                        </script>
                        <hr class="my-4">
                        <div class="footer flex justify-end">
                            <button type="submit" class="btn btn-success w-full">
                                Pesan Sekarang
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-black text-white p-2">
        <div class="container mx-auto flex flex-wrap justify-between">
            <div class="w-full md:w-1/2 lg:w-1/3 p-4">
                <h3 class="font-bold text-2xl mb-4">Kontak Kami</h3>
                <ul class="list-none mb-4">
                    <li class="mb-1"><i class="fas fa-phone mr-2"></i> 085157388409</li>
                    <li class="mb-1"><i class="fas fa-envelope mr-2"></i> agro.jagad95@gmail.com</li>
                    <li class="mb-1"><i class="fas fa-map-marker-alt mr-2"></i> Alamat : Ds. Gesing, Kec. Garung, Kabupaten Wonosobo, Jawa Tengah</li>
                </ul>
            </div>
            <div class="w-full md:w-1/2 lg:w-1/3 p-4">
                <h3 class="font-bold text-2xl mb-4">Social Media</h3>
                <ul class="list-none mb-4 flex justify-center md:justify-start">
                    <li class="mr-4">
                        <a href="https://www.instagram.com/pt.lazuardagritech?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" target="_blank" rel="noopener noreferrer">
                            <i class="bi bi-instagram text-3xl"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const observer = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('fadeInUp');
                    }
                });
            }, {
                threshold: 0.5 // Trigger ketika 50% elemen masuk dalam viewport
            });

            // Mengamati elemen dengan kelas 'animated'
            document.querySelectorAll('.animated').forEach(el => {
                observer.observe(el);
            });
        });
    </script>
</body>

</html>
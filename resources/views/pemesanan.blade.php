<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Pemesanan') }}
        </h2>
    </x-slot>
    @if (session('success'))
    <div class="absolute top-0 right-0 p-4 mt-4 mr-4 text-sm text-white bg-green-600 border border-green-600 rounded animate-fade-in animate-fade-out" id="flash-message">
        {{ session('success') }}
    </div>
    <script>
        setTimeout(function() {
            const flashMessage = document.getElementById('flash-message');
            flashMessage.classList.add('opacity-100');
            flashMessage.classList.remove('opacity-0');
            setTimeout(function() {
                flashMessage.classList.add('opacity-0');
                flashMessage.classList.remove('opacity-100');
                setTimeout(function() {
                    flashMessage.remove();
                }, 500);
            }, 2500);
        }, 500);
    </script>
    @elseif (session('error'))
    <div class="absolute top-0 right-0 p-4 mt-4 mr-4 text-sm text-white bg-gradient-to-r from-red-400 to-red-700 border border-red-600 rounded animate-fade-in animate-fade-out" id="flash-message">
        {{ session('error') }}
    </div>
    <script>
        setTimeout(function() {
            const flashMessage = document.getElementById('flash-message');
            flashMessage.classList.remove('animate-fade-in');
            flashMessage.classList.add('animate-fade-out');
            setTimeout(function() {
                flashMessage.remove();
            }, 300);
        }, 3000);
    </script>
    @endif
    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-end mb-2">
                        <button class="bg-gradient-to-r from-green-400 to-green-700 text-white font-bold py-2 px-4 rounded shadow-md hover:shadow-lg transition duration-200 ease-in-out hover:translate-y-[-2px] hover:scale-105" data-toggle="modal" data-target="#addModal" id="addProductButton">
                            + Tambah Pemesanan
                        </button>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y border border border-gray-900">
                            <thead class="bg-gradient-to-r from-green-400 to-green-700 text-white">
                                <tr>
                                    <th scope="col" class="px-1 py-3 text-xs font-medium tracking-wider text-center uppercase border" style="width: 50px;">
                                        No
                                    </th>
                                    <th scope="col" class="px-1 py-3 text-xs font-medium tracking-wider text-center uppercase border" style="width: 200px;">
                                        Nama
                                    </th>
                                    <th scope="col" class="px-1 py-3 text-xs font-medium tracking-wider text-center uppercase border" style="width: 300px;">
                                        Alamat
                                    </th>
                                    <th scope="col" class="px-1 py-3 text-xs font-medium tracking-wider text-center uppercase border" style="width: 150px;">
                                        Nomor WhatsApp
                                    </th>
                                    <th scope="col" class="px-1 py-3 text-xs font-medium tracking-wider text-center uppercase border" style="width: 200px;">
                                        Produk
                                    </th>
                                    <th scope="col" class="px-1 py-3 text-xs font-medium tracking-wider text-center uppercase border" style="width: 100px;">
                                        Ukuran Meter²
                                    </th>
                                    <th scope="col" class="px-1 py-3 text-xs font-medium tracking-wider text-center uppercase border" style="width: 150px;">
                                        Total Harga
                                    </th>
                                    <th scope="col" class="px-1 py-3 text-xs font-medium tracking-wider text-center uppercase border" style="width: 100px;">
                                        Status
                                    </th>
                                    <th scope="col" class="px-1 py-3 text-xs font-medium tracking-wider text-center uppercase border" style="width: 100px;">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            @if(count($pemesanan) === 0)
                            <tr>
                                <td colspan="9" class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-center text-gray-500">
                                        Data Masih Kosong
                                    </div>
                                </td>
                            </tr>
                            @endif
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($pemesanan as $pesan)
                                @php
                                $no = 1;
                                @endphp
                                <!--Add Pemesanan-->
                                <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header text-black">
                                                <h5 class="modal-title" id="addModalLabel">Tambah Pesanan</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute; right: 0.5rem; top: 0.5rem;">
                                                    <span aria-hidden="true">x</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('simpan.pemesanan') }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label for="nama_customer" class="form-label">Nama</label>
                                                        <input type="text" class="form-control rounded-md border-gray-300" id="nama_customer" name="nama_customer" oninput="this.value = this.value.replace(/(^\w{1})|(\s+\w{1})/g, letter => letter.toUpperCase())" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="alamat" class="form-label">Alamat</label>
                                                        <textarea class="form-control rounded-md border-gray-300" id="alamat" name="alamat" rows="3" oninput="this.value = this.value.replace(/(^\w{1})|(\s+\w{1})|(\.\s[aeiou]\w{1})|(\,\s[aeiou]\w{1})/g, letter => letter.toUpperCase())" required></textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="no_telp">No WhatsApp</label>
                                                        <input type="text" class="form-control rounded border-gray-300" id="no_telp" name="no_telp" required oninput="formatPhoneNumber(this, '+62')">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="nama_produk" class="form-label">Nama Produk</label>
                                                        <select class="form-select rounded-md border-gray-300" id="nama_produk" name="nama_produk" onchange="changePrice()">
                                                            <option value="">-- Pilih Produk --</option>
                                                            @foreach ($produk as $item)
                                                            <option value="{{ $item->nama_produk }}" data-price="{{ $item->harga_produk }}">{{ $item->nama_produk }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="jumlah" class="form-label">Ukuran Meter²</label>
                                                        <input type="text" class="form-control rounded-md border-gray-300" id="jumlah" name="jumlah" oninput="calculatePrice()" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="total_harga" class="form-label">Total</label>
                                                        <input type="text" class="form-control rounded-md border-gray-300" id="total_harga" name="total_harga" readonly placeholder="0">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="status" class="form-label">Status</label>
                                                        <select class="form-select rounded-md border-gray-300" id="status" name="status">
                                                            <option value="pending">Pending</option>
                                                            <option value="proses">On Proses</option>
                                                            <option value="terkirim">Delivered</option>
                                                            <option value="selesai">Completed</option>
                                                        </select>
                                                    </div>
                                                    <script>
                                                        function changePrice() {
                                                            var harga = parseFloat(document.getElementById("nama_produk").options[document.getElementById("nama_produk").selectedIndex].getAttribute('data-price'));
                                                            document.getElementById("total_harga").value = harga;
                                                        }

                                                        function calculatePrice() {
                                                            var harga = parseFloat(document.getElementById("nama_produk").options[document.getElementById("nama_produk").selectedIndex].getAttribute('data-price'));
                                                            var jumlah = parseFloat(document.getElementById("jumlah").value);
                                                            if (isNaN(jumlah) || jumlah < 0) {
                                                                document.getElementById("total_harga").value = 0;
                                                            } else {
                                                                var total = harga * jumlah;
                                                                document.getElementById("total_harga").value = total;
                                                            }
                                                        }
                                                    </script>
                                                    <hr class="my-4">
                                                    <div class="footer flex justify-end">
                                                        <button type="submit" class="btn btn-primary">
                                                            Tambah
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap border">
                                        <div class="text-sm font-medium text-gray-900 flex items-center justify-center">
                                            {{ $loop->index + 1 }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap border">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $pesan->nama_customer }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap border">
                                        <div class="text-sm text-gray-900">
                                            {{ $pesan->alamat }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap border">
                                        <div class="text-sm text-gray-900">
                                            {{ $pesan->no_telp }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap border">
                                        <div class="text-sm text-gray-900">
                                            {{ $pesan->nama_produk }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap border">
                                        <div class="text-sm text-gray-900">
                                            {{ $pesan->jumlah }} m
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap border">
                                        <div class="text-sm text-gray-900">
                                            {{ 'Rp. ' . number_format($pesan->total_harga, 0, ',', '.') }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap border">
                                        <div class="text-sm text-gray-900">
                                            {{ $pesan->status }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium border">
                                        <button class="text-indigo-600 hover:text-indigo-900" data-toggle="modal" data-target="#editModal{{ $pesan->id }}" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="text-red-600 hover:text-red-900" data-toggle="modal" data-target="#deleteModal{{ $pesan->id }}" title="Hapus">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                        <!-- MODAL DELETE -->
                                        <div class="modal fade" id="deleteModal{{ $pesan->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel">Hapus Data Pesanan</h5>
                                                        <button type="button" class="close" style="position: absolute; right: 0.5rem; top: 0.5rem;" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true" style="font-size: 2rem">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p style="text-align: left;">Apakah Anda yakin ingin menghapus pesanan dengan nomor pesanan</p>
                                                        <p style="text-align: left;">{{ $pesan->no_pesanan }} ?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                        <form action="{{ route('hapus.pemesanan', $pesan->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>

                            <!-- Modal Edit -->

                            <div class="modal fade" id="editModal{{ $pesan->id}}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel">Edit Data Pesanan</h5>
                                            <button type="button" class="close" style="position: absolute; right: 0.5rem; top: 0.5rem;" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true" style="font-size: 2rem">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('update.pemesanan', $pesan->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="mb-3">
                                                    <label for="nama_customer" class="form-label">Nama</label>
                                                    <input type="text" class="form-control rounded-md border-gray-300" id="nama_customer" name="nama_customer" value="{{ $pesan->nama_customer }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="alamat" class="form-label">Alamat</label>
                                                    <textarea class="form-control rounded-md border-gray-300" id="alamat" name="alamat" rows="3">{{ $pesan->alamat }}</textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="no_telp" class="form-label">No. WhatsApp</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">+62</span>
                                                        </div>
                                                        <input type="text" class="form-control rounded-md border-gray-300" id="no_telp" name="no_telp" value="{{ $pesan->no_telp }}" oninput="this.value = this.value.replace(/^0+/, '+62')">
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="nama_produk" class="form-label">Nama Produk</label>
                                                    <select class="form-select rounded-md border-gray-300" id="nama_produk" name="nama_produk">
                                                        <option value="">-- Pilih Produk --</option>
                                                        @foreach ($produk as $item)
                                                        <option value="{{ $item->nama_produk }}" {{ $pesan->nama_produk == $item->nama_produk ? 'selected' : '' }}>{{ $item->nama_produk }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="jumlah" class="form-label">Ukuran</label>
                                                    <input type="number" class="form-control rounded-md border-gray-300" id="jumlah" name="jumlah" value="{{ $pesan->jumlah }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="total_harga" class="form-label">Total Harga</label>
                                                    <input type="text" class="form-control rounded-md border-gray-300" id="total_harga" name="total_harga" value="{{ $pesan->total_harga }}" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="status" class="form-label">Status</label>
                                                    <select class="form-select rounded-md border-gray-300" id="status" name="status">
                                                        <option value="">-- Pilih Status --</option>
                                                        <option value="pending" {{ $pesan->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                        <option value="proses" {{ $pesan->status == 'proses' ? 'selected' : '' }}>Proses</option>
                                                        <option value="terkirim" {{ $pesan->status == 'terkirim' ? 'selected' : '' }}>Terkirim</option>
                                                        <option value="selesai" {{ $pesan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                                    </select>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </table>
                        <div class="px-6 py-3">
                            {{ $pemesanan->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</x-app-layout>
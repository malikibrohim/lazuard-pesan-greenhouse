<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Customer') }}
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
                        <button class="bg-gradient-to-r from-green-400 to-green-700 text-white font-bold py-2 px-4 rounded shadow-md hover:shadow-lg transition duration-300 hover:scale-105" data-toggle="modal" data-target="#addModal" id="addProductButton">
                            + Tambah Customer
                        </button>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y border border border-gray-900">
                            <thead class="bg-gradient-to-r from-green-400 to-green-700 text-white">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-center uppercase border" style="width: 5%;">
                                        No
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-center uppercase border" style="width: 20%;">
                                        Nama Customer
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-center uppercase border" style="width: 40%;">
                                        Alamat
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-center uppercase border" style="width: 20%;">
                                        No WhatsApp
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-center uppercase border" style="width: 5%;">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            @if(count($customer) === 0)
                            <tr>
                                <td colspan="6" class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-center text-gray-500">
                                        Data Kosong
                                    </div>
                                </td>
                            </tr>
                            @endif
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($customer as $customer)
                                @php
                                $no = 1;
                                @endphp
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap border">
                                        <div class="text-sm font-medium text-gray-900 flex items-center justify-center">
                                            {{ $loop->index + 1 }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap border">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $customer->nama_customer }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap border">
                                        <div class="text-sm text-gray-900">
                                            {{ $customer->alamat }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap border">
                                        <div class="text-sm text-gray-900">
                                            {{ $customer->no_telp }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium border">
                                        <button class="text-indigo-600 hover:text-indigo-900" data-toggle="modal" data-target="#editModal{{ $customer->id }}" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="text-red-600 hover:text-red-900" data-toggle="modal" data-target="#deleteModal{{ $customer->id }}" title="Hapus">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>

                                        <!--modal Delete-->

                                        <div class="modal fade" id="deleteModal{{ $customer->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel">Hapus Data Customer</h5>
                                                        <button type="button" class="close" style="position: absolute; right: 0.5rem; top: 0.5rem;" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true" style="font-size: 2rem">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Apakah Anda yakin ingin menghapus data Customer {{ $customer->nama_customer }}?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                        <form action="{{ route('customer.hapus', $customer->id) }}" method="POST">
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

                                <!--modal Edit-->

                                <div class="modal fade" id="editModal{{ $customer->id}}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel">Edit Data Customer</h5>
                                            </div>
                                            <form action="{{ route('customer.update', $customer->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="nama_customer" class="form-label">Nama Customer</label>
                                                        <input type="text" class="form-control rounded-md border-gray-300" id="nama_customer" name="nama_customer" value="{{ $customer->nama_customer }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="alamat" class="form-label">Alamat</label>
                                                        <textarea class="form-control rounded-md border-gray-300" id="alamat" name="alamat" rows="3" required>{{ $customer->alamat }}</textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="no_telp">No WhatsApp</label>
                                                        <input type="text" class="form-control rounded border-gray-300" id="no_telp" name="no_telp" required oninput="formatPhoneNumber(this, '+62')" value="{{ $customer->no_telp }}">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--modal add -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header text-black">
                    <h5 class="modal-title" id="addModalLabel">Add Customer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute; right: 0.5rem; top: 0.5rem;">
                        <span aria-hidden="true">x</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('customer.simpan') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="nama_customer" class="form-label">Nama Customer</label>
                            <input type="text" class="form-control rounded-md border-gray-300" id="nama_customer" name="nama_customer" required>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control rounded-md border-gray-300" id="alamat" name="alamat" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="no_telp">No WhatsApp</label>
                            <input type="text" class="form-control rounded border-gray-300" id="no_telp" name="no_telp" required oninput="formatPhoneNumber(this, '+62')">
                        </div>
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
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</x-app-layout>
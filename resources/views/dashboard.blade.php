<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-lg transition duration-300 ease-in-out">
                    <div class="p-6 text-gray-900">
                        <h3 class="font-bold text-lg">Jumlah Produk</h3>
                        <p class="text-3xl font-bold text-blue-500">{{ $jumlahProduk }}</p>
                        <div class="flex justify-end mt-4">
                            <a href="{{ route('data.produk') }}" class="text-blue-500 hover:text-blue-700 transition duration-300 ease-in-out">Lihat Detail</a>
                        </div>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-lg transition duration-300 ease-in-out">
                    <div class="p-6 text-gray-900">
                        <h3 class="font-bold text-lg">Jumlah Pemesanan</h3>
                        <p class="text-3xl font-bold text-green-500">{{ $jumlahPemesanan }}</p>
                        <div class="flex justify-end mt-4">
                            <a href="{{ route('data.pemesanan') }}" class="text-green-500 hover:text-green-700 transition duration-300 ease-in-out">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
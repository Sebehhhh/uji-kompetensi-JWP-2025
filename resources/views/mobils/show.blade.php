<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Mobil') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-semibold mb-4">{{ $mobil->merek }}</h3>
                            <div class="space-y-3">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">ID</label>
                                    <p class="text-sm text-gray-900">{{ $mobil->id }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Merek</label>
                                    <p class="text-sm text-gray-900">{{ $mobil->merek }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Harga</label>
                                    <p class="text-sm text-gray-900 font-semibold">Rp {{ number_format($mobil->harga, 0, ',', '.') }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Kapasitas Mesin</label>
                                    <p class="text-sm text-gray-900">{{ $mobil->kapasitas_mesin }} cc</p>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h4 class="text-md font-semibold mb-4">Informasi Jenis</h4>
                            <div class="space-y-3">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Jenis Mobil</label>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                                        @if($mobil->jenisMobil->nama_jenis == 'Kapasitas Mesin Besar') bg-red-100 text-red-800
                                        @elseif($mobil->jenisMobil->nama_jenis == 'Kapasitas Mesin Menengah') bg-yellow-100 text-yellow-800
                                        @else bg-green-100 text-green-800 @endif">
                                        {{ $mobil->jenisMobil->nama_jenis }}
                                    </span>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Klasifikasi</label>
                                    <p class="text-sm text-gray-600">{{ $mobil->klasifikasi }}</p>
                                </div>
                            </div>

                            <div class="mt-6 p-4 bg-gray-50 rounded-md">
                                <h5 class="text-sm font-medium text-gray-700 mb-2">Riwayat</h5>
                                <div class="text-xs text-gray-500 space-y-1">
                                    <p>Dibuat: {{ $mobil->created_at->format('d/m/Y H:i') }}</p>
                                    <p>Terakhir diupdate: {{ $mobil->updated_at->format('d/m/Y H:i') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end space-x-2 mt-6">
                        <a href="{{ route('mobils.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Kembali
                        </a>
                        <a href="{{ route('mobils.edit', $mobil) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Edit
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
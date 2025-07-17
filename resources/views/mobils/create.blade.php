<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Mobil') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('mobils.store') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="mb-4">
                                <label for="merek" class="block text-sm font-medium text-gray-700">Merek</label>
                                <input type="text" name="merek" id="merek" value="{{ old('merek') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('merek') border-red-500 @enderror">
                                @error('merek')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="harga" class="block text-sm font-medium text-gray-700">Harga (Rp)</label>
                                <input type="number" name="harga" id="harga" value="{{ old('harga') }}" min="0" step="1000"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('harga') border-red-500 @enderror">
                                @error('harga')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="kapasitas_mesin" class="block text-sm font-medium text-gray-700">Kapasitas Mesin (cc)</label>
                                <input type="number" name="kapasitas_mesin" id="kapasitas_mesin" value="{{ old('kapasitas_mesin') }}" min="1"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('kapasitas_mesin') border-red-500 @enderror">
                                @error('kapasitas_mesin')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Jenis Mobil (Otomatis)</label>
                                <div class="mt-1 p-3 bg-gray-50 rounded-md">
                                    <p class="text-sm text-gray-600">
                                        Jenis mobil akan ditentukan otomatis berdasarkan kapasitas mesin:
                                    </p>
                                    <ul class="text-xs text-gray-500 mt-1">
                                        <li>• < 1500 cc: Kapasitas Mesin Kecil</li>
                                        <li>• 1500-2499 cc: Kapasitas Mesin Menengah</li>
                                        <li>• ≥ 2500 cc: Kapasitas Mesin Besar</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end space-x-2 mt-6">
                            <a href="{{ route('mobils.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Batal
                            </a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
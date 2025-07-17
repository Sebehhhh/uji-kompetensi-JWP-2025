<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Jenis Mobil') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-4">{{ $jenisMobil->nama_jenis }}</h3>
                        <p class="text-gray-600">ID: {{ $jenisMobil->id }}</p>
                        <p class="text-gray-600">Dibuat: {{ $jenisMobil->created_at->format('d/m/Y H:i') }}</p>
                        <p class="text-gray-600">Terakhir diupdate: {{ $jenisMobil->updated_at->format('d/m/Y H:i') }}</p>
                    </div>

                    <div class="mb-6">
                        <h4 class="text-md font-semibold mb-2">Daftar Mobil ({{ $jenisMobil->mobils->count() }})</h4>
                        @if($jenisMobil->mobils->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="min-w-full table-auto">
                                    <thead>
                                        <tr class="bg-gray-50">
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Merek</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Harga</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Kapasitas Mesin</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($jenisMobil->mobils as $mobil)
                                        <tr>
                                            <td class="px-4 py-2 text-sm text-gray-900">{{ $mobil->id }}</td>
                                            <td class="px-4 py-2 text-sm text-gray-900">{{ $mobil->merek }}</td>
                                            <td class="px-4 py-2 text-sm text-gray-900">Rp {{ number_format($mobil->harga, 0, ',', '.') }}</td>
                                            <td class="px-4 py-2 text-sm text-gray-900">{{ $mobil->kapasitas_mesin }} cc</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="text-gray-500">Belum ada mobil untuk jenis ini.</p>
                        @endif
                    </div>

                    <div class="flex justify-end space-x-2">
                        <a href="{{ route('jenis-mobils.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Kembali
                        </a>
                        <a href="{{ route('jenis-mobils.edit', $jenisMobil) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Edit
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
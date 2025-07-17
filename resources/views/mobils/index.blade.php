<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Data Mobil') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold">Daftar Mobil</h3>
                        <div class="flex space-x-2">
                            <a href="{{ route('mobils.export.csv') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                Export CSV
                            </a>
                            <a href="{{ route('mobils.export.txt') }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                                Export TXT
                            </a>
                            <a href="{{ route('mobils.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Tambah Mobil
                            </a>
                        </div>
                    </div>

                    <div class="mb-4">
                        <form method="GET" action="{{ route('mobils.index') }}" class="flex space-x-2">
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari berdasarkan ID atau Merek..."
                                class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <button type="submit" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Cari
                            </button>
                            @if(request('search'))
                                <a href="{{ route('mobils.index') }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                    Reset
                                </a>
                            @endif
                        </form>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto">
                            <thead>
                                <tr class="bg-gray-50">
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Merek</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kapasitas Mesin</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Mobil</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($mobils as $mobil)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $mobil->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $mobil->merek }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Rp {{ number_format($mobil->harga, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $mobil->kapasitas_mesin }} cc</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                            @if($mobil->jenisMobil->nama_jenis == 'Kapasitas Mesin Besar') bg-red-100 text-red-800
                                            @elseif($mobil->jenisMobil->nama_jenis == 'Kapasitas Mesin Menengah') bg-yellow-100 text-yellow-800
                                            @else bg-green-100 text-green-800 @endif">
                                            {{ $mobil->jenisMobil->nama_jenis }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="{{ route('mobils.show', $mobil) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Lihat</a>
                                        <a href="{{ route('mobils.edit', $mobil) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                        <form action="{{ route('mobils.destroy', $mobil) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                        @if(request('search'))
                                            Tidak ada mobil yang ditemukan untuk pencarian "{{ request('search') }}"
                                        @else
                                            Tidak ada data mobil
                                        @endif
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6">
                        {{ $mobils->appends(request()->input())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
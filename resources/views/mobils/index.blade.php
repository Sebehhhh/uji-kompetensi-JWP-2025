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
                            <a href="{{ route('mobils.export.csv') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"></path>
                                </svg>
                                CSV
                            </a>
                            <a href="{{ route('mobils.export.txt') }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"></path>
                                </svg>
                                TXT
                            </a>
                            <a href="{{ route('mobils.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Tambah
                            </a>
                        </div>
                    </div>

                    <div class="mb-6">
                        <form method="GET" action="{{ route('mobils.index') }}" class="space-y-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                                <!-- Search -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Cari Mobil</label>
                                    <input type="text" name="search" value="{{ request('search') }}" placeholder="ID atau Merek..."
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>
                                
                                <!-- Filter by Jenis Mobil -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Mobil</label>
                                    <select name="jenis_mobil_id" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        <option value="">Semua Jenis</option>
                                        @foreach($jenisMobils as $jenis)
                                            <option value="{{ $jenis->id }}" {{ request('jenis_mobil_id') == $jenis->id ? 'selected' : '' }}>
                                                {{ $jenis->nama_jenis }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <!-- Filter by CC -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Filter CC</label>
                                    <select name="cc_filter" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" id="cc-filter">
                                        <option value="">Pilih Filter</option>
                                        <option value="above" {{ request('cc_filter') == 'above' ? 'selected' : '' }}>Di atas</option>
                                        <option value="below" {{ request('cc_filter') == 'below' ? 'selected' : '' }}>Di bawah</option>
                                        <option value="exact" {{ request('cc_filter') == 'exact' ? 'selected' : '' }}>Sama dengan</option>
                                    </select>
                                </div>
                                
                                <!-- Custom CC Value -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Nilai CC</label>
                                    <input type="number" name="custom_cc" value="{{ request('custom_cc') }}" placeholder="Masukkan CC..."
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                        {{ request('cc_filter') ? '' : 'disabled' }}>
                                </div>
                            </div>
                            
                            <div class="flex space-x-2">
                                <button type="submit" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                    Cari
                                </button>
                                @if(request()->hasAny(['search', 'jenis_mobil_id', 'cc_filter', 'custom_cc']))
                                    <a href="{{ route('mobils.index') }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                        </svg>
                                        Reset
                                    </a>
                                @endif
                            </div>
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
                                        <div class="flex space-x-2">
                                            <a href="{{ route('mobils.show', $mobil) }}" class="text-blue-600 hover:text-blue-900" title="Lihat">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                            </a>
                                            <a href="{{ route('mobils.edit', $mobil) }}" class="text-green-600 hover:text-green-900" title="Edit">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                            </a>
                                            <form action="{{ route('mobils.destroy', $mobil) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900" title="Hapus">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ccFilter = document.getElementById('cc-filter');
            const customCC = document.querySelector('input[name="custom_cc"]');
            
            ccFilter.addEventListener('change', function() {
                if (this.value) {
                    customCC.disabled = false;
                    customCC.focus();
                } else {
                    customCC.disabled = true;
                    customCC.value = '';
                }
            });
        });
    </script>
</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Riwayat Permohonan Bantuan Saya') }}
            </h2>
            <a href="{{ route('assistance.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none transition ease-in-out duration-150">
                + Buat Pengajuan Baru
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if($requests->isEmpty())
                    <div class="text-center py-8">
                        <p class="text-gray-500 mb-4">Anda belum pernah mengajukan bantuan.</p>
                        <a href="{{ route('assistance.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md text-sm font-semibold hover:bg-indigo-700">
                            Klik di sini untuk Buat Pengajuan
                        </a>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b bg-gray-50">
                                    <th class="p-3">Judul</th>
                                    <th class="p-3">Kategori</th>
                                    <th class="p-3">Lokasi</th>
                                    <th class="p-3">Status</th>
                                    <th class="p-3">Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($requests as $req)
                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="p-3 font-semibold">{{ $req->title }}</td>
                                        <td class="p-3">{{ $req->category }}</td>
                                        <td class="p-3">{{ $req->location }}</td>
                                        <td class="p-3">
                                            @if($req->status === 'pending')
                                                <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded text-xs font-bold">Menunggu Verifikasi</span>
                                            @elseif($req->status === 'approved')
                                                <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs font-bold">Disetujui Admin</span>
                                            @elseif($req->status === 'completed')
                                                <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs font-bold">Bantuan Selesai</span>
                                            @else
                                                <span class="bg-red-100 text-red-800 px-2 py-1 rounded text-xs font-bold">Ditolak</span>
                                            @endif
                                        </td>
                                        <td class="p-3 text-sm text-gray-500">{{ $req->created_at->format('d M Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
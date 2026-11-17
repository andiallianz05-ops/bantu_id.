<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Admin - Kelola Permohonan Bantuan') }}
        </h2>
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
                    <p class="text-gray-500 text-center py-6">Belum ada pengajuan bantuan masuk.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b bg-gray-100">
                                    <th class="p-3">Pengaju</th>
                                    <th class="p-3">Judul & Kategori</th>
                                    <th class="p-3">Lokasi & Kontak</th>
                                    <th class="p-3">Deskripsi</th>
                                    <th class="p-3">Status</th>
                                    <th class="p-3">Aksi Admin</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($requests as $req)
                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="p-3">
                                            <span class="font-bold block">{{ $req->user->name }}</span>
                                            <span class="text-xs text-gray-500">{{ $req->user->email }}</span>
                                        </td>
                                        <td class="p-3">
                                            <span class="font-semibold block">{{ $req->title }}</span>
                                            <span class="text-xs bg-indigo-100 text-indigo-800 px-2 py-0.5 rounded">{{ $req->category }}</span>
                                        </td>
                                        <td class="p-3 text-sm">
                                            <div>📍 {{ $req->location }}</div>
                                            <div>📞 {{ $req->phone }}</div>
                                        </td>
                                        <td class="p-3 text-sm max-w-xs truncate" title="{{ $req->description }}">
                                            {{ $req->description }}
                                        </td>
                                        <td class="p-3">
                                            @if($req->status === 'pending')
                                                <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded text-xs font-bold">Pending</span>
                                            @elseif($req->status === 'approved')
                                                <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs font-bold">Disetujui</span>
                                            @elseif($req->status === 'completed')
                                                <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs font-bold">Selesai</span>
                                            @else
                                                <span class="bg-red-100 text-red-800 px-2 py-1 rounded text-xs font-bold">Ditolak</span>
                                            @endif
                                        </td>
                                        <td class="p-3">
                                            <form action="{{ route('admin.assistance.updateStatus', $req->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('PATCH')
                                                <select name="status" onchange="this.form.submit()" class="text-xs border-gray-300 rounded shadow-sm py-1">
                                                    <option value="pending" {{ $req->status == 'pending' ? 'selected' : '' }}>Set Pending</option>
                                                    <option value="approved" {{ $req->status == 'approved' ? 'selected' : '' }}>Setujui (Approve)</option>
                                                    <option value="completed" {{ $req->status == 'completed' ? 'selected' : '' }}>Tandai Selesai</option>
                                                    <option value="rejected" {{ $req->status == 'rejected' ? 'selected' : '' }}>Tolak</option>
                                                </select>
                                            </form>
                                        </td>
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
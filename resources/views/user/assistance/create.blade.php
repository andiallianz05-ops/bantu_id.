<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Form Pengajuan Butuh Bantuan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('assistance.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-gray-700 font-medium">Judul Bantuan / Nama Penerima</label>
                        <input type="text" name="title" required class="w-full border-gray-300 rounded-md shadow-sm mt-1" placeholder="Contoh: Bantuan Sembako Keluarga Pra-Sejahtera">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-700 font-medium">Kategori Bantuan</label>
                            <select name="category" required class="w-full border-gray-300 rounded-md shadow-sm mt-1">
                                <option value="">-- Pilih Kategori --</option>
                                <option value="Sembako">Sembako / Makanan</option>
                                <option value="Kesehatan">Kesehatan / Medis</option>
                                <option value="Pendidikan">Pendidikan</option>
                                <option value="Bencana Alam">Bencana Alam</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium">No. WhatsApp / HP</label>
                            <input type="text" name="phone" required class="w-full border-gray-300 rounded-md shadow-sm mt-1" placeholder="081234567890">
                        </div>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium">Lokasi / Alamat Lengkap</label>
                        <input type="text" name="location" required class="w-full border-gray-300 rounded-md shadow-sm mt-1" placeholder="Jl. Raya No. 123, Kel. Merdeka">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium">Detail Cerita & Kebutuhan</label>
                        <textarea name="description" rows="4" required class="w-full border-gray-300 rounded-md shadow-sm mt-1" placeholder="Jelaskan kondisi dan bantuan spesifik yang dibutuhkan..."></textarea>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium">Foto / Bukti Pendukung (Opsional)</label>
                        <input type="file" name="image" class="w-full border-gray-300 rounded-md shadow-sm mt-1">
                    </div>

                    <div class="pt-4 flex justify-end gap-2">
                        <a href="{{ route('assistance.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-md">Batal</a>
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Kirim Pengajuan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
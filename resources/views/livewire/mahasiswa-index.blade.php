<div class="p-6">
    <h2 class="text-xl font-bold mb-4">
        {{ $updateMode ? 'Edit Mahasiswa' : 'Tambah Mahasiswa' }}
    </h2>

    @if (session()->has('success'))
        <div class="bg-green-100 text-green-700 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="bg-red-100 text-red-700 p-2 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <form wire:submit.prevent="save" wire:key="{{ $formKey }}" class="mb-6 flex flex-wrap gap-3">
        <input wire:model="nim" type="text" placeholder="NIM" class="border p-2 rounded w-full md:w-1/4">
        <input wire:model="nama" type="text" placeholder="Nama" class="border p-2 rounded w-full md:w-1/4">
        <input wire:model="semester" type="number" placeholder="Semester" class="border p-2 rounded w-full md:w-1/4">

<select wire:model="prodi_id" class="border p-2 rounded w-full md:w-1/4">
    <option value="">Pilih Prodi</option>
    @foreach($prodis as $prodi)
        <option value="{{ $prodi->id }}">{{ $prodi->nama }}</option>
    @endforeach
</select>
        <div class="flex gap-2 items-center">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                {{ $updateMode ? 'Update' : 'Tambah' }}
            </button>
            @if ($updateMode)
                <button type="button" wire:click="cancelEdit" class="bg-gray-500 text-white px-4 py-2 rounded">
                    Batal
                </button>
            @endif
        </div>
    </form>

    <table class="w-full table-auto border-collapse">
        <thead>
            <tr class="bg-gray-200 text-left">
                <th class="border px-3 py-2">#</th>
                <th class="border px-3 py-2">NIM</th>
                <th class="border px-3 py-2">Nama</th>
                <th class="border px-3 py-2">Semester</th>
                <th class="border px-3 py-2">Prodi</th>
                <th class="border px-3 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($mahasiswas as $index => $m)
                <tr>
                    <td class="border px-3 py-2">{{ $index + 1 }}</td>
                    <td class="border px-3 py-2">{{ $m->nim }}</td>
                    <td class="border px-3 py-2">{{ $m->nama }}</td>
                    <td class="border px-3 py-2">{{ $m->semester }}</td>
                    <td class="border px-3 py-2">{{ $m->prodi?->nama }}</td>
                    <td class="border px-3 py-2">
                        <button wire:click="edit({{ $m->id }})" class="text-blue-600 mr-2">Edit</button>
                        <button onclick="confirm('Yakin ingin menghapus data ini?') || event.stopImmediatePropagation()" wire:click="delete({{ $m->id }})" class="text-red-600">
                            Hapus
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center py-4">Belum ada data mahasiswa.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

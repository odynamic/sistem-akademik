<div class="p-6 space-y-6">
    <h2 class="text-xl font-bold mb-4">
        {{ $editMode ? 'Edit Mata Kuliah' : 'Tambah Mata Kuliah' }}
    </h2>

    @if (session()->has('success'))
        <div class="bg-green-100 text-green-700 p-2 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit.prevent="{{ $editMode ? 'update' : 'store' }}" wire:key="{{ $formKey }}" class="mb-6 flex flex-wrap gap-3">
        <input wire:model="kode" type="text" placeholder="Kode" class="border p-2 rounded w-full md:w-1/6" required>
        <input wire:model="nama" type="text" placeholder="Nama Mata Kuliah" class="border p-2 rounded w-full md:w-1/3" required>
        <input wire:model="sks" type="number" placeholder="SKS" class="border p-2 rounded w-full md:w-1/6" required>

        <select wire:model="prodi_id" class="border p-2 rounded w-full md:w-1/3 text-black" required>
            <option value="">Pilih Prodi</option>
            @foreach($prodis as $p)
                <option value="{{ $p->id }}">{{ $p->nama }}</option>
            @endforeach
        </select>

        <div class="flex gap-2 items-center w-full">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                {{ $editMode ? 'Update' : 'Tambah' }}
            </button>
            @if ($editMode)
                <button type="button" wire:click="resetForm" class="bg-gray-500 text-white px-4 py-2 rounded">
                    Batal
                </button>
            @endif
        </div>
    </form>

    <table class="w-full table-auto border-collapse">
        <thead>
            <tr class="bg-gray-200 text-left">
                <th class="border px-3 py-2">#</th>
                <th class="border px-3 py-2">Kode</th>
                <th class="border px-3 py-2">Nama</th>
                <th class="border px-3 py-2">SKS</th>
                <th class="border px-3 py-2">Prodi</th>
                <th class="border px-3 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($matakuliahs as $index => $m)
                <tr>
                    <td class="border px-3 py-2">{{ $index + 1 }}</td>
                    <td class="border px-3 py-2">{{ $m->kode }}</td>
                    <td class="border px-3 py-2">{{ $m->nama }}</td>
                    <td class="border px-3 py-2">{{ $m->sks }}</td>
                    <td class="border px-3 py-2">{{ $m->prodi->nama ?? '-' }}</td>
                    <td class="border px-3 py-2">
                        <button wire:click="edit({{ $m->id }})" class="text-blue-600 mr-2">Edit</button>
                        <button 
                            onclick="confirm('Yakin ingin menghapus matakuliah ini?') || event.stopImmediatePropagation()" 
                            wire:click="delete({{ $m->id }})"
                            class="text-red-600"
                        >
                            Hapus
                        </button>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center py-4">Belum ada data.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

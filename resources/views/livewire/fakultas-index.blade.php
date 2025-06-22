<div class="p-6">
    <h2 class="text-xl font-bold mb-4">
        {{ $editMode ? 'Edit Fakultas' : 'Tambah Fakultas' }}
    </h2>

    @if (session()->has('success'))
        <div class="bg-green-100 text-green-700 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit.prevent="{{ $editMode ? 'update' : 'store' }}" wire:key="{{ $formKey }}" class="mb-6 flex flex-wrap gap-3">
        <input wire:model="nama" type="text" placeholder="Nama Fakultas" class="border p-2 rounded w-full md:w-1/3" required>

        <div class="flex gap-2 items-center">
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
                <th class="border px-3 py-2">Nama Fakultas</th>
                <th class="border px-3 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($fakultasList as $index => $f)
                <tr>
                    <td class="border px-3 py-2">{{ $index + 1 }}</td>
                    <td class="border px-3 py-2">{{ $f->nama }}</td>
                    <td class="border px-3 py-2">
                        <button wire:click="edit({{ $f->id }})" class="text-blue-600 mr-2">Edit</button>
                        <button wire:click="delete({{ $f->id }})" 
                            onclick="return confirm('Yakin ingin menghapus fakultas ini?')" 
                            class="text-red-600"> Hapus
                        </button>

                    </td>
                </tr>
            @empty
                <tr><td colspan="3" class="text-center py-4">Belum ada data.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

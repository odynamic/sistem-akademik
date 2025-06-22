<div class="p-6">
    <h2 class="text-xl font-bold mb-4">
        {{ $updateMode ? 'Edit Prodi' : 'Tambah Prodi' }}
    </h2>

    @if (session()->has('success'))
        <div class="bg-green-100 text-green-700 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit.prevent="save" wire:key="{{ $formKey }}" class="mb-6 flex flex-wrap gap-3">
        <input wire:model="nama" type="text" placeholder="Nama Prodi" class="border p-2 rounded w-full md:w-1/3">
        
        <select wire:model="fakultas_id" class="border p-2 rounded w-full md:w-1/3 text-black">
            <option value="">Pilih Fakultas</option>
            @foreach($fakultasList as $f)
                <option value="{{ $f->id }}">{{ $f->nama }}</option>
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
                <th class="border px-3 py-2">Nama Prodi</th>
                <th class="border px-3 py-2">Fakultas</th>
                <th class="border px-3 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($prodis as $index => $p)
                <tr>
                    <td class="border px-3 py-2">{{ $index + 1 }}</td>
                    <td class="border px-3 py-2">{{ $p->nama }}</td>
                    <td class="border px-3 py-2">{{ $p->fakultas->nama ?? '-' }}</td>
                    <td class="border px-3 py-2">
                        <button wire:click="edit({{ $p->id }})" class="text-blue-600 mr-2">Edit</button>
                        <button onclick="confirm('Yakin ingin menghapus data ini?') || event.stopImmediatePropagation()" wire:click="delete({{ $p->id }})" class="text-red-600">
                            Hapus
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center py-4">Belum ada data prodi.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

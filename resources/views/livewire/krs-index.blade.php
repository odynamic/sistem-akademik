<div class="p-6 space-y-6"> <h2 class="text-2xl font-bold text-gray-800">Manajemen KRS</h2>
{{-- Alert messages --}}
@if (session()->has('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded">
        {{ session('success') }}
    </div>
@endif

@if (session()->has('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded">
        {{ session('error') }}
    </div>
@endif

{{-- Pilih Mahasiswa --}}
<div>
    <label class="block text-sm font-semibold mb-1 text-gray-700">Pilih Mahasiswa:</label>
    <select wire:model.lazy="mahasiswa_id" class="w-full md:w-1/2 border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-400">
        <option value="">Pilih Mahasiswa</option>
        @foreach($mahasiswas as $m)
            <option value="{{ $m->id }}">{{ $m->nama }} ({{ $m->nim }})</option>
        @endforeach
    </select>
</div>

@if ($mahasiswa_id)
    {{-- Pilih Matakuliah --}}
    <form wire:submit.prevent="save" wire:key="{{ $formKey }}" class="space-y-4">
        <div>
            <h3 class="text-lg font-semibold text-gray-800">Pilih Matakuliah:</h3>
            <div class="grid md:grid-cols-2 gap-3 mt-2">
                @foreach($matakuliahs as $mk)
                    <label class="flex items-center space-x-2 text-gray-700">
                        <input type="checkbox" value="{{ $mk->id }}" wire:model="selectedMatakuliahs" class="form-checkbox h-4 w-4 text-blue-600">
                        <span>{{ $mk->nama }} ({{ $mk->kode }}) - {{ $mk->sks }} SKS</span>
                    </label>
                @endforeach
            </div>
        </div>

<button type="submit"
    class="mt-4 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
    Simpan KRS
</button>
    </form>

    {{-- Daftar Matakuliah yang Diambil --}}
    @if ($krsList->count())
        <div class="mt-8">
            <h3 class="text-lg font-semibold mb-3 text-gray-800">Daftar Matakuliah yang Diambil:</h3>
            <table class="min-w-full border border-gray-300 text-left text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border">Matakuliah</th>
                        <th class="px-4 py-2 border">SKS</th>
                        <th class="px-4 py-2 border">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($krsList as $item)
                        <tr class="border-t">
                            <td class="px-4 py-2 border">{{ $item->nama }} ({{ $item->kode }})</td>
                            <td class="px-4 py-2 border">{{ $item->sks }}</td>
                            <td class="px-4 py-2 border">
                                <button wire:click="deleteKrs({{ $item->id }})"
                                        onclick="confirm('Yakin ingin menghapus matakuliah ini dari KRS?') || event.stopImmediatePropagation()"
                                        class="text-red-600 hover:underline text-sm">
                                    Hapus
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    <tr class="bg-gray-50 font-semibold">
                        <td class="px-4 py-2 border text-right" colspan="1">Total SKS:</td>
                        <td class="px-4 py-2 border">{{ $krsList->sum('sks') }}</td>
                        <td class="border"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    @endif
@endif
</div>

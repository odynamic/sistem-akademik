<div class="p-6 space-y-6">
    <h2 class="text-2xl font-bold text-gray-800">Rekap Mahasiswa & Total SKS</h2>

    {{-- Filter --}}
    <div class="flex flex-wrap gap-4 items-end">
        <div>
            <label class="block text-sm font-semibold mb-1 text-gray-700">Filter Fakultas:</label>
            <select wire:model="filterFakultas" wire:key="fakultas-{{ $filterFakultas }}" class="border border-gray-300 rounded px-3 py-2 w-full">
                <option value="">Semua Fakultas</option>
                @foreach ($fakultasList as $f)
                    <option value="{{ $f->id }}">{{ $f->nama }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-semibold mb-1 text-gray-700">Filter Semester:</label>
            <select wire:model="filterSemester" wire:key="semester-{{ $filterSemester }}" class="border border-gray-300 rounded px-3 py-2 w-full">
                <option value="">-- Semua Semester --</option>
                @for ($i = 1; $i <= 8; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>

        <div class="mt-6 flex gap-2">
            <button wire:click="applyFilter" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Terapkan Filter
            </button>
            <button wire:click="resetFilter" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                Reset Filter
            </button>
        </div>
    </div>

    {{-- Tabel Data --}}
    <div class="overflow-x-auto mt-6">
        <table class="w-full table-auto border-collapse border border-gray-300 text-sm text-left">
            <thead class="bg-gray-100 font-semibold">
                <tr>
                    <th class="border px-4 py-2">Nama</th>
                    <th class="border px-4 py-2">NIM</th>
                    <th class="border px-4 py-2">Prodi</th>
                    <th class="border px-4 py-2">Fakultas</th>
                    <th class="border px-4 py-2">Semester</th>
                    <th class="border px-4 py-2">Total SKS</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($mahasiswas as $mhs)
                    <tr class="border-t">
                        <td class="border px-4 py-2">{{ $mhs->nama }}</td>
                        <td class="border px-4 py-2">{{ $mhs->nim }}</td>
                        <td class="border px-4 py-2">{{ $mhs->prodi->nama ?? '-' }}</td>
                        <td class="border px-4 py-2">{{ $mhs->prodi->fakultas->nama ?? '-' }}</td>
                        <td class="border px-4 py-2">{{ $mhs->semester }}</td>
                        <td class="border px-4 py-2">{{ $mhs->total_sks }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">Tidak ada data mahasiswa.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

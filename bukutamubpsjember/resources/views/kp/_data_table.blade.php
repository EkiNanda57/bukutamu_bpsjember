<div class="overflow-x-auto bg-white rounded-lg shadow">
    <table class="min-w-full text-sm text-left border border-gray-200">
        <thead class="bg-blue-600 text-white">
            <tr>
                <th class="px-4 py-2">No</th>
                <th class="px-4 py-2">Email</th>
                <th class="px-4 py-2">Kepuasan</th>
                <th class="px-4 py-2">Tahun</th>
                <th class="px-4 py-2">Bulan</th>
                <th class="px-4 py-2">Hari</th>
                <th class="px-4 py-2">Waktu</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $i => $kp)
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-4 py-2">{{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}</td>
                    <td class="px-4 py-2">{{ $kp->email }}</td>
                    <td class="px-4 py-2">{{ $kp->kepuasan }}</td>
                    <td class="px-4 py-2">{{ $kp->tahun }}</td>
                    <td class="px-4 py-2">{{ $kp->bulan }}</td>
                    <td class="px-4 py-2">{{ $kp->hari }}</td>
                    <td class="px-4 py-2">{{ $kp->waktu }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="px-4 py-2 text-center text-gray-500">Tidak ada data untuk filter yang dipilih.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $data->links() }}
</div>

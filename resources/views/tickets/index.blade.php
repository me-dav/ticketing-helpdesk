<x-app-layout>
    <div class="py-6 max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold">Tiket Saya</h2>
            <a href="{{ route('tickets.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">+ Buat Tiket</a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-2 rounded mb-4">{{ session('success') }}</div>
        @endif

        <table class="w-full bg-white shadow rounded">
            <thead>
                <tr class="border-b">
                    <th class="p-2 text-left">Judul</th>
                    <th class="p-2 text-left">Kategori</th>
                    <th class="p-2 text-left">Status</th>
                    <th class="p-2 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tickets as $ticket)
                    <tr class="border-b">
                        <td class="p-2">{{ $ticket->title }}</td>
                        <td class="p-2">{{ $ticket->category }}</td>
                        <td class="p-2">
                            <span class="px-2 py-1 rounded text-xs
                                    @if($ticket->status == 'open') bg-red-100 text-red-700
                                    @elseif($ticket->status == 'in_progress') bg-yellow-100 text-yellow-700
                                    @else bg-green-100 text-green-700 @endif">
                                {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}
                            </span>
                        </td>
                        <td class="p-2">
                            <a href="{{ route('tickets.show', $ticket) }}" class="text-blue-600">Detail</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="p-4 text-center text-gray-500">Belum ada tiket</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
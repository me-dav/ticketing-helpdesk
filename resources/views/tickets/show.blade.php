<x-app-layout>
    <div class="py-6 max-w-xl mx-auto">
        <a href="{{ route('dashboard') }}" class="inline-flex items-center text-blue-600 hover:underline mb-4 text-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali ke Dashboard
        </a>

        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-xl font-semibold mb-2">{{ $ticket->title }}</h2>
            <p class="text-sm text-gray-500 mb-4">Kategori: {{ $ticket->category }} | Status:
                {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}</p>
            <p class="mb-4">{{ $ticket->description }}</p>

            @if ($ticket->admin_note)
                <div class="bg-gray-100 p-3 rounded">
                    <strong>Catatan Admin:</strong>
                    <p>{{ $ticket->admin_note }}</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
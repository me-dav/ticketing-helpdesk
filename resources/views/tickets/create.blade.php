<x-app-layout>
    <div class="py-6 max-w-xl mx-auto">
        <h2 class="text-xl font-semibold mb-4">Buat Tiket Baru</h2>

        <form action="{{ route('tickets.store') }}" method="POST" class="bg-white p-6 rounded shadow space-y-4">
            @csrf

            <div>
                <label class="block mb-1">Judul</label>
                <input type="text" name="title" class="w-full border rounded p-2" value="{{ old('title') }}">
                @error('title')
                <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block mb-1">Kategori</label>
                <select name="category" class="w-full border rounded p-2">
                    <option value="Hardware">Hardware</option>
                    <option value="Software">Software</option>
                    <option value="Jaringan">Jaringan</option>
                </select>
            </div>

            <div>
                <label class="block mb-1">Deskripsi</label>
                <textarea name="description" rows="4"
                    class="w-full border rounded p-2">{{ old('description') }}</textarea>
                @error('description')
                <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Kirim Tiket</button>
        </form>
    </div>
</x-app-layout>
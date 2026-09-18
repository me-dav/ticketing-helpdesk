<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Ticket Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Filter Section -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="GET" action="{{ route('admin.tickets.index') }}" class="flex space-x-4 items-end">
                        <div>
                            <x-input-label for="status" :value="__('Status')" />
                            <select id="status" name="status" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full">
                                <option value="">All</option>
                                <option value="open" {{ request('status') === 'open' ? 'selected' : '' }}>Open</option>
                                <option value="in_progress" {{ request('status') === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="closed" {{ request('status') === 'closed' ? 'selected' : '' }}>Closed</option>
                            </select>
                        </div>
                        <div>
                            <x-input-label for="category" :value="__('Category')" />
                            <select id="category" name="category" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full">
                                <option value="">All</option>
                                <option value="Hardware" {{ request('category') === 'Hardware' ? 'selected' : '' }}>Hardware</option>
                                <option value="Software" {{ request('category') === 'Software' ? 'selected' : '' }}>Software</option>
                                <option value="Jaringan" {{ request('category') === 'Jaringan' ? 'selected' : '' }}>Jaringan</option>
                            </select>
                        </div>
                        <div>
                            <x-primary-button>
                                {{ __('Filter') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Table Section -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if(session('success'))
                        <div class="mb-4 text-green-600">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">ID</th>
                                <th scope="col" class="px-6 py-3">Title</th>
                                <th scope="col" class="px-6 py-3">User</th>
                                <th scope="col" class="px-6 py-3">Category</th>
                                <th scope="col" class="px-6 py-3">Status</th>
                                <th scope="col" class="px-6 py-3">Action</th>
                            </tr>
                        </thead>
                        
                        @forelse($tickets as $ticket)
                        <tbody x-data="{ open: false }">
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $ticket->id }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $ticket->title }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ optional($ticket->user)->name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $ticket->category }}
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 rounded text-xs text-white {{ $ticket->status === 'open' ? 'bg-red-500' : ($ticket->status === 'in_progress' ? 'bg-yellow-500' : 'bg-green-500') }}">
                                        {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <button @click="open = !open" class="text-indigo-600 dark:text-indigo-400 hover:underline">Update</button>
                                </td>
                            </tr>
                            <tr class="bg-gray-50 dark:bg-gray-700" x-show="open" style="display: none;">
                                <td colspan="6" class="px-6 py-4">
                                    <form method="POST" action="{{ route('admin.tickets.update', $ticket) }}">
                                        @csrf
                                        @method('PATCH')
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div>
                                                <x-input-label for="status_{{ $ticket->id }}" :value="__('Update Status')" />
                                                <select id="status_{{ $ticket->id }}" name="status" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full">
                                                    <option value="open" {{ $ticket->status === 'open' ? 'selected' : '' }}>Open</option>
                                                    <option value="in_progress" {{ $ticket->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                                    <option value="closed" {{ $ticket->status === 'closed' ? 'selected' : '' }}>Closed</option>
                                                </select>
                                            </div>
                                            <div>
                                                <x-input-label for="admin_note_{{ $ticket->id }}" :value="__('Admin Note')" />
                                                <x-text-input id="admin_note_{{ $ticket->id }}" class="block mt-1 w-full" type="text" name="admin_note" :value="old('admin_note', $ticket->admin_note)" />
                                            </div>
                                        </div>
                                        <div class="mt-4">
                                            <x-primary-button>{{ __('Save Changes') }}</x-primary-button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                        @empty
                        <tbody>
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center">No tickets found.</td>
                            </tr>
                        </tbody>
                        @endforelse
                    </table>

                    <div class="mt-4">
                        {{ $tickets->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

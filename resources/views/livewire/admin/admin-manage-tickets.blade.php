<div class="container mx-auto p-6">
    <h2 class="text-2xl font-semibold mb-4">All Support Tickets</h2>

    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-200 shadow-md rounded-lg">
            <thead>
                <tr class="bg-blue-500 text-white">
                    <th class="py-3 px-6 text-left">ID</th>
                    <th class="py-3 px-6 text-left">Subject</th>
                    <th class="py-3 px-6 text-left">Status</th>
                    <th class="py-3 px-6 text-left">Created At</th>
                    <th class="py-3 px-6 text-left">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($tickets as $ticket)
                    <tr class="hover:bg-gray-100">
                        <td class="py-3 px-6">{{ $ticket->id }}</td>
                        <td class="py-3 px-6">{{ $ticket->support_ticket_subject->ticket_subject ?? 'N/A' }}</td>
                        <td class="py-3 px-6">
                            <span
                                class="px-3 py-1 rounded-full text-sm font-medium 
                                {{ $ticket->status == 'open' ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                                {{ ucfirst($ticket->status) }}
                            </span>
                        </td>
                        <td class="py-3 px-6">{{ $ticket->created_at->format('d M Y') }}</td>
                        <td class="py-3 px-6">
                            <a href="{{ route('admin.view.ticket', $ticket->id) }}" wire:navigate
                                class="text-blue-500 hover:text-blue-700 font-semibold">
                                View
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

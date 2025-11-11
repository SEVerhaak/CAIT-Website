<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Confirm Delete Event') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 dark:text-white shadow-sm sm:rounded-lg p-6">

                <p class="mb-4">You are about to delete the following event. This action <strong>cannot be undone</strong>.</p>

                {{-- Event Summary --}}
                <div class="mb-6 space-y-2">
                    <p><strong>Name:</strong> {{ $event->name }}</p>
                    <p><strong>Description:</strong> {{ $event->description ?? 'No description' }}</p>
                    <p><strong>Begin:</strong> {{ \Carbon\Carbon::parse($event->begin_time)->format('d M Y H:i') }}</p>
                    <p><strong>End:</strong> {{ \Carbon\Carbon::parse($event->end_time)->format('d M Y H:i') }}</p>
                    <p><strong>Limit:</strong> {{ $event->limit ? 'Yes' : 'No' }} @if($event->limit)(Max: {{ $event->max_people }})@endif</p>
                    <p><strong>Requires Payment:</strong> {{ $event->requires_payment ? 'Yes' : 'No' }}</p>
                    <p><strong>Requires Membership:</strong> {{ $event->requires_membership ? 'Yes' : 'No' }}</p>
                    <p><strong>Send Mail:</strong> {{ $event->send_mail ? 'Yes' : 'No' }}</p>
                    <p><strong>Active:</strong> {{ $event->active ? 'Yes' : 'No' }}</p>

                    @if($event->img)
                        <img src="{{ asset('storage/' . $event->img) }}" alt="{{ $event->name }}" class="w-full h-48 object-cover rounded-md mt-2">
                    @endif
                </div>

                {{-- Action Buttons --}}
                <div class="flex space-x-3">
                    <a href="{{ route('events.index') }}"
                       class="px-4 py-2 bg-gray-300 dark:bg-gray-700 dark:text-white text-gray-800 rounded hover:bg-gray-400 dark:hover:bg-gray-600 transition">
                        Cancel
                    </a>

                    <form action="{{ route('events.destroy', $event) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this event?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition">
                            Delete Event
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>

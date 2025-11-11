<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $event->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 dark:text-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                {{-- Event Image --}}
                @if($event->img)
                    <img src="{{ asset('storage/' . $event->img) }}" alt="{{ $event->name }}" class="w-full h-64 object-cover rounded-md mb-6">
                @else
                    <div class="w-full h-64 bg-gray-200 dark:bg-gray-700 flex items-center justify-center rounded-md mb-6 text-gray-500">
                        No Image
                    </div>
                @endif

                {{-- Event Details --}}
                <div class="space-y-3">
                    <p><strong>Description:</strong> {{ $event->description ?? 'No description' }}</p>
                    <p><strong>Begin Time:</strong> {{ \Carbon\Carbon::parse($event->begin_time)->format('d M Y H:i') }}</p>
                    <p><strong>End Time:</strong> {{ \Carbon\Carbon::parse($event->end_time)->format('d M Y H:i') }}</p>
                    <p><strong>Limit:</strong> {{ $event->limit ? 'Yes' : 'No' }}
                        @if($event->limit)
                            (Max: {{ $event->max_people }})
                        @endif
                    </p>
                    <p><strong>Requires Payment:</strong> {{ $event->requires_payment ? 'Yes' : 'No' }}</p>
                    <p><strong>Requires Membership:</strong> {{ $event->requires_membership ? 'Yes' : 'No' }}</p>
                    @if(auth()->check() && in_array(auth()->user()->role, ['admin', 'bestuur']))
                        <p><strong>Send Mail:</strong> {{ $event->send_mail ? 'Yes' : 'No' }}</p>
                        <p><strong>Active:</strong> {{ $event->active ? 'Yes' : 'No' }}</p>
                    @endif
                </div>

                {{-- Action Buttons --}}
                <div class="mt-6 flex space-x-3">
                    <a href="{{ route('events.index') }}"
                       class="px-4 py-2 bg-gray-300 dark:bg-gray-700 dark:text-white text-gray-800 rounded hover:bg-gray-400 dark:hover:bg-gray-600 transition">
                        Back
                    </a>

                    @if(auth()->check() && in_array(auth()->user()->role, ['admin', 'bestuur']))
                        <a href="{{ route('events.edit', $event) }}"
                           class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                            Edit
                        </a>
                    @endif
                </div>

            </div>
        </div>
    </div>
</x-app-layout>

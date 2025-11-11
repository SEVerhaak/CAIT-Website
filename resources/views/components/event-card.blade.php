<div
    class="bg-primary dark:bg-primary-dark shadow-sm rounded-lg p-4 flex flex-col hover:shadow-lg transition-shadow duration-200">

    {{-- Event Image --}}
    @if($event->img)
        <img src="{{ asset('storage/' . $event->img) }}" alt="{{ $event->name }}"
             class="w-full h-48 object-cover rounded-md mb-4">
    @else
        <div
            class="w-full h-48 bg-gray-200 dark:bg-gray-700 flex items-center justify-center rounded-md mb-4 text-gray-500">
            No Image
        </div>
    @endif

    {{-- Event Info --}}
    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-2">{{ $event->name }}</h3>
    <p class="text-gray-600 dark:text-gray-300 mb-2">{{ $event->description ?? 'No description' }}</p>

    <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">
        <strong>Begin:</strong> {{ \Carbon\Carbon::parse($event->begin_time)->format('d M Y H:i') }}
    </p>
    <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">
        <strong>End:</strong> {{ \Carbon\Carbon::parse($event->end_time)->format('d M Y H:i') }}
    </p>

    <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">
        <strong>Limit:</strong> {{ $event->limit ? 'Yes' : 'No' }}
        @if($event->limit)
            (Max: {{ $event->max_people }})
        @endif
    </p>

    <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">
        <strong>Requires Payment:</strong> {{ $event->requires_payment ? 'Yes' : 'No' }}
    </p>

    <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">
        <strong>Requires Membership:</strong> {{ $event->requires_membership ? 'Yes' : 'No' }}
    </p>

    @if(auth()->check() && in_array(auth()->user()->role, ['admin', 'bestuur']))
        <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">
            <strong>Send Mail:</strong> {{ $event->send_mail ? 'Yes' : 'No' }}
        </p>

        <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">
            <strong>Active:</strong> {{ $event->active ? 'Yes' : 'No' }}
        </p>
    @endif

    <div class="flex space-x-2">
        <div class="mt-4">
            <a href="{{ route('events.show', $event) }}"
               class="inline-block px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded hover:bg-blue-700 transition">
                View
            </a>
        </div>

        @if(auth()->check() && in_array(auth()->user()->role, ['admin', 'bestuur']))
            <div class="mt-4">
                <a href="{{ route('events.edit', $event) }}"
                   class="inline-block px-4 py-2 bg-yellow-600 text-white text-sm font-medium rounded hover:bg-yellow-700 transition">
                    Edit
                </a>
            </div>

            <div class="mt-4">
                <a href="{{ route('events.confirmDelete', $event) }}"
                   class="inline-block px-4 py-2 bg-red-600 text-white text-sm font-medium rounded hover:bg-red-700 transition">
                    Delete
                </a>
            </div>
        @endif
    </div>
</div>

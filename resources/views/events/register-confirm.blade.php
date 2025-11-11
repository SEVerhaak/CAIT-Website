<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Confirm Registration
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-primary dark:bg-primary-dark dark:text-white shadow-sm sm:rounded-lg p-6">
                {{-- Error Messages --}}
                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 dark:bg-red-800 text-red-800 dark:text-red-200 rounded">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <h3 class="text-lg font-semibold mb-4">{{ $event->name }}</h3>
                <p class="mb-2">{{ $event->description ?? 'No description available.' }}</p>
                <p class="mb-2"><strong>Begin:</strong> {{ \Carbon\Carbon::parse($event->begin_time)->format('d M Y H:i') }}</p>
                <p class="mb-2"><strong>End:</strong> {{ \Carbon\Carbon::parse($event->end_time)->format('d M Y H:i') }}</p>
                @if($event->limit)
                    <p class="mb-2"><strong>Max People:</strong> {{ $event->max_people }}</p>
                    <p class="mb-4"><strong>Registered:</strong> {{ $event->users()->count() }}</p>
                @endif

                <div class="flex space-x-4">
                    <a href="{{ route('events.show', $event) }}"
                       class="px-4 py-2 bg-gray-300 dark:bg-gray-700 dark:text-white text-gray-800 rounded hover:bg-gray-400 dark:hover:bg-gray-600 transition">
                        Cancel
                    </a>

                    <form method="POST" action="{{ route('events.register', $event) }}">
                        @csrf
                        <button type="submit"
                                class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
                            Confirm Registration
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>

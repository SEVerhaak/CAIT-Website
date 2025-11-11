<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('All Events') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(auth()->check() && in_array(auth()->user()->role, ['admin', 'bestuur']))
                <div class="mb-8 flex justify-end">
                    <a href="{{ route('events.create') }}"
                       class="inline-block px-4 py-2 bg-green-600 text-white text-sm font-medium rounded hover:bg-green-700 transition">
                        Create new event
                    </a>
                </div>
            @endif
            {{-- Per page selector --}}
            <form method="GET" class="mb-4 flex items-center space-x-2">
                <label for="per_page" class="text-gray-700 dark:text-gray-300">Events per page:</label>
                <select name="per_page" id="per_page"
                        class="rounded-md border-gray-300 dark:bg-gray-700 dark:text-gray-200"
                        onchange="this.form.submit()">
                    <option value="5" {{ $perPage == 5 ? 'selected' : '' }}>5</option>
                    <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                    <option value="20" {{ $perPage == 20 ? 'selected' : '' }}>20</option>
                </select>
            </form>

            @if($events->isEmpty())
                <p class="text-gray-700 dark:text-gray-300">No events found.</p>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach($events as $event)
                        <x-event-card :event="$event"/>
                    @endforeach
                </div>

                {{-- Pagination --}}
                <div class="mt-6">
                    {{ $events->links() }}
                </div>
            @endif

        </div>
    </div>
</x-app-layout>

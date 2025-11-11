<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Event') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-primary dark:bg-primary-dark dark:text-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if (session('success'))
                    <div class="mb-4 p-4 bg-green-100 dark:bg-green-800 text-green-800 dark:text-green-200 rounded">
                        {{ session('success') }}
                        <a href="{{ route('events.index') }}"
                           class="ml-2 underline font-medium hover:text-green-600 dark:hover:text-green-400">
                            Back to all events
                        </a>
                    </div>
                @endif


                <form method="POST" action="{{ route('events.update', $event) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                        <input type="text" name="name" value="{{ old('name', $event->name) }}"
                               class="w-full rounded-md border-gray-300 dark:bg-gray-700" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                        <textarea name="description" rows="4"
                                  class="w-full rounded-md border-gray-300 dark:bg-gray-700">{{ old('description', $event->description) }}</textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Begin Time</label>
                            <input type="datetime-local" name="begin_time"
                                   value="{{ old('begin_time', \Carbon\Carbon::parse($event->begin_time)->format('Y-m-d\TH:i')) }}"
                                   class="w-full rounded-md border-gray-300 dark:bg-gray-700" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">End Time</label>
                            <input type="datetime-local" name="end_time"
                                   value="{{ old('end_time', \Carbon\Carbon::parse($event->end_time)->format('Y-m-d\TH:i')) }}"
                                   class="w-full rounded-md border-gray-300 dark:bg-gray-700" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Max People</label>
                            <input type="number" name="max_people" id="max_people"
                                   value="{{ old('max_people', $event->max_people) }}"
                                   class="w-full rounded-md border-gray-300 dark:bg-gray-700 disabled:cursor-not-allowed disabled:bg-gray-200 dark:disabled:bg-gray-600 disabled:text-gray-500 p-2" {{ $event->limit ? '' : 'disabled' }}>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Image</label>
                            <input type="file" name="img" class="w-full rounded-md border-gray-300 dark:bg-gray-700">
                            @if($event->img)
                                <img src="{{ asset('storage/' . $event->img) }}" alt="Event Image"
                                     class="mt-2 w-48 h-32 object-cover rounded-md">
                            @endif
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-4 mb-4">
                        <label class="flex items-center"><input type="checkbox" name="limit"
                                                                value="1" {{ old('limit', $event->limit) ? 'checked' : '' }}>
                            <span class="ml-2">Limit</span></label>
                        <label class="flex items-center"><input type="checkbox" name="requires_payment"
                                                                value="1" {{ old('requires_payment', $event->requires_payment) ? 'checked' : '' }}>
                            <span class="ml-2">Requires Payment</span></label>
                        <label class="flex items-center"><input type="checkbox" name="requires_membership"
                                                                value="1" {{ old('requires_membership', $event->requires_membership) ? 'checked' : '' }}>
                            <span class="ml-2">Requires Membership</span></label>
                        <label class="flex items-center"><input type="checkbox" name="send_mail"
                                                                value="1" {{ old('send_mail', $event->send_mail) ? 'checked' : '' }}>
                            <span class="ml-2">Send Mail</span></label>
                        <label class="flex items-center"><input type="checkbox" name="active"
                                                                value="1" {{ old('active', $event->active) ? 'checked' : '' }}>
                            <span class="ml-2">Active</span></label>
                    </div>

                    <div class="mt-6 flex space-x-3">
                        <a href="{{ route('events.index') }}"
                           class="px-4 py-2 bg-gray-300 dark:bg-gray-700 dark:text-white text-gray-800 rounded hover:bg-gray-400 dark:hover:bg-gray-600 transition">
                            Back
                        </a>

                        <div>
                            <button type="submit"
                                    class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
                                Save
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script>
        const limitCheckbox = document.querySelector('input[name="limit"]');
        const maxPeopleInput = document.getElementById('max_people');

        limitCheckbox.addEventListener('change', function () {
            maxPeopleInput.disabled = !this.checked;
        });
    </script>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Event') }}
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
                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 dark:bg-red-800 text-red-800 dark:text-red-200 rounded">
                        <strong>There were some problems with your input:</strong>
                        <ul class="mt-2 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" action="{{ route('events.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                        <input type="text" name="name" class="w-full rounded-md border-gray-300 dark:bg-gray-700"
                               required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                        <textarea name="description" rows="4"
                                  class="w-full rounded-md border-gray-300 dark:bg-gray-700"></textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Begin Time</label>
                            <input type="datetime-local" name="begin_time"
                                   class="w-full rounded-md border-gray-300 dark:bg-gray-700" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">End Time</label>
                            <input type="datetime-local" name="end_time"
                                   class="w-full rounded-md border-gray-300 dark:bg-gray-700" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Max People</label>
                            <input
                                type="number"
                                name="max_people"
                                id="max_people"
                                class="w-full rounded-md border-gray-300 dark:bg-gray-700 dark:text-gray-300 disabled:cursor-not-allowed disabled:bg-gray-200 dark:disabled:bg-gray-600 dark:disabled:invisible disabled:invisible disabled:text-gray-500 p-2"
                                disabled
                            >
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Image</label>
                            <input type="file" name="img" class="w-full rounded-md border-gray-300 dark:bg-gray-700">
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-4 mb-4">
                        <label class="flex items-center"><input type="checkbox" name="limit" value="1"> <span
                                class="ml-2">Limit</span></label>
                        <label class="flex items-center"><input type="checkbox" name="requires_payment" value="1"> <span
                                class="ml-2">Requires Payment</span></label>
                        <label class="flex items-center"><input type="checkbox" name="requires_membership" value="1">
                            <span class="ml-2">Requires Membership</span></label>
                        <label class="flex items-center"><input type="checkbox" name="send_mail" value="1"> <span
                                class="ml-2">Send Mail</span></label>
                        <label class="flex items-center"><input type="checkbox" name="active" value="1" checked> <span
                                class="ml-2">Active</span></label>
                    </div>

                    <div class="mt-6 flex space-x-3">
                        <a href="{{ route('events.index') }}"
                           class="px-4 py-2 bg-gray-300 dark:bg-gray-700 dark:text-white text-gray-800 rounded hover:bg-gray-400 dark:hover:bg-gray-600 transition">
                            Back
                        </a>

                        <div>
                            <button type="submit"
                                    class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
                                Create
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", (event) => {
            const limitCheckbox = document.querySelector('input[name="limit"]');
            const maxPeopleInput = document.getElementById('max_people');

            limitCheckbox.addEventListener('change', function () {
                maxPeopleInput.disabled = !this.checked;
            });
        });

    </script>
</x-app-layout>

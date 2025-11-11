<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('All Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Per page selector --}}
            <form method="GET" class="mb-4 flex items-center space-x-2">
                <label for="per_page" class="text-gray-700 dark:text-gray-300">Users per page:</label>
                <select name="per_page" id="per_page" class="rounded-md border-gray-300 bg-primary dark:bg-primary-dark text-gray-200" onchange="this.form.submit()">
                    <option value="5" {{ $perPage == 5 ? 'selected' : '' }}>5</option>
                    <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                    <option value="20" {{ $perPage == 20 ? 'selected' : '' }}>20</option>
                </select>
            </form>

            <div class="overflow-x-auto shadow-sm sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-primary dark:bg-primary-dark text-white">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium uppercase tracking-wider">ID</th>
                        <th class="px-4 py-2 text-left text-xs font-medium uppercase tracking-wider">First Name</th>
                        <th class="px-4 py-2 text-left text-xs font-medium uppercase tracking-wider">Middle Name</th>
                        <th class="px-4 py-2 text-left text-xs font-medium uppercase tracking-wider">Last Name</th>
                        <th class="px-4 py-2 text-left text-xs font-medium uppercase tracking-wider">Student ID</th>
                        <th class="px-4 py-2 text-left text-xs font-medium uppercase tracking-wider">Email</th>
                        <th class="px-4 py-2 text-left text-xs font-medium uppercase tracking-wider">Role</th>
                        <th class="px-4 py-2 text-left text-xs font-medium uppercase tracking-wider">Created At</th>
                        <th class="px-4 py-2 text-left text-xs font-medium uppercase tracking-wider">Updated At</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($users as $user)
                        <tr class="{{ auth()->id() === $user->id ? 'bg-green-100 dark:bg-green-700' : 'bg-primary dark:bg-primary-dark' }}">
                            <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-200">{{ $user->id }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-200">{{ $user->f_name }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-200">{{ $user->m_name }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-200">{{ $user->l_name }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-200">{{ $user->student_id }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-200">{{ $user->email }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-200">{{ $user->role }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-200">{{ $user->created_at }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-200">{{ $user->updated_at }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-6">
                {{ $users->links() }}
            </div>

        </div>
    </div>
</x-app-layout>

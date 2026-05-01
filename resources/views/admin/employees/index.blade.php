<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            All Employee Profiles
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white p-6 rounded shadow">

                <div class="mb-4">
                    <a href="{{ route('admin.dashboard') }}"
                       class="bg-gray-700 text-white px-4 py-2 rounded">
                        Back to Dashboard
                    </a>
                </div>

                @if ($employees->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full border">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="border px-4 py-2 text-left">#</th>
                                    <th class="border px-4 py-2 text-left">Photo</th>
                                    <th class="border px-4 py-2 text-left">Name</th>
                                    <th class="border px-4 py-2 text-left">Email</th>
                                    <th class="border px-4 py-2 text-left">Phone</th>
                                    <th class="border px-4 py-2 text-left">City</th>
                                    <th class="border px-4 py-2 text-left">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($employees as $employee)
                                    <tr>
                                        <td class="border px-4 py-2">
                                            {{ $loop->iteration }}
                                        </td>

                                        <td class="border px-4 py-2">
                                            @if ($employee->profile_photo)
                                                <img src="{{ asset('storage/' . $employee->profile_photo) }}"
                                                     class="w-12 h-12 rounded object-cover">
                                            @else
                                                N/A
                                            @endif
                                        </td>

                                        <td class="border px-4 py-2">
                                            {{ $employee->full_name }}
                                        </td>

                                        <td class="border px-4 py-2">
                                            {{ $employee->email }}
                                        </td>

                                        <td class="border px-4 py-2">
                                            {{ $employee->phone }}
                                        </td>

                                        <td class="border px-4 py-2">
                                            {{ $employee->city }}
                                        </td>

                                        <td class="border px-4 py-2">
                                            <a href="{{ route('admin.employees.show', $employee) }}"
                                               class="bg-blue-600 text-white px-3 py-1 rounded">
                                                View
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $employees->links() }}
                    </div>
                @else
                    <p class="text-gray-600">No employee profiles found.</p>
                @endif

            </div>

        </div>
    </div>
</x-app-layout>

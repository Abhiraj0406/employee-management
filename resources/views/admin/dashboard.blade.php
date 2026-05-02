<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Admin Dashboard
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow rounded">
                <h3 class="text-lg font-semibold mb-2">Welcome Admin</h3>
                <p class="text-gray-600">
                    Here admin will manage and view all employee profiles.
                </p>

                <a href="{{ route('profile.edit') }}"
                    class="inline-block mt-3 bg-blue-600 text-white px-4 py-2 rounded">
                        My Account Profile
                </a>

                <a href="{{ route('admin.employees.index') }}"
                    class="inline-block mt-4 bg-blue-600 text-white px-4 py-2 rounded">
                        View All Employees
                </a>
            </div>
        </div>
    </div>
</x-app-layout>

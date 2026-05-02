<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Employee Dashboard
        </h2>
    </x-slot>

    <div class="bg-white p-6 shadow rounded">
        <h3 class="text-lg font-semibold mb-2">Welcome Employee</h3>
    
        <p class="text-gray-600 mb-4">
            Here you can create, view, and edit your employee profile.
        </p>
    
        <div class="flex gap-3">
            <a href="{{ route('employee.profile.show') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded">
                My Profile
            </a>
    
            <a href="{{ route('employee.profile.create') }}"
               class="bg-green-600 text-white px-4 py-2 rounded">
                Create Profile
            </a>
        </div>
    </div>
</x-app-layout>

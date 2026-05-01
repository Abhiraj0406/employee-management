<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            My Employee Profile
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('info'))
                <div class="mb-4 p-3 bg-blue-100 text-blue-700 rounded">
                    {{ session('info') }}
                </div>
            @endif

            <div class="bg-white p-6 rounded shadow mb-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">Basic Information</h3>

                    <a href="{{ route('employee.profile.edit') }}"
                       class="bg-blue-600 text-white px-4 py-2 rounded">
                        Edit Profile
                    </a>
                </div>

                @if ($profile->profile_photo)
                    <div class="mb-4">
                        <img src="{{ asset('storage/' . $profile->profile_photo) }}"
                             alt="Profile Photo"
                             class="w-32 h-32 object-cover rounded border">
                    </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <p><strong>Full Name:</strong> {{ $profile->full_name }}</p>
                    <p><strong>Email:</strong> {{ $profile->email }}</p>
                    <p><strong>Phone:</strong> {{ $profile->phone }}</p>
                    <p><strong>Date of Birth:</strong> {{ $profile->date_of_birth ?? 'N/A' }}</p>
                    <p><strong>Gender:</strong> {{ $profile->gender ?? 'N/A' }}</p>
                    <p><strong>City:</strong> {{ $profile->city }}</p>
                    <p><strong>State:</strong> {{ $profile->state }}</p>
                    <p><strong>Pincode:</strong> {{ $profile->pincode }}</p>
                    <p><strong>Country:</strong> {{ $profile->country }}</p>
                </div>

                <div class="mt-4">
                    <p><strong>Address Line 1:</strong> {{ $profile->address_line_1 }}</p>
                    <p><strong>Address Line 2:</strong> {{ $profile->address_line_2 ?? 'N/A' }}</p>
                </div>
            </div>

            <div class="bg-white p-6 rounded shadow">
                <h3 class="text-lg font-semibold mb-4">Education & Documents</h3>

                @if ($profile->educations->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full border">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="border px-4 py-2 text-left">Certificate / Diploma</th>
                                    <th class="border px-4 py-2 text-left">Institute</th>
                                    <th class="border px-4 py-2 text-left">Year</th>
                                    <th class="border px-4 py-2 text-left">Document</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($profile->educations as $education)
                                    <tr>
                                        <td class="border px-4 py-2">{{ $education->certificate_name }}</td>
                                        <td class="border px-4 py-2">{{ $education->institute_name }}</td>
                                        <td class="border px-4 py-2">{{ $education->year_of_completion }}</td>
                                        <td class="border px-4 py-2">
                                            @if ($education->document_file)
                                                <a href="{{ asset('storage/' . $education->document_file) }}"
                                                   target="_blank"
                                                   class="text-blue-600 underline">
                                                    View Document
                                                </a>
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-gray-600">No education records added.</p>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>

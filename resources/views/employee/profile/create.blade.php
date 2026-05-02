<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Create Employee Profile
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded shadow">

                @if (session('info'))
                    <div class="mb-4 p-3 bg-blue-100 text-blue-700 rounded">
                        {{ session('info') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
                        <ul class="list-disc ml-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('employee.profile.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Tabs --}}
                    <div class="mb-6 border-b">
                        <button type="button"
                                id="basicBtn"
                                onclick="showTab('basic')"
                                class="px-4 py-2 font-semibold border-b-2 border-blue-600 text-blue-600">
                            Basic Information
                        </button>

                        <button type="button"
                                id="educationBtn"
                                onclick="showTab('education')"
                                class="px-4 py-2 font-semibold text-gray-500">
                            Education & Documents
                        </button>
                    </div>

                    {{-- Basic Information Tab --}}
                    <div id="basicTab">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                            <div>
                                <label class="block font-medium">Full Name</label>
                                <input type="text" name="full_name" value="{{ old('full_name', auth()->user()->name) }}"
                                       class="w-full border-gray-300 rounded mt-1" required>
                            </div>

                            <div>
                                <label class="block font-medium">Email</label>
                                <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}"
                                       class="w-full border-gray-300 rounded mt-1" required>
                            </div>

                            <div>
                                <label class="block font-medium">Phone Number</label>
                                <input type="text" name="phone" value="{{ old('phone') }}"
                                       class="w-full border-gray-300 rounded mt-1" required>
                            </div>

                            <div>
                                <label class="block font-medium">Date of Birth</label>
                                <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}"
                                       class="w-full border-gray-300 rounded mt-1">
                            </div>

                            <div>
                                <label class="block font-medium">Gender</label>
                                <select name="gender" class="w-full border-gray-300 rounded mt-1">
                                    <option value="">Select Gender</option>
                                    <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                                    <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                                </select>
                            </div>

                            <div>
                                <label class="block font-medium">Profile Photo</label>
                                <input type="file" name="profile_photo"
                                       class="w-full border-gray-300 rounded mt-1">
                            </div>

                            <div>
                                <label class="block font-medium">Address Line 1</label>
                                <input type="text" name="address_line_1" value="{{ old('address_line_1') }}"
                                       class="w-full border-gray-300 rounded mt-1" required>
                            </div>

                            <div>
                                <label class="block font-medium">Address Line 2</label>
                                <input type="text" name="address_line_2" value="{{ old('address_line_2') }}"
                                       class="w-full border-gray-300 rounded mt-1">
                            </div>

                            <div>
                                <label class="block font-medium">City</label>
                                <input type="text" name="city" value="{{ old('city') }}"
                                       class="w-full border-gray-300 rounded mt-1" required>
                            </div>

                            <div>
                                <label class="block font-medium">State</label>
                                <input type="text" name="state" value="{{ old('state') }}"
                                       class="w-full border-gray-300 rounded mt-1" required>
                            </div>

                            <div>
                                <label class="block font-medium">Pincode</label>
                                <input type="text" name="pincode" value="{{ old('pincode') }}"
                                       class="w-full border-gray-300 rounded mt-1" required>
                            </div>

                            <div>
                                <label class="block font-medium">Country</label>
                                <input type="text" name="country" value="{{ old('country', 'India') }}"
                                       class="w-full border-gray-300 rounded mt-1" required>
                            </div>

                        </div>

                        <div class="mt-6">
                            <button type="button"
                                    onclick="showTab('education')"
                                    class="bg-blue-600 text-white px-4 py-2 rounded">
                                Next
                            </button>
                        </div>
                    </div>

                    {{-- Education Tab --}}
                    <div id="educationTab" class="hidden">

                        <div id="educationWrapper">

                            <div class="education-row border p-4 rounded mb-4 bg-gray-50">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                                    <div>
                                        <label class="block font-medium">Certificate / Diploma Name</label>
                                        <input type="text" name="certificate_name[]"
                                               class="w-full border-gray-300 rounded mt-1">
                                    </div>

                                    <div>
                                        <label class="block font-medium">Institute Name</label>
                                        <input type="text" name="institute_name[]"
                                               class="w-full border-gray-300 rounded mt-1">
                                    </div>

                                    <div>
                                        <label class="block font-medium">Year of Completion</label>
                                        <input type="number" name="year_of_completion[]"
                                               class="w-full border-gray-300 rounded mt-1">
                                    </div>

                                    <div>
                                        <label class="block font-medium">Upload Document</label>
                                        <input type="file" name="document_file[]"
                                               class="w-full border-gray-300 rounded mt-1">
                                    </div>

                                </div>

                                <button type="button"
                                        onclick="removeEducationRow(this)"
                                        class="mt-4 bg-red-500 text-white px-3 py-1 rounded">
                                    Remove
                                </button>
                            </div>

                        </div>

                        <button type="button"
                                onclick="addEducationRow()"
                                class="bg-green-600 text-white px-4 py-2 rounded">
                            Add More Education
                        </button>

                        <div class="mt-6 flex gap-3">
                            <button type="button"
                                    onclick="showTab('basic')"
                                    class="bg-gray-500 text-white px-4 py-2 rounded">
                                Back
                            </button>

                            <button type="submit"
                                    class="bg-blue-600 text-white px-4 py-2 rounded">
                                Save Profile
                            </button>
                        </div>

                    </div>

                </form>

            </div>
        </div>
    </div>

    <script>
        function showTab(tab) {
            const basicTab = document.getElementById('basicTab');
            const educationTab = document.getElementById('educationTab');
            const basicBtn = document.getElementById('basicBtn');
            const educationBtn = document.getElementById('educationBtn');

            if (tab === 'basic') {
                basicTab.classList.remove('hidden');
                educationTab.classList.add('hidden');

                basicBtn.className = 'px-4 py-2 font-semibold border-b-2 border-blue-600 text-blue-600';
                educationBtn.className = 'px-4 py-2 font-semibold text-gray-500';
            } else {
                basicTab.classList.add('hidden');
                educationTab.classList.remove('hidden');

                educationBtn.className = 'px-4 py-2 font-semibold border-b-2 border-blue-600 text-blue-600';
                basicBtn.className = 'px-4 py-2 font-semibold text-gray-500';
            }
        }

        function addEducationRow() {
            const wrapper = document.getElementById('educationWrapper');

            const row = `
                <div class="education-row border p-4 rounded mb-4 bg-gray-50">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <div>
                            <label class="block font-medium">Certificate / Diploma Name</label>
                            <input type="text" name="certificate_name[]"
                                   class="w-full border-gray-300 rounded mt-1">
                        </div>

                        <div>
                            <label class="block font-medium">Institute Name</label>
                            <input type="text" name="institute_name[]"
                                   class="w-full border-gray-300 rounded mt-1">
                        </div>

                        <div>
                            <label class="block font-medium">Year of Completion</label>
                            <input type="number" name="year_of_completion[]"
                                   class="w-full border-gray-300 rounded mt-1">
                        </div>

                        <div>
                            <label class="block font-medium">Upload Document</label>
                            <input type="file" name="document_file[]"
                                   class="w-full border-gray-300 rounded mt-1">
                        </div>

                    </div>

                    <button type="button"
                            onclick="removeEducationRow(this)"
                            class="mt-4 bg-red-500 text-white px-3 py-1 rounded">
                        Remove
                    </button>
                </div>
            `;

            wrapper.insertAdjacentHTML('beforeend', row);
        }

        function removeEducationRow(button) {
            const rows = document.querySelectorAll('.education-row');

            if (rows.length > 1) {
                button.closest('.education-row').remove();
            } else {
                alert('At least one education row is required.');
            }
        }
    </script>
</x-app-layout>

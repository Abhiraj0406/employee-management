<?php
namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\EmployeeEducation;
use App\Models\EmployeeProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EmployeeProfileController extends Controller
{
    public function show()
    {
        $profile = EmployeeProfile::with('educations')
            ->where('user_id', Auth::id())
            ->first();

        if (! $profile) {
            return redirect()->route('employee.profile.create')
                ->with('info', 'Please create your profile first.');
        }

        return view('employee.profile.show', compact('profile'));
    }

    public function create()
    {
        $profile = EmployeeProfile::where('user_id', Auth::id())->first();

        if ($profile) {
            return redirect()->route('employee.profile.show')
                ->with('info', 'You have already created your profile.');
        }

        return view('employee.profile.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'full_name'            => 'required|string|max:255',
            'email'                => 'required|email|max:255',
            'phone'                => 'required|string|max:20',
            'date_of_birth'        => 'nullable|date',
            'gender'               => 'nullable|string|max:20',
            'address_line_1'       => 'required|string|max:255',
            'address_line_2'       => 'nullable|string|max:255',
            'city'                 => 'required|string|max:100',
            'state'                => 'required|string|max:100',
            'pincode'              => 'required|string|max:20',
            'country'              => 'required|string|max:100',
            'profile_photo'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

            'certificate_name.*'   => 'nullable|string|max:255',
            'institute_name.*'     => 'nullable|string|max:255',
            'year_of_completion.*' => 'nullable|digits:4|integer|min:1950|max:' . date('Y'),
            'document_file.*'      => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:4096',
        ]);

        $profilePhotoPath = null;

        if ($request->hasFile('profile_photo')) {
            $profilePhotoPath = $request->file('profile_photo')
                ->store('profile_photos', 'public');
        }

        $profile = EmployeeProfile::create([
            'user_id'        => Auth::id(),
            'full_name'      => $request->full_name,
            'email'          => $request->email,
            'phone'          => $request->phone,
            'date_of_birth'  => $request->date_of_birth,
            'gender'         => $request->gender,
            'address_line_1' => $request->address_line_1,
            'address_line_2' => $request->address_line_2,
            'city'           => $request->city,
            'state'          => $request->state,
            'pincode'        => $request->pincode,
            'country'        => $request->country,
            'profile_photo'  => $profilePhotoPath,
        ]);

        if ($request->certificate_name) {
            foreach ($request->certificate_name as $index => $certificateName) {
                if (! $certificateName) {
                    continue;
                }

                $documentPath = null;

                if ($request->hasFile("document_file.$index")) {
                    $documentPath = $request->file("document_file.$index")
                        ->store('employee_documents', 'public');
                }

                EmployeeEducation::create([
                    'employee_profile_id' => $profile->id,
                    'certificate_name'    => $certificateName,
                    'institute_name'      => $request->institute_name[$index] ?? '',
                    'year_of_completion'  => $request->year_of_completion[$index] ?? null,
                    'document_file'       => $documentPath,
                ]);
            }
        }

        return redirect()->route('employee.profile.show')
            ->with('success', 'Profile created successfully.');
    }

    public function edit()
    {
        $profile = EmployeeProfile::with('educations')
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('employee.profile.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $profile = EmployeeProfile::with('educations')
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $request->validate([
            'full_name'            => 'required|string|max:255',
            'email'                => 'required|email|max:255',
            'phone'                => 'required|string|max:20',
            'date_of_birth'        => 'nullable|date',
            'gender'               => 'nullable|string|max:20',
            'address_line_1'       => 'required|string|max:255',
            'address_line_2'       => 'nullable|string|max:255',
            'city'                 => 'required|string|max:100',
            'state'                => 'required|string|max:100',
            'pincode'              => 'required|string|max:20',
            'country'              => 'required|string|max:100',
            'profile_photo'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

            'certificate_name.*'   => 'nullable|string|max:255',
            'institute_name.*'     => 'nullable|string|max:255',
            'year_of_completion.*' => 'nullable|digits:4|integer|min:1950|max:' . date('Y'),
            'document_file.*'      => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:4096',
        ]);

        $profilePhotoPath = $profile->profile_photo;

        if ($request->hasFile('profile_photo')) {
            if ($profile->profile_photo) {
                Storage::disk('public')->delete($profile->profile_photo);
            }

            $profilePhotoPath = $request->file('profile_photo')
                ->store('profile_photos', 'public');
        }

        $profile->update([
            'full_name'      => $request->full_name,
            'email'          => $request->email,
            'phone'          => $request->phone,
            'date_of_birth'  => $request->date_of_birth,
            'gender'         => $request->gender,
            'address_line_1' => $request->address_line_1,
            'address_line_2' => $request->address_line_2,
            'city'           => $request->city,
            'state'          => $request->state,
            'pincode'        => $request->pincode,
            'country'        => $request->country,
            'profile_photo'  => $profilePhotoPath,
        ]);

        foreach ($profile->educations as $education) {
            if ($education->document_file) {
                Storage::disk('public')->delete($education->document_file);
            }

            $education->delete();
        }

        if ($request->certificate_name) {
            foreach ($request->certificate_name as $index => $certificateName) {
                if (! $certificateName) {
                    continue;
                }

                $documentPath = null;

                if ($request->hasFile("document_file.$index")) {
                    $documentPath = $request->file("document_file.$index")
                        ->store('employee_documents', 'public');
                }

                EmployeeEducation::create([
                    'employee_profile_id' => $profile->id,
                    'certificate_name'    => $certificateName,
                    'institute_name'      => $request->institute_name[$index] ?? '',
                    'year_of_completion'  => $request->year_of_completion[$index] ?? null,
                    'document_file'       => $documentPath,
                ]);
            }
        }

        return redirect()->route('employee.profile.show')
            ->with('success', 'Profile updated successfully.');
    }
}

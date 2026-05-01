<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeEducation extends Model
{
    protected $fillable = [
        'employee_profile_id',
        'certificate_name',
        'institute_name',
        'year_of_completion',
        'document_file',
    ];

    public function employeeProfile()
    {
        return $this->belongsTo(EmployeeProfile::class);
    }
}

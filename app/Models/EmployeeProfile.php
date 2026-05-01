<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeProfile extends Model
{
    protected $fillable = [
        'user_id',
        'full_name',
        'email',
        'phone',
        'date_of_birth',
        'gender',
        'address_line_1',
        'address_line_2',
        'city',
        'state',
        'pincode',
        'country',
        'profile_photo',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function educations()
    {
        return $this->hasMany(EmployeeEducation::class);
    }
}

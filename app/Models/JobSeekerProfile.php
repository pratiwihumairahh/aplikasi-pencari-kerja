<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class JobSeekerProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'place_of_birth',
        'date_of_birth',
        'address',
        'education_level',
        'major',
        'institution',
        'graduation_year',
        'photo_path',
        'id_card_path',
        'certificate_path',
        'work_experience_path',
        'status',
        'card_number',
        'rejection_reason',
        'approved_at',
        'rejected_at',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'graduation_year' => 'integer',
        'approved_at' => 'datetime',
        'rejected_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'approved_at',
        'rejected_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isPending()
    {
        return $this->status === 'pending';
    }

    public function isApproved()
    {
        return $this->status === 'approved';
    }

    public function isRejected()
    {
        return $this->status === 'rejected';
    }
}

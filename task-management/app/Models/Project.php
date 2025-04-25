<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;

    // Menambahkan kolom yang dapat diisi secara massal
    protected $fillable = [
        'name',
        'description',
        'start_date',
        'end_date',
        'status_id', // Ganti 'status' dengan 'status_id'
        'created_by', // jika Anda ingin mengizinkan 'created_by' untuk mass assignment
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id'); // Relasi dengan status
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}

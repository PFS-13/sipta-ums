<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa'; // Define table name explicitly

    protected $primaryKey = 'nim'; // Set primary key
    public $incrementing = false; // Because 'nim' is a string, not an auto-incrementing integer
    protected $keyType = 'string'; // Specify primary key type

    protected $fillable = [
        'nim',
        'tahun_masuk',
        'kelas', 
        'prodi',
        'status_ta',
        'id_kota',
    ];

    /**
     * Relationship with the User model.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'nim', 'username');
    }

}

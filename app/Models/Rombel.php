<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Rombel extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        'uuid',
        'nama_rombel',
        'rayon_id'
    ];

    protected $dates = [
        'deleted_at',
    ];
    
    public function rayon()
    {
        return $this->belongsTo(Rayon::class, 'rayon_id', 'id');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = Str::uuid();
            $model->created_at = now();
        });

        static::updating(function ($model) {
            $model->updated_at = now();
        });
    }

    public function students()
    {
        return $this->belongsTo(Student::class, 'rombel_id', 'id');
    }
}

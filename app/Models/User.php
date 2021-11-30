<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
    ];

    public function type()
    {
        return $this->belongsTo(Type::class, 'type_id');
    }

    public function scopeSearch($query,$term)
    {
        $term = "%$term%";

        $query->where(function($query) use ($term){
            $query->where('name','like',$term)
            ->orWhere('email','like',$term)
            ->orWhereHas('type',function($query) use ($term){
                $query->where('name','like',$term);
            });
        });
    }
}

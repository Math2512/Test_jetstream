<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'path',
        'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getCreatedAtAttribute($date)
    {
        return Carbon::parse($date)->diffForHumans();
    }

    public function getPathAttribute($path)
    {
        if($path){
            return asset('storage/'.$path);
        }
    }

    public function likes()
    {
        return $this->belongsToMany(User::class, 'likes', 'post_id');
    }
}

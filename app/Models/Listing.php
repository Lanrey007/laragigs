<?php

namespace App\Models;

use Illuminate\Cache\TagSet;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    //protected $fillable = [
     //   'title', 'company', 'website', 'tags', 'description', 'email',  'location'   ];

    public function scopeFilter($query, array $filters) {
        if ($filters['tag'] ?? false){
            $query->where('tags', 'like', '%'. request('tag') . '%');
        }

        if ($filters['search'] ?? false){
            $query->where('title', 'like', '%'. request('search') . '%')
            ->orwhere('description', 'like', '%'. request('search') . '%')
            ->orwhere('tags', 'like', '%'. request('search') . '%');
        }

    }
    //reelationship to user
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}

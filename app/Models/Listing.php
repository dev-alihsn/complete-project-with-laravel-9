<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    protected $fillable = ['title','company','website','location','tags','descrption','email','logo','user_id'];
    
    public function scopeFilter($query, array $filters){

        if($filters['tag'] ?? false){
            $query->where('tags' , 'like' , '%' . request('tag') . '%');
        }

        if($filters['search'] ?? false){
            $query->where('title' , 'like' , '%' . request('search') . '%')
                ->orWhere('descrption' , 'like' , '%' . request('search') . '%')
                ->orWhere('tags' , 'like' , '%' . request('search') . '%');
        }
    }

    public function User(){
        return $this->belongsTo(User::class,'user_id');
    }
}

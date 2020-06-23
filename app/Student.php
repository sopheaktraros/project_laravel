<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
   
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname', 'class', 'description', 'picture', 'user_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

   public function users(){
       return $this->belongsToMany(Student::class)->withPivot('comment');
   }
        
}

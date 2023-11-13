<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    //this is for security after using the update/create method static called mass assignment
    //which is changing multiple attributes of a model at once
    //it is off by default
    //put in everything that is fillable
    protected $fillable = ['title', 'description', 'long_description'];
    //fillable is more secured than guarded
    // protected $guarded = ['secret'];

    public function toggleComplete()
    {
        $this->completed = !$this->completed;
        $this->save();
    }
    
}

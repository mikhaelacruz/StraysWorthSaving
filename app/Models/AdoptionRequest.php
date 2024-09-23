<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdoptionRequest extends Model
{
    use HasFactory;

    protected $table = 'adoptionrequests';
    protected $fillable = ['userid', 'stray_id', 'name', 'email', 'contact_number', 'location'];
}

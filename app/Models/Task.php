<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;
use App\Models\User;

class Task extends Model
{
    use HasFactory,Uuids;

    protected $table = 'task';

    protected $fillable = [
        'user_id','project_id','title','description','status',
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}

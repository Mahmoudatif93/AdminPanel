<?php

namespace App\Model;

use App\Model\Department;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\App;

class Size extends Model
{
    protected $table = 'sizes';
    protected $fillable = [
        'name_ar',
        'name_en',
        'is_public',
        'department_id',
    ];

    public function department()
    {
        return $this->BelongsTo(Department::class);
    }

    //or
    public function department_id()
    {
        return $this->hasOne('App\Model\Department', 'id', 'department_id');
    }
}

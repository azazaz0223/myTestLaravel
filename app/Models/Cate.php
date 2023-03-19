<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cate extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $date = [ 'deleted_at' ];

    protected $fillable = [
        'name',
        'sort',
    ];

    public function products()
    {
        return $this->hasMany('App\Models\Product', 'cate_id', 'id');
    }
}
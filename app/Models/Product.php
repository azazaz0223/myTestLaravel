<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $date = [ 'deleted_at' ];

    protected $fillable = [
        'cate_id',
        'name',
        'description',
        'operator_id',
    ];

    public function cate()
    {
        return $this->belongsTo('App\Models\Cate');
    }

    public function operator()
    {
        return $this->belongsTo('App\Models\User');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FundCollection extends Model
{
    use HasFactory;

    protected $table = 'collections';
    public $timestamps = false;
    protected $fillable=['title', 'description', 'link', 'target_amount'];

    public function contributors()
    {
        return $this->hasMany(Contributor::class, 'collection_id', 'id');
    }

}

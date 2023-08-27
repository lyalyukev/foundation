<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contributor extends Model
{
    use HasFactory;
    protected $fillable = ['user_name', 'amount', 'collection_id'];

    public $timestamps = false;

    public function collection()
    {
        return $this->belongsTo(FundCollection::class);
    }
}

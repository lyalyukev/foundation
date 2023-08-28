<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


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

    public function scopeWithRemainingAmount($query, $sum = 0)
    {
        return $query->select('*', 'sum_amount', DB::raw('(target_amount - sum_amount) as differ'))
            ->fromSub(function ($query) {
                $query->select('collection_id', DB::raw('sum(amount) as sum_amount'))
                    ->from('contributors')
                    ->groupBy('collection_id')
                    ->orderBy('sum_amount');
            }, 'col')
            ->join('collections', 'collections.id', '=', 'col.collection_id')
            ->whereRaw('target_amount - sum_amount > 0')
            ->whereRaw('(target_amount - sum_amount) < '.$sum)
            ->orderBy('differ');
    }



}

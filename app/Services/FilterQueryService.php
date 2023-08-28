<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Builder;

class FilterQueryService
{
    const OPERATORS = ['>', '<', '='];

    public function handle($filter, $query)
    {


        parse_str($filter, $parameters);

        if (array_key_exists('target_amount', $parameters)) {

            $this->applyTargetAmountFilter($parameters['target_amount'], $query);

        }

        if (array_key_exists('order', $parameters)) {

            $this->applyOrderFilter($parameters['order'], $query);

        }

        return $query;

    }

    private function applyTargetAmountFilter($filter, Builder $query)
    {
        if (preg_match('/([>=<])(\d+)/', $filter, $matches)) {
            $operator = $matches[1];
            $number = $matches[2];

            if (in_array($operator, self::OPERATORS)) {
                $query->where('target_amount', $operator, $number);
            }
        }
    }

    private function applyOrderFilter($order, Builder $query)
    {
        $direction = strtolower($order) === 'desc' ? 'desc' : 'asc';
        $query->orderBy('target_amount', $direction);
    }

}

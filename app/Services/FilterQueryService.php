<?php

namespace App\Services;

class FilterQueryService
{
    public function handle($filter, $query)
    {
        try {
            parse_str($filter, $parameters);

            if (array_key_exists('target_amount', $parameters)) {
                $filterTargetAmount = $parameters['target_amount'];
                if (preg_match('/([>=<])(\d+)/', $filterTargetAmount, $matches)) {
                    $operator = $matches[1]; // Знак оператора (например, >= или <=)
                    $number = $matches[2];   // Число

                    $query->where('target_amount', $operator, $number);
                }

            }
            if (array_key_exists('order', $parameters)) {
                $query->orderBy('target_amount', $parameters['order']);
            }
            return $query;
        } catch (\Throwable $e) {

            return response()->json(['error' => 'Uknown filter parameters', 'code' => 500]);

        }
    }

}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContributorRequest;
use App\Http\Resources\ContributorResource;
use App\Models\Contributor;

class ContributorController extends Controller
{
    public function store($collection_id, ContributorRequest $request)
    {
        $data = array_merge($request->validated(), ['collection_id' => $collection_id]);
        $contributor = Contributor::create($data);

        return (new ContributorResource($contributor))
            ->response()
            ->setStatusCode(201);
    }
}

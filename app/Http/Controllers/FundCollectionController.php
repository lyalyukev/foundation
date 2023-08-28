<?php

namespace App\Http\Controllers;

use App\Http\Requests\FundCollectionRequest;
use App\Http\Resources\FundCollectionCollection;
use App\Http\Resources\FundCollectionResource;
use App\Models\FundCollection;
use App\Services\FilterQueryService;


class FundCollectionController extends Controller
{

    public function index()
    {
        return new FundCollectionCollection(FundCollection::all());
    }

    public function indexWithContributors()
    {
        return new FundCollectionCollection(FundCollection::with('contributors')->get());
    }

    public function show($id)
    {
        return new FundCollectionResource (FundCollection::with('contributors')->findOrFail($id));
    }

    public function store(FundCollectionRequest $request)
    {
        $fundCollection = FundCollection::create($request->validated());

        return (new FundCollectionResource($fundCollection))->response()->setStatusCode(201);
    }

    public function filterCollections(FilterQueryService $filterQueryService, $filter = null)
    {
        $query = FundCollection::query();

        if ($filter) {
            $filterQueryService->applyFilters($filter, $query);
        }

        return new FundCollectionCollection($query->get());
    }
}

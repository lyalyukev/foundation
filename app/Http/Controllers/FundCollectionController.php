<?php

namespace App\Http\Controllers;

use App\Http\Requests\FundCollectionRequest;
use App\Http\Resources\FundCollectionCollection;
use App\Http\Resources\FundCollectionResource;
use App\Models\FundCollection;
use App\Services\FilterQueryService;


class FundCollectionController extends Controller
{

    public function getCollections()
    {
        return new FundCollectionCollection(FundCollection::all());
    }

    public function getCollectionsWithContributors()
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

    public function collectionsWithRemainderFilter ($sum = 0) {
        return FundCollection::query()->WithRemainingAmount($sum)->get();
    }

    public function collectionsWithRemainder () {
        return FundCollection::WithRemainingAmount()->get();
    }


    public function filterCollections(FilterQueryService $filterQueryService, $filter = null)
    {
        $query = FundCollection::query();

        if ($filter) {
            $filterQueryService->applyFilters($filter, $query);
        }
        return new FundCollectionCollection($query->get());
    }

    public function edit($id)
    {
        $collection = FundCollection::findOrFail($id);
        return view('edit_collection', ['collection' => $collection]);
    }
    public function update ($id, FundCollectionRequest $request)
    {
        $collection = FundCollection::findOrFail($id);
        $collection->update($request->validated());

        return to_route('collection.contributors', ['id'=>$id]);
    }

}

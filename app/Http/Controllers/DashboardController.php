<?php

namespace App\Http\Controllers;

use App\Models\FundCollection;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $collections = FundCollection::WithRemainingAmount()->withCount('contributors')->withSum('contributors', 'amount')->get();

        return view('dashboard', ['collections' => $collections]);

    }

    public function allCollections()
    {
        $allCollections = FundCollection::withCount('contributors')->withSum('contributors', 'amount')->get();

        return view('collections_all', ['allCollections' => $allCollections]);
    }

    public function collectionContributors($id)
    {
        $collections = FundCollection::with('contributors')
            ->withCount('contributors')
            ->withSum('contributors', 'amount')
            ->where('id', $id)->get();

        return view('collection_info', ['collections' => $collections]);
    }

}

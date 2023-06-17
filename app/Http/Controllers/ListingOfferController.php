<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListingOfferController extends Controller
{
    //
    public function store(Listing $listing, Request $request)
    {
        $validatedData = $request->validate([
            'amount' => 'required|integer|min:1|max:20000000'
        ]);

        $offer = Offer::make($validatedData);
        $offer->bidder()->associate($request->user());
        $listing->offers()->save($offer);

        return redirect()->back()->with(
            'success',
            'Offer was made!'
        );
    }
}

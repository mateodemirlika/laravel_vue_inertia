<?php

namespace App\Http\Controllers;

use App\Models\Listing;

use Illuminate\Http\Request;

class RealtorListingImageController extends Controller
{
    //
    public function create(Listing $listing)
    {
        return inertia(
            'Relator/ListingImage/Create',
            ['listing' => $listing]
        );
    }
    public function store()
    {
        dd('Works!');
    }
}

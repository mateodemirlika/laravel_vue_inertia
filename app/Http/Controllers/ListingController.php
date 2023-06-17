<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class ListingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $filters = $request->only([
            'priceFrom', 'priceTo', 'beds', 'baths', 'areaFrom', 'areaTo'
        ]);
        $query = Listing::orderByDesc('created_at');

        return inertia('Listing/Index', [
            'filters' => $filters,
            'listings' => Listing::mostRecent()
                ->filter($filters)
                ->paginate(10)
                ->withQueryString()

        ]);
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $listing =  Listing::find($id);

        // $this->authorize('view', $listing);

        $listing->load(['images']);
        $offer =  !Auth::user() ? null : $listing->offers()->byMe()->first();

        return inertia('Listing/Show', [
            'listing' => $listing,
            'offerMade' => $offer
        ]);
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $listing = Listing::find($id);
        $this->authorize('delete', $listing);

        $listing->delete();
        return redirect()->route('listing.index')->with('success', 'Listing was Deleted!');
    }
}

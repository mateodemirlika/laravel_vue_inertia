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

        $this->authorizeResource(Listing::class, 'listing');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return inertia('Listing/Index', [
            'listings' => Listing::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        // $this->authorize('create', Listing::class);

        return inertia('Listing/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validatedData =   $request->validate([
            'beds' => 'required|integer|min:0|max:20',
            'baths' => 'required|integer|min:0|max:20',
            'area' => 'required|integer|min:15|max:1500',
            'city' => 'required',
            'code' => 'required',
            'street' => 'required',
            'street_nr' => 'required|min:1|max:1000',
            'price' => 'required|integer|min:1|max:20000000',
        ]);

        $listing = Listing::create($validatedData); // Create a new listing

        $user = $request->user(); // Retrieve the authenticated user
        $user->listings()->save($listing);

        return redirect()->route('listing.index')->with('success', 'Listing was Created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $listing =  Listing::find($id);
        // if (Auth::user()->cannot('view', $listing)) {
        //     abort(403);
        // }
        $this->authorize('view', $listing);
        return inertia('Listing/Show', [
            'listing' => $listing
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        return inertia('Listing/Edit', [
            'listing' => Listing::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $listing = Listing::find($id);
        //
        $validatedData =   $request->validate([
            'beds' => 'required|integer|min:0|max:20',
            'baths' => 'required|integer|min:0|max:20',
            'area' => 'required|integer|min:15|max:1500',
            'city' => 'required',
            'code' => 'required',
            'street' => 'required',
            'street_nr' => 'required|min:1|max:1000',
            'price' => 'required|integer|min:1|max:20000000',
        ]);

        $listing->update($validatedData);


        return redirect()->route('listing.index')->with('success', 'Listing was Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $listing = Listing::find($id);
        $listing->delete();
        return redirect()->route('listing.index')->with('success', 'Listing was Deleted!');
    }
}

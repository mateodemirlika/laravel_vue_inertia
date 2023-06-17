<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Listing;

class RealtorListingController extends Controller
{
    //
    public function index(Request $request)
    {
        $filters = [
            'deleted' => $request->boolean('deleted'),
            ...$request->only(['by', 'order'])
        ];
        return inertia(
            'Relator/Index',
            [
                'filters' => $filters,
                'listings' => Auth::user()
                    ->listings()
                    ->mostRecent()
                    ->filter($filters)
                    ->withCount('images')
                    ->paginate(5)
                    ->withQueryString()
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        // $this->authorize('create', Listing::class);

        return inertia('Relator/Create');
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

        return redirect()->route('relator.listing.index')->with('success', 'Listing was Created');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $listing = Listing::find($id);
        $this->authorize('update', $listing);

        return inertia('Relator/Edit', [
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
        $this->authorize('update', $listing);

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


        return redirect()->route('relator.listing.index')->with('success', 'Listing was Updated!');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $listing = Listing::find($id);
        $this->authorize('delete', $listing);

        $listing->deleteOrFail();
        return redirect()->route('realtor.listing.index')->with('success', 'Listing was Deleted!');
    }


    public function restore(Listing $listing)
    {
        $listing->restore();

        return redirect()->back()->with('success', 'Listing was restored!');
    }
}

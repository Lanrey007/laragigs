<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Session\Session;

class ListingController extends Controller
{
    //show all listing
    public function index(Request $request) {
    
        return view('listings.index', [
            'listings' => Listing::latest()->filter(request(['tag','search']))->simplePaginate(6)
        ]);
    }

    //show single listing
    public function show(Listing $listing) {
        return view('listings.show', [
            'listing' => $listing
            
        ]);
    }

     //show create form
     public function create(Listing $listing) {
        return view('listings.create');
    }

    //store listing data
    public function store(Request $request) {
       // dd($request->file('logo'));
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'

        ]);

        if($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos','public');
        }

        $formFields['user_id'] = auth()->id();

        Listing::create($formFields);

        //Session::flash('message', 'listing Created');
        return redirect('/')->with('message', 'Listing Created  Successfully');
    }

      //show edit form
      public function edit(Listing $listing) {
        return view('listings.edit', ['listing' => $listing]);
    }

     //update listing data
     public function update(Request $request, Listing $listing) {
        if ($listing->user_id != auth()->id()){
            abort(403, 'Unauthorized Action');
        }
         $formFields = $request->validate([
             'title' => 'required',
             'company' => 'required',
             'location' => 'required',
             'website' => 'required',
             'email' => ['required', 'email'],
             'tags' => 'required',
             'description' => 'required'
 
         ]);
 
         if($request->hasFile('logo')){
             $formFields['logo'] = $request->file('logo')->store('logos','public');
         }

         $formFields['user_id'] = auth()->id();
 
         $listing->update($formFields);
 
         return back()->with('message', 'Listing Updated  Successfully');
     }

     public function destroy(Listing $listing){
        if ($listing->user_id != auth()->id()){
            abort(403, 'Unauthorized Action');
        }
        $listing->delete();
        return redirect('/')->with('message', 'Listing Deleted Sucessfully');
     }

      //show manage  form
      public function manage() {
        return view('listings.manage', ['listings' => auth()->user()->listings()->get()]);
    }
}

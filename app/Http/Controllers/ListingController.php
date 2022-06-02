<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
use Illuminate\Contracts\Validation\Rule;

class listingController extends Controller
{
    public function index(){
        return view('listings.index',[
            "listings" =>  Listing::latest()->filter(request(['tag','search']))->paginate(6)
        ]);
    }

    public function show(Listing $listing){
        return view('listings.show',[
            "listing" =>  $listing
        ]);
    }

    public function create(){
        return view('listings.create');
    }

    public function store(Request $request){
        $formFileds = $request->validate([
            'title' => 'required',
            'company' => 'required',
            'location' => 'required',
            'website' => 'required',
            'email' => 'required|email|unique:listings,company',
            'tags' => 'required',
            'descrption' => 'required'
        ]);

        $formFileds['user_id'] = auth()->id();

        if($request->hasFile('logo')){
            $formFileds['logo'] = $request->file('logo')->store('logos','public');
        }

        Listing::create($formFileds);
        return redirect('/')->with('message','listing created sucessfuly');
    }

    public function edit(Listing $listing){
        return view('listings.edit',['listing' => $listing]);
    }

    public function update(Request $request, Listing $listing){

        if($listing->user_id != auth()->id){
            abort(403,'unauthrized action');
        }

        $formFileds = $request->validate([
            'title' => 'required',
            'company' => 'required',
            'location' => 'required',
            'website' => 'required',
            'email' => 'required|email|unique:listings,company',
            'tags' => 'required',
            'descrption' => 'required'
        ]);

        if($request->hasFile('logo')){
            $formFileds['logo'] = $request->file('logo')->store('logos','public');
        }

        $listing->update($formFileds);
        return back()->with('message','listing updated sucessfuly');
    }

    public function destroy(Listing $listing){
        if($listing->user_id != auth()->id){
            abort(403,'unauthrized action');
        }
        
        $listing->delete();
        return redirect('/')->with('message','listing deleted sucessfuly');
    }

    public function mange(){
        return view('listings.mange',['listings' => auth()->user()->listings()->get()]);
    }
}

<?php

namespace App\Http\Controllers;

use App\StorageLocation;
use Illuminate\Http\Request;

class StorageLocationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all the storage locations
        $locations = StorageLocation::all();

        // Return the index view
        return view('storage-locations.index')->with('locations', $locations);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Return the create view
        return view('storage-locations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate user input
        $this->validate($request, [
          'name' => 'required|min:3|max:150|unique:storage_locations',
          'street' => 'required|min:3|max:150',
          'house_number' => 'required|min:1|max:150',
          'postal' => 'required|min:1|max:150',
          'state_province_county' => 'required|min:3|max:150',
          'country' => 'required|min:3|max:150'
        ]);

        // Create a new instance of the model
        $location = new StorageLocation;

        $location->name = $request->input('name');
        $location->street = $request->input('street');
        $location->house_number = $request->input('house_number');
        $location->postal = $request->input('postal');
        $location->state_province_county = $request->input('state_province_county');
        $location->country = $request->input('country');

        // Save the new model
        $location->save();

        // Redirect with success message
        return redirect('/storage-locations')->with('success', 'Storage location has been created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\StorageLocation  $storageLocation
     * @return \Illuminate\Http\Response
     */
    public function show(StorageLocation $storageLocation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StorageLocation  $storageLocation
     * @return \Illuminate\Http\Response
     */
    public function edit($storageLocation)
    {
        // Get the storage location to edit
        $location = StorageLocation::find($storageLocation);

        // Return the edit view
        return view('storage-locations.edit')->with('location', $location);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StorageLocation  $storageLocation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $storageLocation)
    {
        $location = StorageLocation::find($storageLocation);

        // Validate user input
        $this->validate($request, [
          'name' => 'required|min:3|max:150|unique:storage_locations,name,'.$location->id,
          'street' => 'required|min:3|max:150',
          'house_number' => 'required|min:1|max:150',
          'postal' => 'required|min:1|max:150',
          'state_province_county' => 'required|min:3|max:150',
          'country' => 'required|min:3|max:150'
        ]);

        // Edit the model
        $location->name = $request->input('name');
        $location->street = $request->input('street');
        $location->house_number = $request->input('house_number');
        $location->postal = $request->input('postal');
        $location->state_province_county = $request->input('state_province_county');
        $location->country = $request->input('country');

        // Save the changes
        $location->save();

        // Redirect with success message
        return redirect('/storage-locations')->with('success', 'Storage location was edited and changes were saved!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StorageLocation  $storageLocation
     * @return \Illuminate\Http\Response
     */
    public function destroy(StorageLocation $storageLocation)
    {
        //
    }
}

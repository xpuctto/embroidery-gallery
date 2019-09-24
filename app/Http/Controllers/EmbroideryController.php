<?php

namespace App\Http\Controllers;

use Storage;
use App\Embroidery;
use App\EmbroideryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class EmbroideryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Embroidery::with('stitches', 'locations', 'symbols', 'embroidery_images')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $selectedSymbols = $request->input('selectedSymbols');
        $selectedStitches = $request->input('selectedStitches');
        $selectedLocations = $request->input('selectedLocations');
        $selectedRegion = $request->input('selectedRegion');
        $selectedCity = $request->input('selectedCity');
        $selectedImages = $request->images;
        $description = $request->input('description');
        $imageAuthors = $request->input('imageAuthors');
        $embroideryOwner = $request->input('embroideryOwner');
        $embroideryName = $request->input('embroideryName');

        $embroidery = Embroidery::create([
            'region_id' => $selectedRegion,
            'description' => $description,
            'image_authors' => $imageAuthors,
            'owner' => $embroideryOwner,
            'city_id' => $selectedCity,
            'name' => $embroideryName
        ]);

        $embroidery->stitches()->attach($selectedStitches);
        $embroidery->symbols()->attach($selectedSymbols);
        $embroidery->locations()->attach($selectedLocations);

        foreach ($selectedImages as $image)
        {
            $extension = $image->getClientOriginalExtension();
            $path = '/embroideries/' . $image->getFilename().'.'.$extension;
            Storage::disk('public')->put($path,  File::get($image));

            EmbroideryImage::create([
                'embroidery_id' => $embroidery->id,
                'path' => $path,
                'author' => $embroidery->imageAuthors,
                'owner' => $embroidery->owner
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Embroidery  $embroidery
     * @return \Illuminate\Http\Response
     */
    public function show(Embroidery $embroidery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Embroidery  $embroidery
     * @return \Illuminate\Http\Response
     */
    public function edit(Embroidery $embroidery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Embroidery  $embroidery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Embroidery $embroidery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Embroidery  $embroidery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Embroidery $embroidery)
    {
        $embroidery->delete();
    }

    public function search(Request $request)
    {
        $search = $request->query('query');

        return Embroideries::where('name', 'LIKE', '%'.$search.'%')->get();
    }
}

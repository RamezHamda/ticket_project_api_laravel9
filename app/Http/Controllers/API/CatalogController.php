<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CatalogRequest;
use App\Http\Resources\CatalogResource;
use App\Models\Catalog;
use Illuminate\Http\Request;

class CatalogController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $catalogs = Catalog::with(['child', 'user'])->latest()->get();
        $success = CatalogResource::collection($catalogs);

        return $this->sendResponse($success, 'Data Retrieved successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CatalogRequest $request)
    {
        // return $request->validated();

        $catalog = Catalog::create($request->validated() + ['user_id' => $request->user()->id]);
        $success = CatalogResource::make($catalog);

        return $this->sendResponse($success, 'Catalog Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Catalog  $catalog
     * @return \Illuminate\Http\Response
     */
    public function show(Catalog $catalog)
    {
        $success['catalog'] = CatalogResource::make($catalog);

        return $this->sendResponse($success, 'Data Retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Catalog  $catalog
     * @return \Illuminate\Http\Response
     */
    public function update(CatalogRequest $request, Catalog $catalog)
    {
        $catalog->update($request->validated());
        $success['catalog'] = CatalogResource::make($catalog);

        return $this->sendResponse($success, 'Catalog Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Catalog  $catalog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Catalog $catalog)
    {
        $catalog->delete();
        // $success['catalog'] = CatalogResource::make($catalog);

        return $this->sendStatus('Catalog Deleted Successfully.');
    }
}
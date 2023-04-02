<?php

namespace App\Http\Controllers\API;

use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Http\Requests\TicketRequest;
use App\Http\Resources\TicketResource;
use App\Http\Controllers\Api\BaseController;

class TicketController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ticket =Ticket::with(['user','attachment','catalog','threads'])->latest()->get();
        $success = TicketResource::collection($ticket);
        
       return $this->sendResponse($success, 'Data Retrieved successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->validated();
        // + ['user_id' => $request->user()->id]

        $validated = $request->validate([
            // 'user_id' => 'required',
            // 'catalog_id' => 'required',
            'date' => 'required',
            'title' => 'required',
            'desc' => 'required',
            'priority' => 'required',

        ]);

        $ticket = Ticket::create([
            'user_id' => $request->user()->id,
            'catalog_id' => $request->catalog->id,
            'date' => $request->date,
            'title' => $request->title,
            'desc' => $request->desc,
            'priority' => $request->priority,
        ]);

        // $success = TicketResource::make($ticket);

        return $this->sendResponse($ticket, 'Ticket Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sportevent;

class SporteventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sportevent = Sportevent::where('createdBy', auth()->user()->id)->paginate($request->perPage);

        return response($sportevent);
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
        $data = $request->validate([
            'eventDate' => 'required|date',
            'eventType' => 'required|max:255',
            'eventName' => 'required|max:255',
            'organizerId' => 'required|exists:organizers,id',
        ]);

        $data['createdBy'] = $request->user()->id;

        $sportevent = Sportevent::create($data);

        return response($sportevent);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sportevent = Sportevent::where('createdBy', auth()->user()->id)->where('id', $id)->first();

        if (!$sportevent) {
            return response(['message' => 'Sportevent not found'], 404);
        }

        return response($sportevent);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
        $data = $request->validate([
            'eventDate' => 'required|date',
            'eventType' => 'required|max:255',
            'eventName' => 'required|max:255',
        ]);

        $sportevent = Sportevent::where('createdBy', auth()->user()->id)->where('id', $id)->first();

        if (!$sportevent) {
            return response(['message' => 'Sportevent not found'], 404);
        }

        $sportevent->update($data);

        return response($sportevent);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sportevent = Sportevent::where('createdBy', auth()->user()->id)->where('id', $id)->first();

        if (!$sportevent) {
            return response(['message' => 'Sportevent not found'], 404);
        }

        $sportevent->delete();

        return response(['message' => 'Sport event was deleted']);
    }
}

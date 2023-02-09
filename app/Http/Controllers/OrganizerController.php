<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organizer;

class OrganizerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $organizer = Organizer::where('createdBy', auth()->user()->id)->paginate($request->perPage);

        return response($organizer);
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
            'organizerName' => 'required|max:255',
            'imageLocation' => 'required|max:255'
        ]);

        $data['createdBy'] = $request->user()->id;

        $organizer = Organizer::create($data);

        return response($organizer);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $organizer = Organizer::where('createdBy', auth()->user()->id)->where('id', $id)->first();

        if (!$organizer) {
            return response(['message' => 'Organizer not found'], 404);
        }

        return response($organizer);
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
            'organizerName' => 'required|max:255',
            'imageLocation' => 'required|max:255'
        ]);

        $organizer = Organizer::where('createdBy', auth()->user()->id)->where('id', $id)->first();

        if (!$organizer) {
            return response(['message' => 'Organizer not found'], 404);
        }

        $organizer->update($data);

        return response($organizer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $organizer = Organizer::where('createdBy', auth()->user()->id)->where('id', $id)->first();

        if (!$organizer) {
            return response(['message' => 'Organizer not found'], 404);
        }

        $organizer->delete();

        return response(['message' => 'Organizer deleted']);
    }
}

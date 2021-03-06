<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequest;
use App\Http\Requests\UpdateRequest;
use App\Http\Resources\PersonCollection;
use App\Http\Resources\PersonResource;
use App\Models\Person;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Person $person
     * @return PersonCollection|\Illuminate\Http\Response
     */
    public function index(Person $person)
    {
        return new PersonCollection($person->all());
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
     * @param Person $person
     * @param StoreRequest $request
     * @return PersonResource
     */
    public function store(Person $person, StoreRequest $request)
    {
        $p = $person->create(
            [
                'name' => $request->input('name'),
                'height' => $request->input('height'),
                'weight' => $request->input('weight'),
            ]
        );

        return new PersonResource($p);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Person $person
     * @return PersonResource
     */
    public function show(Person $person)
    {
        return new PersonResource($person);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function edit(Person $person)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param  \App\Models\Person $person
     * @return PersonResource
     */
    public function update(UpdateRequest $request, Person $person)
    {
        $isUpdated = false;
        if ($request->input('name')) {
            $person->name = $request->input('name');
            $isUpdated = true;
        }
        if ($request->input('height')) {
            $person->height = $request->input('height');
            $isUpdated = true;
        }
        if ($request->input('weight')) {
            $person->weight = $request->input('weight');
            $isUpdated = true;
        }

        if ($isUpdated) {
            $person->save();
        }
        return new PersonResource($person);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Person $person
     * @return PersonResource
     * @throws \Exception
     */
    public function destroy(Person $person)
    {
        $person->delete();
        return new PersonResource($person);
    }
}

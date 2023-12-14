<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\ReminderRequest;
use App\Http\Resources\API\ReminderBlockResource;
use App\Http\Resources\API\ReminderSingleResource;
use App\Models\Reminder;

class ReminderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReminderRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();

        $reminder = Reminder::create($data);

        return ReminderSingleResource::make($reminder);
    }

    /**
     * Display the specified resource.
     */
    public function show(Reminder $reminder)
    {
        return ReminderBlockResource::make($reminder);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Reminder $reminder, ReminderRequest $request)
    {
        $data = $request->validated();
        $reminder->update($data);

        return ReminderSingleResource::make($reminder);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reminder $reminder)
    {
        $reminder->delete();

        return response(['ok' => true]);
    }
}

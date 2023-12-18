<?php

use App\Http\Controllers\API\ReminderController;
use App\Http\Requests\API\ReminderRequest;
use App\Http\Resources\API\ReminderBlockResource;
use App\Http\Resources\API\ReminderSingleResource;
use App\Models\Reminder;
use Mockery;

beforeEach(function () {
    $this->controller = new ReminderController();
});

it('can validate the ReminderRequest', function () {
    $this->mock(ReminderRequest::class, function ($mock) {
        $mock->shouldReceive('validated')->andReturn(['title' => 'Test Reminder']);
    });

    $request = $this->controller->store(Mockery::mock(ReminderRequest::class));

    expect($request)->toHaveValidated();
});

it('can create a reminder', function () {
    $this->mock(Reminder::class, function ($mock) {
        $mock->shouldReceive('create')->once();
    });

    $this->mock(ReminderRequest::class, function ($mock) {
        $mock->shouldReceive('validated')->andReturn(['title' => 'Test Reminder']);
    });

    $response = $this->controller->store(Mockery::mock(ReminderRequest::class));

    expect($response)->toBeInstanceOf(ReminderSingleResource::class);
});

it('can show a reminder', function () {
    $reminder = Reminder::factory()->make();

    $this->mock(Reminder::class, function ($mock) use ($reminder) {
        $mock->shouldReceive('with->latest->limit->get')->andReturn(collect([$reminder]));
    });

    $request = Mockery::mock('Illuminate\Http\Request');
    $request->limit = 10;

    $response = $this->controller->index($request);

    expect($response)->toBeInstanceOf(ReminderBlockResource::class);
});

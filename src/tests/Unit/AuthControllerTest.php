<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Resources\API\AuthResource;
use Illuminate\Http\Request;
use Mockery;

beforeEach(function () {
    $this->controller = new AuthController();
});

it('can validate the login request', function () {
    $this->mock(Request::class, function ($mock) {
        $mock->shouldReceive('validate')->once()->with([
            'email' => 'required|email',
            'password' => 'required',
        ])->andReturn(['email' => 'test@example.com', 'password' => 'password']);
    });

    $response = $this->controller->login(Mockery::mock(Request::class));

    expect($response)->toHaveValidated();
});

it('can log in a user', function () {
    $user = Mockery::mock('overload:'.config('auth.providers.users.model'));
    $user->shouldReceive('createToken')->twice()->andReturn(Mockery::self(), Mockery::self());
    $user->shouldReceive('plainTextToken')->twice()->andReturn('access_token', 'refresh_token');
    $user->access_token = 'access_token';
    $user->refresh_token = 'refresh_token';

    $this->mock(auth(), function ($mock) use ($user) {
        $mock->shouldReceive('attempt')->once()->andReturn(true);
        $mock->shouldReceive('user')->once()->andReturn($user);
    });

    $this->mock(Request::class, function ($mock) {
        $mock->shouldReceive('validate')->once()->andReturn(['email' => 'test@example.com', 'password' => 'password']);
    });

    $response = $this->controller->login(Mockery::mock(Request::class));

    expect($response)->toBeInstanceOf(AuthResource::class);
    expect($response->getData())->toHaveProperty('access_token', 'access_token');
    expect($response->getData())->toHaveProperty('refresh_token', 'refresh_token');
});

it('can handle invalid credentials on login', function () {
    $this->mock(auth(), function ($mock) {
        $mock->shouldReceive('attempt')->once()->andReturn(false);
    });

    $this->mock(Request::class, function ($mock) {
        $mock->shouldReceive('validate')->once()->andReturn(['email' => 'test@example.com', 'password' => 'wrong_password']);
    });

    $response = $this->controller->login(Mockery::mock(Request::class));

    expect($response)->toHaveStatus(401)
        ->toHaveJson([
            'ok' => false,
            'err' => 'ERR_INVALID_CREDS',
            'msg' => 'incorrect username or password',
        ]);
});

it('can log out a user', function () {
    $user = Mockery::mock('overload:'.config('auth.providers.users.model'));

    $this->mock(auth(), function ($mock) use ($user) {
        $mock->shouldReceive('user')->once()->andReturn($user);
        $mock->shouldReceive('tokens->delete')->once();
    });

    $response = $this->controller->logout();

    expect($response)->toHaveStatus(200)
        ->toHaveJson([
            'ok' => true,
            'message' => 'The user success logout',
        ]);
});

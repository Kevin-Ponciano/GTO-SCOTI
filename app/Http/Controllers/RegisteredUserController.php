<?php

namespace App\Http\Controllers;

use App\Models\TeamInvitation;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Fortify\Contracts\RegisterResponse;

class RegisteredUserController extends Controller
{
    /**
     * The guard implementation.
     *
     * @var StatefulGuard
     */
    protected $guard;

    /**
     * Create a new controller instance.
     *
     * @param StatefulGuard $guard
     * @return void
     */
    public function __construct(StatefulGuard $guard)
    {
        $this->guard = $guard;
    }

    /**
     * Create a new registered user.
     *
     * @param Request $request
     * @param CreatesNewUsers $creator
     * @return RegisterResponse
     */
    public function store(Request         $request,
                          CreatesNewUsers $creator): RegisterResponse
    {
        event(new Registered($user = $creator->create($request->all())));

        $this->guard->login($user);


        return app(RegisterResponse::class);
    }

    /**
     * Show the registration view.
     *
     * @param Request $request
     * @param $email
     * @return Application|Factory|View
     */
    public function create(Request $request, $email): Application|Factory|View
    {
        if(TeamInvitation::where('email', $email)->first()){
            return view('auth.register-with-email',['email'=>$email]);
        }else{
            return \view('errors.invitation-expired');
        }

    }
}

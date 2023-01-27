<?php

namespace App\Http\Responses;

use App\Models\TeamInvitation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;
use Laravel\Fortify\Fortify;
use Symfony\Component\HttpFoundation\Response;

class RegisterResponse implements RegisterResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param Request $request
     * @return JsonResponse|Response
     */
    public function toResponse($request): JsonResponse|Response
    {
        $teamInvitation = TeamInvitation::where('email', \Auth::user()->email)->first();
        if ($teamInvitation) {
            return redirect($teamInvitation->url);
        } else {
            return $request->wantsJson()
                ? new JsonResponse('', 201)
                : redirect()->intended(Fortify::redirects('register'));
        }
    }
}

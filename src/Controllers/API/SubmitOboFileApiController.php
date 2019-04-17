<?php

namespace A2htray\GDBMozart\Controllers\API;

use A2htray\GDBMozart\Models\OboFile;
use A2htray\GDBMozart\Models\User;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class SubmitOboFileApiController
{
    /**
     *
     * @param Request $request
     * @param Guard $guard
     */
    public function __invoke(Request $request)
    {
        $user = Auth::user();
        $oboFile = OboFile::create([
            'vocabulary_name' => $request->post('vocabularyName'),
            'remote_uri' => $request->post('remoteUrl', null),
            'local_uri' => $request->post('localUrl', null),
            'submit_user_id' => $user->id,
            'is_completed' => false,
        ]);

        return \Illuminate\Support\Facades\Response::json([
            'code' => 200,
            'data' => [
                'cmd' => sprintf('cd %s && php artisan mozart:load-obo %s %s', base_path(), $user->name, $oboFile->local_uri),
            ],
        ]);
    }
}

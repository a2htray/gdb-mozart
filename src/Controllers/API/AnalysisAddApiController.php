<?php

namespace A2htray\GDBMozart\Controllers\API;

use A2htray\GDBMozart\Models\Analysis;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;

class AnalysisAddApiController
{
    /**
     *
     * @param Request $request
     * @param Guard $guard
     */
    public function __invoke(Request $request)
    {
        $keyMap = [
            'programVersion' => 'program_version',
            'executedAt' => 'executed_at',
            'sourceURL' => 'source_uri',
            'sourceName' => 'source_name',
        ];

        $data = $request->post();
        foreach ($keyMap as $key => $realField) {
            if (isset($data[$key])) {
                $data[$realField] = $data[$key];
                unset($data[$key]);
            }
        }

        $analysis = Analysis::create($data);
//        return $request->post();
        return [
            'code' => 200,
            'data' => $analysis,
        ];

//        $user = Auth::user();
//        $oboFile = OboFile::create([
//            'vocabulary_name' => $request->post('vocabularyName'),
//            'remote_uri' => $request->post('remoteUrl', null),
//            'local_uri' => $request->post('localUrl', null),
//            'submit_user_id' => $user->id,
//            'is_completed' => false,
//        ]);
//
//        return \Illuminate\Support\Facades\Response::json([
//            'code' => 200,
//            'data' => [
//                'cmd' => sprintf('cd %s && php artisan mozart:load-obo %s %s', base_path(), $user->name, $oboFile->local_uri),
//            ],
//        ]);
    }
}

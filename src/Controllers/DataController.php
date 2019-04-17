<?php

namespace A2htray\GDBMozart\Controllers;


use A2htray\GDBMozart\Models\OboFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DataController extends Controller
{
    public function upload(Request $request)
    {
        $user = Auth::user();

        $dataType = $request->get('dataType', 'obo');

        $breadcrumbs = [
            [
                'text' => 'Data Upload',
                'disabled' => true,
            ],
        ];
        $next = [
            'disabled' => true,
        ];
        $records = [];
        switch ($dataType) {
            case 'obo':
                $next['text'] = 'Ontology';
                $records = DB::table('mozart_obo_file')
                    ->orderBy('created_at', 'desc')
                    ->get()->toArray();
//                dd($records);
                break;
            case 'fasta':
                $next['text'] = 'Sequence';
                break;
            case 'gff':
                $next['text'] = 'Annotation';
                break;
            case '':
                $next['vcf'] = 'Variation';
                break;
        }
        $breadcrumbs[] = $next;

        return view('mozart::data.' . $dataType, [
            'breadcrumbs' => $breadcrumbs,
            'records' => $records,
        ]);
    }
}

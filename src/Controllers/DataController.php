<?php

namespace A2htray\GDBMozart\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        switch ($dataType) {
            case 'obo':
                $next['text'] = 'Ontology';
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
        ]);
    }
}

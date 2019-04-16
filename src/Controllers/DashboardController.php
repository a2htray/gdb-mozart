<?php

namespace A2htray\GDBMozart\Controllers;


use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function show()
    {
        $breadcrumbs = [
            [
                'text' => 'Dashboard',
                'disabled' => true,
                'href' => 'breadcrumbs_dashboard',
            ],
        ];
        return view('mozart::dashboard', [
            'breadcrumbs' => $breadcrumbs,
        ]);
    }
}

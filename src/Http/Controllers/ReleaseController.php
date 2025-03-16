<?php

namespace E98Developer\LaravelChangelogManagerPackage\Http\Controllers;

use E98Developer\LaravelChangelogManagerPackage\Models\ChangelogRelease;
use Illuminate\Routing\Controller;

class ReleaseController extends Controller
{
    public function index()
    {
        return view('changelog-manager::layouts.app')->with('releases', ChangelogRelease::with('changelog')
            ->whereNotNull('released')
            ->limit(10)
            ->orderBy('released', 'desc')
            ->get()
        );
    }
}

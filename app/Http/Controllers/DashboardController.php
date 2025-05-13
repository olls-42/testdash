<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDomainRequest;
use App\Http\Requests\UpdateDomainRequest;
use App\Models\Domain;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Dashboard', [
            'domains' => Auth::user()->domains()->get()->forPage(1, 5) //
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDomainRequest $request)
    {
        // because we has complex validation of url with or without http scheme prefix
        Validator::make($request->all(), ['domain' => 'unique:domains'])->validate();

        if ($validated = $request->validated()) {
            Domain::create([
                'domain' => parse_url($validated['domain'], PHP_URL_HOST),
                'user_id' => Auth::user()->id
            ]);
        }

        return to_route('dashboard');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDomainRequest $request, Domain $domain)
    {
        // because we has complex validation of url
        Validator::make($request->all(), ['domain' => 'unique:domains'])->validate();

        if ($validated = $request->validated()) {
            $domain->update(['domain' => parse_url($validated['domain'], PHP_URL_HOST)]);
        }

        return to_route('dashboard');
    }
}

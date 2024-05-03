<?php

namespace App\Http\Controllers;

use App\Models\tentang;
use App\Http\Requests\StoretentangRequest;
use App\Http\Requests\UpdatetentangRequest;

class TentangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('tentang.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoretentangRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(tentang $tentang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(tentang $tentang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatetentangRequest $request, tentang $tentang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(tentang $tentang)
    {
        //
    }
}

<?php

namespace App\Services\Interfaces;

use Illuminate\Http\Request;

interface ICrudBase
{
    public function index(Request $request);

    public function store(Request $request);

    public function show($id);

    public function update($id, Request $request);

    public function destroy($id);
}

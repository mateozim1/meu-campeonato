<?php

namespace App\Http\Controllers;

use App\Models\Time;
use Illuminate\Http\Request;

class TimeController extends Controller
{
    protected $model;

    public function __construct(Time $time)
    {
        $this->model = $time;
    }

    public function index()
    {
        return $this->model::all();
    }

    public function show($id)
    {
        return $this->model::where('id', $id)->get();
    }

    public function store(Request $request)
    {
        return $this->model::create($request->all());
    }

    public function update(Request $request, $id)
    {
        return $this->model::where('id', $id)->update($request->all());
    }

    public function destroy($id)
    {
        return $this->model::where('id', $id)->delete();
    }
}

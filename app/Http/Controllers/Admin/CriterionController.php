<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Criterion;

class CriterionController extends Controller
{
    public function index()
    {
        $criteria = Criterion::withCount('questions')
            ->orderBy('id')
            ->get();

        return view('admin.criteria.index', compact('criteria'));
    }
}
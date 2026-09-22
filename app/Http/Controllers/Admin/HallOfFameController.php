<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Candidate;

class HallOfFameController extends Controller
{
    public function index()
    {
        $winners = Candidate::with([
            'employee',
            'period',
        ])
            ->where('is_winner', true)
            ->orderByDesc('period_id')
            ->get();

        return view('admin.hall-of-fame.index', compact('winners'));
    }
}
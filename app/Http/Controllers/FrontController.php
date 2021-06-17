<?php

namespace App\Http\Controllers;

use App\Company;
use App\Internship;
use App\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontController extends Controller
{
    public function index()
    {
        return view('front.index');
    }

    public function lowongan()
    {
        $companies = Company::all();
        $jobs = Job::where('status', 1)->orderBy('closed_at', 'asc')->get();
        return view('front.lowongan', compact('companies', 'jobs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'job_id' => 'required'
        ]);

        Internship::updateOrInsert(
            ['user_id' => Auth::id(), 'job_id' => $request->job_id],
            ['created_at' => now()]
        );

        return redirect()->route('pelamar.lamaranku')->with('success', 'Berhasil!');
    }
}

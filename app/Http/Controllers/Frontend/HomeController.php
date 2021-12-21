<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Support\Facades\Auth;
use App\Models\FloatManagement;

class HomeController
{
    public function index()
    {
        $float = FloatManagement::where('user_id', Auth::user()->id)
                            ->orderBy('id','desc')
                            ->pluck('running_balance')
                            ->first();

        return view('frontend.home', compact('float'));
    }
}

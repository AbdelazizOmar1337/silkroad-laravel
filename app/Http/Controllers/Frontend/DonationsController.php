<?php

namespace App\Http\Controllers\Frontend;

use App\DonationType;
use App\Http\Controllers\Controller;

class DonationsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {

        $items = DonationType::take(3)->get();

        return view('frontend.donations.index', [
            'items' => $items
        ]);

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class MaintenanceController extends Controller
{
    public function brandCache()
    {
        Cache::forget('brand_data');
        return redirect()->back();
    }
}

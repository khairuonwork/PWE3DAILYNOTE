<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Catatan;

class ChartController extends Controller
{
    public function charts()
    {
        $chartcompleted = Catatan::where('status', 'Completed')->count();
        $chartprogress = Catatan::where('status', 'Progress')->count();
        $chartpending = Catatan::where('status', 'Pending')->count();
        return view('charts', compact('chartcompleted', 'chartprogress', 'chartpending'));
    }
}

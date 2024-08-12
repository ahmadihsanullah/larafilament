<?php

namespace App\Http\Controllers;

use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function downloadPdf()
    {
        $users = User::all();

        $data = [
            'date' => date('m/d/y'),
            'users' => $users
        ];

        $pdf = PDF::loadView('userPDF', $data);

        return $pdf->download('asadeveloper.pdf');
    }

    public function userPDF($id)
    {
        $user = User::find($id);

        return response()->json($user);
    }
}

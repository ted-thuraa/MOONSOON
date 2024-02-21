<?php

namespace App\Http\Controllers\Api;

use App\Exports\FormResponceExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class DataExportController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function exportData(Request $request)
    {
        $data = $request->validate([
            'format' => 'string', 
            'headings' => 'array',
            'data' => 'array',
            
        ]);
       
        try {
            
            $headings = $data['headings'];
            $data = $data['data'];

            $headers = array(
                "Content-type" => "text/csv",
                "Content-Disposition" => "attachment; filename=file.csv",
                "Pragma" => "no-cache",
                "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
                "Expires" => "0"
            );

            $csv = Excel::store(new FormResponceExport($data, $headings), 'file.csv', 'temp_cv');


            //$csv->store('csv', public_path('temp'));
            // Return a response to stream the file
            return response()->download(public_path('temp/file.csv'), 'file.csv', $headers);
            //return response()->streamDownload(($csv), 200);
            
            //return response()->json([$data, $headings], 200);
            //return Excel::download(new FormResponceExport($data, $headings), 'file.csv');
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}

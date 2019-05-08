<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Jimmyjs\ReportGenerator\Facades\PdfReportFacade as PdfReport;

class Report extends Model
{


    public static function displayReport(Request $request)
    {
        /*
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
        $sortBy = $request->input('sort_by');
        */
        $fromDate = '2017-01-01';
        $toDate = '2019-12-12';
        $sortBy = 'nome_completo';
        $title = 'Registered User Report'; // Report title

        $meta = [ // For displaying filters description on header
            'Registered on' => $fromDate . ' To ' . $toDate,
            'Sort By' => $sortBy
        ];

        $queryBuilder = Associado::select(['matricula_antiga', 'matricula_nova', 'nome_completo']) // Do some querying..
        ->whereBetween('created_at', [$fromDate, $toDate])
            ->orderBy($sortBy);

        $columns = [
        ];

        // Generate Report with flexibility to manipulate column class even manipulate column value (using Carbon, etc).
        return PdfReport::of($title, $meta, $queryBuilder, $columns)
            ->editColumn('Criado em', [ // Change column class or manipulate its data for displaying to report
                'displayAs' => function($result) {
                    return $result->created_at->format('d M Y');
                },
                'class' => 'left'
            ])
            ->limit(50) // Limit record to be showed
            ->stream(); // other available method: download('filename') to download pdf / make() that will producing DomPDF / SnappyPdf instance so you could do any other DomPDF / snappyPdf method such as stream() or download()
    }
}

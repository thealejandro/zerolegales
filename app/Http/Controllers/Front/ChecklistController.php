<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repository\LegalDocumentTemplateRepository;
use Response;
use PDF;

class ChecklistController extends Controller
{

    private $templateRepo;


    public function __construct(LegalDocumentTemplateRepository $templateRepo)
    {
        $this->templateRepo = $templateRepo;
    }
    public function downloadCheckList($document_id){ 

        $template = $this->templateRepo->getTemplate($document_id);  

        $name = 'checklist'.date('YmdHis') . ".pdf";

        $pdf = PDF::loadView('front.pdf.checklist', compact('template'))->setPaper('a4','protrait');

        $file = storage_path('app/public/checklists').'/'.$name;

        $pdf->save($file);

        return response()->download($file);

    }
}

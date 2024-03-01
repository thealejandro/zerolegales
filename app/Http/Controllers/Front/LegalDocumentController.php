<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repository\LegalDocumentTemplateRepository;
use Illuminate\Support\Facades\Response;
use App\Repository\PriceMatrixRepository;
use App\Repository\ProfileRepository;
use Auth;

class LegalDocumentController extends Controller
{
    private $templateRepo;


    public function __construct(LegalDocumentTemplateRepository $templateRepo,PriceMatrixRepository $priceRepo,ProfileRepository $profileRepo)
    {
        $this->templateRepo = $templateRepo;
        $this->priceRepo =$priceRepo;
        $this->profileRepo=$profileRepo;
    }
    public function index(){
        $categories = $this->templateRepo->getCategory();
        if (Auth::check()){
            $auth_id = Auth::user()->id;
            $user = $this->profileRepo->getUser($auth_id);  
            if($user->user_type == 2){                       
                $profile = $this->profileRepo->getSubscriptionCategory($auth_id);
                $subscription_category = $profile['subscription_id'];
                $templates = $this->templateRepo->getAllTemplates($subscription_category);
            }
            if($user->user_type != 2){   
                 $subscription_category = 1;
                 $templates = $this->templateRepo->getAllTemplates($subscription_category);
            }       
        }
        else {         
            $templates = $this->templateRepo->getAllTemplatesWithOutAuth();
        }
        return view('front.document.index')->with(['templates' => $templates,'categories'=>$categories]);
        
    }
    public function show($id){
        $template = $this->templateRepo->getTemplateDetail($id);
        $price = $this->priceRepo->getPriceDocument($id);
        return view('front.document.view')->with(['template' => $template,'price'=>$price,'document_id'=>$id]);
    }
    public function search(Request $request)
    {
        $data = $request->search;

        if ($request->ajax())
        {
            $templates = $this->templateRepo->searchDocument($data);
           
            if ($templates)
            {
                $json_data = view('front.document.search_document')->with(['templates'=>$templates])->render();
            }
            if($templates == false) {

                $json_data = array("status" => "error", "message" => __('test.error-msg'));
            }
            return response()->json($json_data);
        }
    }
}

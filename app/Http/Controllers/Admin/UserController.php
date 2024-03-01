<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repository\UserRepository;

class UserController extends Controller
{
    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }
    public function index()
    {
        $users = $this->userRepo->all();
        return view('admin.user.index')->with(['users' => $users]);
    }
    public function changeStatus(Request $request)
    {
        $data =$request->all();
        $status = $this->userRepo->statusChange($data);
        if ($status == true) {
            if ($request->status == "1") {
                $json_data = array("status" => "success", 'message' => __('test.success-user-status_1'));
            }
            if ($request->status == "0") {
                $json_data = array("status" => "success", 'message' => __('test.success-user-status_0'));
            }
        }
        if ($status == false) {

            $json_data = array("status" => "error", 'message' => __('test.error-status'));
        }
        return response()->json($json_data);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\Contract\DashboardContract;
use App\Repository\DashboardService;

class UsersController extends Controller
{
    private DashboardContract $dashboardService;

    public function __construct(){
        $this->dashboardService = new DashboardService();
    }

    public function fetchUsersInfo(Request $request){
        $usersInfo = $this->dashboardService->fetchUsers($request->sortBy);
        return response()->json(["usersInfo"=>$usersInfo]);
    }

    public function fetchUsersRevenue(){
        $usersRevenue = $this->dashboardService->fetchUsersRevenue();
        return response()->json(["usersRevenue" => $usersRevenue]);
    }
}

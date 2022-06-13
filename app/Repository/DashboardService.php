<?php
namespace App\Repository;

use Illuminate\Support\Facades\DB;
use App\Repository\Contract\DashboardContract;

class DashboardService implements DashboardContract{

    public function fetchUsers($sortBy = "name")
    {
        return DB::select("SELECT users.id,users.name,users.avatar,users.occupation ,SUM(if(logs.type = 'impression', 1, 0)) AS impressions,SUM(if(logs.type = 'conversion', 1, 0)) AS conversions,sum(logs.revenue) as revenue FROM `users` join logs on logs.user_id = users.id group by users.id order by {$sortBy}");
    }

    public function fetchUsersRevenue(){
        return DB::select("SELECT users.id,group_concat(logs.revenue) as revenue FROM `users` join logs on users.id = logs.user_id where date(logs.time) = '2013-04-24' and type='conversion' group by users.id");
    }
}
<?php
namespace App\Repository\Contract;
interface DashboardContract{
    function fetchUsers($sortBy);
    function fetchUsersRevenue();
}
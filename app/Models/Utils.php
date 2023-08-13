<?php

namespace App\Models;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Encore\Admin\Auth\Database\Administrator;
use Faker\Factory as Faker;

class Utils
{

    public static function billSubscrsibibers()
    {
        foreach (User::where([])->get() as $key => $user) {
            $startDate = Carbon::parse($user->created_at);
            $endDate = Carbon::now();
            $period = CarbonPeriod::create($startDate->startOfMonth(), '1 month', $endDate->endOfMonth());
            $months = [];
            foreach ($period as $date) {
                $sub = Subscription::where('user_id', $user->id)
                    ->whereYear('due_date', $date->year)
                    ->whereMonth('due_date', $date->month)
                    ->first();
                if ($sub == null) {
                    $new_sub = new Subscription();
                    $new_sub->user_id = $user->id;
                    $new_sub->paid = 'No';
                    $new_sub->amount = 1000;
                    $new_sub->due_date = $date;
                    $new_sub->save();
                }
            }
        }
    }

    /* public static function generateUsers()
    {
        die("generatign users");
        $faker = Faker::create();
        for ($x = 0; $x < 100; $x++) {

            $u = new Administrator();
            $u->username = $faker->email();
            $u->name = $faker->name();
            $now = Carbon::now();
            $now->subMonth(rand(0, 12));
            $u->created_at = $now;
            $u->password = password_hash('4321', PASSWORD_DEFAULT);
            $u->save();
        }
        die("generatign users");
    } */
}

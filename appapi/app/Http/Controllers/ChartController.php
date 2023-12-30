<?php

namespace App\Http\Controllers;

use App\Models\Subscribers;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use Carbon\Carbon;

class ChartController extends Controller
{
    //
    public function subscriptionChart()
    {
        // $subscribers = Subscribers::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
        //     ->whereYear('created_at', date('Y'))
        //     ->groupBy('month')
        //     ->orderBy('month')
        //     ->get();
        // $labels = [];
        // $data = [];
        // $colors = ['#f2d2a9', '#b3c9f4', '#d5d5d5', '#dddddd', '#b3c9f4', '#6d7e86', '#b79173', '#cfc89a', '#6d05ff', '#c53645', '#51bb93', '#679173'];

        // for ($i = 1; $i < 12; $i++) {
        //     $month = date('F', mktime(0, 0, 0, $i, 1));
        //     $count = 0;
        //     foreach ($subscribers as $subscriber) {
        //         if ($subscriber->month == $i) {
        //             $count = $subscriber->count;
        //             break;
        //         }
        //     }
        //     array_push($labels, $month);
        //     array_push($data, $count);
        // }

        // $datasets = [
        //     [
        //         'label' => 'Users',
        //         'data' => $data,
        //         'backgroundColor' => $colors
        //     ]
        // ];
        // return view('reports.subscription', compact('datasets', 'labels'));
        /////try2
        // $currentMonth = Carbon::now()->format('m');
        // $currentYear = Carbon::now()->format('Y');

        // $monthlyIncomes = Subscription::whereMonth('created_at', $currentMonth)
        //     ->whereYear('created_at', $currentYear)
        //     ->get();

        // $data = $monthlyIncomes->groupBy(function ($date) {
        //     return Carbon::parse($date->income_date)->format('d');
        // })->map(function ($dayIncomes) {
        //     return $dayIncomes->sum('amount');
        // });

        // // return view('reports.monthly_income', compact('data'));
        // return view('reports.subscription', compact('data'));

        ///try3 

        $monthlyIncome = DB::table('subscribers')
            ->select(DB::raw('YEAR(created_at) as year, MONTH(created_at) as month'), DB::raw('SUM(price) as total_income'))
            ->groupBy('year', 'month')
            ->get();

        foreach ($monthlyIncome as $income) {
            $year = $income->year;
            $month = $income->month;
            $totalIncome = $income->total_income;

            // Do something with the grouped data
            echo "Year: $year, Month: $month, Total Income: $totalIncome\n";
        }
    }
    public function getTotalPriceByMonth($subscriberId)
    {
        // Get the total price from the subscriptions table grouped by month
        $totalPricesByMonth = DB::table('subscriptions')
            ->where('subscription_id', $subscriberId)
            ->selectRaw('MONTH(created_at) as month, SUM(price) as total_price')
            ->groupBy('month')
            ->get();

        return view('your.view', compact('totalPricesByMonth'));
    }
    public function getMonthlySum(Carbon $date)
    {
        $year = $date->year;
        $month = $date->month;

        if ($month < 10) {
            $month = '0' . $month;
        }

        $search = $year . '-' . $month;

        $revenues = parent::where('date', 'like', $search . '%')->get();

        $sum = 0;
        foreach ($revenues as $revenue) {
            $sum += $revenue->revenue;
        }

        return $sum;
    }
    public function getMonthlyIncome(string $month)
    {

        $totalIncome = Subscribers::whereMonth('created_at', $month)->whereHas('subscription', function ($q) {
            $q->sum('subs_price');
        });
        return view('reports.subscription', compact('totalIncome'));

    }

    //WORKING
    public function displayTotalIncomeByMonth()
    {
        // Get total income by month
        $monthlyIncome = Subscribers::select(DB::raw('MONTH(created_at) as month'), DB::raw('SUM(price) as total_income'))
            ->groupBy('month')
            ->get();
        Session::forget('type');

        Session::put('type', 'Monthly');
        // Pass data to the view

        return view('reports.income.monthly', compact('monthlyIncome'));
    }

    public function displayYearlyIncome()
    {
        // Get yearly income
        $yearlyIncome = Subscribers::select(DB::raw('YEAR(created_at) as year'), DB::raw('SUM(price) as total_income'))
            ->groupBy('year')
            ->get();
        Session::forget('type');

        Session::put('type', 'Annually');
        // Pass data to the view
        return view('reports.income.annually', compact('yearlyIncome'));
    }

}

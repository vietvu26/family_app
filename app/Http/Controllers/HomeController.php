<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Person;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
    public function index()
    {
        $people = Person::all();
        $tree = $this->buildTree($people);
        return view('test', compact('tree'));
    }

    private function buildTree($people, $parentId = 0)
    {
        $branch = [];
        foreach ($people as $person) {
            if ($person->parent_id == $parentId) {
                $children = $this->buildTree($people, $person->id);
                if ($children) {
                    $person->children = $children;
                }
                $branch[] = $person;
            }
        }
        return $branch;
    }
    public function thuchi()
    {
        return view('report.thuchi');
    }
    public function generateReport(Request $request)
{
    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');

    if ($this->isSameYear($startDate, $endDate)) {
        // Trường hợp bắt đầu và kết thúc trong cùng một năm
        $thuData = DB::table('dong')
            ->select(DB::raw('MONTH(payment_date) as month, SUM(amount) as total_amount'))
            ->whereYear('payment_date', '=', date('Y', strtotime($startDate)))
            ->whereBetween('payment_date', [$startDate, $endDate])
            ->groupBy(DB::raw('MONTH(payment_date)'))
            ->get();

        $chiData = DB::table('khoanchi')
            ->select(DB::raw('MONTH(payment_date) as month, SUM(amount) as total_amount'))
            ->whereYear('payment_date', '=', date('Y', strtotime($startDate)))
            ->whereBetween('payment_date', [$startDate, $endDate])
            ->groupBy(DB::raw('MONTH(payment_date)'))
            ->get();

        $chartData = $this->prepareMonthlyChartData($thuData, $chiData);
        $chartType = 'month';
    } else {
        // Trường hợp bắt đầu và kết thúc trong nhiều năm
        $thuData = DB::table('dong')
            ->select(DB::raw('YEAR(payment_date) as year, SUM(amount) as total_amount'))
            ->whereBetween('payment_date', [$startDate, $endDate])
            ->groupBy(DB::raw('YEAR(payment_date)'))
            ->get();

        $chiData = DB::table('khoanchi')
            ->select(DB::raw('YEAR(payment_date) as year, SUM(amount) as total_amount'))
            ->whereBetween('payment_date', [$startDate, $endDate])
            ->groupBy(DB::raw('YEAR(payment_date)'))
            ->get();

        $chartData = $this->prepareYearlyChartData($thuData, $chiData);
        $chartType = 'year';
    }

    return view('report.thuchi', compact('startDate', 'endDate', 'chartData', 'chartType'));
}

private function prepareMonthlyChartData($thuData, $chiData)
{
    $chartData = ['labels' => [], 'thu_values' => [], 'chi_values' => []];

    $months = range(1, 12);
    foreach ($months as $month) {
        $chartData['labels'][] = date('F', mktime(0, 0, 0, $month, 1));
        $thu = $thuData->firstWhere('month', $month);
        $chi = $chiData->firstWhere('month', $month);
        $chartData['thu_values'][] = $thu ? $thu->total_amount : 0;
        $chartData['chi_values'][] = $chi ? $chi->total_amount : 0;
    }

    return $chartData;
}

private function prepareYearlyChartData($thuData, $chiData)
{
    $chartData = ['labels' => [], 'thu_values' => [], 'chi_values' => []];

    $years = $thuData->pluck('year')->merge($chiData->pluck('year'))->unique()->sort();
    foreach ($years as $year) {
        $chartData['labels'][] = $year;
        $thu = $thuData->firstWhere('year', $year);
        $chi = $chiData->firstWhere('year', $year);
        $chartData['thu_values'][] = $thu ? $thu->total_amount : 0;
        $chartData['chi_values'][] = $chi ? $chi->total_amount : 0;
    }

    return $chartData;
}
private function isSameYear($date1, $date2)
    {
        return date('Y', strtotime($date1)) === date('Y', strtotime($date2));
    }

}

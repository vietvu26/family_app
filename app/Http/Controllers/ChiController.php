<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chi;
use Illuminate\Support\Facades\DB;

class ChiController extends Controller
{
    public function create()
    {
        $chi = Chi::all();
        return view('thuchi.createchi', compact('chi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string|max:255',
            'note' => 'required',
            
        ]);

        Chi::create([
            'type' => $request->type,
            'note' => $request->note,
            
        ]);

        return redirect()->route('admin.chi.manage')->with('success', 'Khoản chi đã được thêm thành công!');
    }

    public function manage()
    {
        $chis = Chi::all();
        return view('thuchi.chi', ['chis' => $chis]);
    }

    public function edit(Chi $chi)
    {
        return view('thuchi.editchi', ['chi' => $chi]);
    }

    public function update(Request $request, Chi $chi)
    {
        $request->validate([
            'type' => 'required',
            'note' => 'required',
        ]);
        if (
            $chi->type == $request->type &&
            $chi->note == $request->note
           
        ) {
            return redirect()->route('admin.chi.edit', $chi)->with('error', 'Không có gì thay đổi');
        }
        $chi->update($request->all());
        return redirect()->route('admin.chi.edit', $chi)->with('success', 'Thay đổi loại hình chi thành công ');
    }

    public function delete($id)
    {
        $chi = Chi::find($id);
        if ($chi == null) {
            return redirect()->route('admin.chi.manage')->with('error', 'Không tìm thấy khoản chi');
        } else {
            $chi->delete();
        }
        return redirect()->route('admin.chi.manage')->with('success', 'Xóa khoản chi thành công');
    }
    public function index()
    {
        return view('report.chi');
    }
    public function generateReport(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
    
        if ($this->isSameYear($startDate, $endDate)) {
            // Trường hợp bắt đầu và kết thúc trong cùng một năm
            $data = DB::table('khoanchi')
                ->select(DB::raw('MONTH(payment_date) as month, SUM(amount) as total_amount'))
                ->whereYear('payment_date', '=', date('Y', strtotime($startDate)))
                ->whereBetween('payment_date', [$startDate, $endDate])
                ->groupBy(DB::raw('MONTH(payment_date)'))
                ->get();
            
            $chartData = $this->prepareMonthlyChartData($data);
            $chartType = 'month';
        } else {
            // Trường hợp bắt đầu và kết thúc trong nhiều năm
            $data = DB::table('khoanchi')
                ->select(DB::raw('YEAR(payment_date) as year, SUM(amount) as total_amount'))
                ->whereBetween('payment_date', [$startDate, $endDate])
                ->groupBy(DB::raw('YEAR(payment_date)'))
                ->get();
            
            $chartData = $this->prepareYearlyChartData($data);
            $chartType = 'year';
        }
    
        return view('report.thu', compact('startDate', 'endDate', 'chartData', 'chartType'));
    }
    
    private function isSameYear($date1, $date2)
    {
        return date('Y', strtotime($date1)) === date('Y', strtotime($date2));
    }
    
    private function prepareMonthlyChartData($data)
    {
        $chartData = [];
        foreach ($data as $item) {
            $chartData['labels'][] = date('F', mktime(0, 0, 0, $item->month, 1));
            $chartData['values'][] = $item->total_amount;
        }
        return $chartData;
    }
    
    private function prepareYearlyChartData($data)
    {
        $chartData = [];
        foreach ($data as $item) {
            $chartData['labels'][] = $item->year;
            $chartData['values'][] = $item->total_amount;
        }
        return $chartData;
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Thu;
use Illuminate\Support\Facades\DB;

class ThuController extends Controller
{
    public function create()
    {
        return view('thuchi.createthu');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'year' => 'required',
            'amount' => 'required', 
            'note' => 'required',
            
        ]);
        
        // Lưu vào cơ sở dữ liệu
        $thu = new Thu();
        $thu->year = $request->input('year');
        $thu->amount = $request->input('amount');
        $thu->note = $request->input('note');
      
        $thu->save();
        
        return redirect()->route('admin.thu.manage')->with('success', 'Thêm định mức thu thành công');
    }
    public function manage()
    {
        
        $thus = Thu::all();
        
        return view('thuchi.dmthu', ['thus' => $thus]);
    }
    public function edit(Thu $thu)
    {
        return view('thuchi.edithu', ['thu' => $thu]);
    }
    public function update(Request $request, Thu $thu)
    {
        $request->validate([
            'year' => 'required',
            'amount' => 'required', 
            'note' => 'required',
        ]);
        if (
            $thu->year == $request->year &&
            $thu->amount == $request->amount &&
            $thu->note == $request->note
           
        ) {
            return redirect()->route('admin.thu.edit', $thu)->with('error', 'Không có gì thay đổi');
        }
        $thu->update($request->all());
        return redirect()->route('admin.thu.edit', $thu)->with('success', 'Thay đổi định mức thu thành công ');
    }
    public function delete($id)
    {
        $thu = Thu::find($id);
        if ($thu == null) {
            return redirect()->route('admin.thu.manage')->with('error', 'Không tìm thấy định mức thu trên');
        } else {
            $thu->delete();
        }
        return redirect()->route('admin.thu.manage')->with('success', 'Xóa định mức thu theo năm thành công');
    }
    public function index()
    {
        return view('report.thu');
    }


    public function generateReport(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
    
        if ($this->isSameYear($startDate, $endDate)) {
            // Trường hợp bắt đầu và kết thúc trong cùng một năm
            $data = DB::table('dong')
                ->select(DB::raw('MONTH(payment_date) as month, SUM(amount) as total_amount'))
                ->whereYear('payment_date', '=', date('Y', strtotime($startDate)))
                ->whereBetween('payment_date', [$startDate, $endDate])
                ->groupBy(DB::raw('MONTH(payment_date)'))
                ->get();
            
            $chartData = $this->prepareMonthlyChartData($data);
            $chartType = 'month';
        } else {
            // Trường hợp bắt đầu và kết thúc trong nhiều năm
            $data = DB::table('dong')
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

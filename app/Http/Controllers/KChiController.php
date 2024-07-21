<?php

namespace App\Http\Controllers;

use App\Models\KhoanChi;
use Illuminate\Http\Request;
use App\Models\Thu;
use App\Models\Chi;

class KChiController extends Controller
{
    public function create()
    {
        $chis = Chi::all();
        $thus = Thu::all(); // Lấy tất cả các bản ghi Thu
        return view('thuchi.kchicreate', compact('thus','chis'));
    }
    
    public function store(Request $request)
{
    $request->validate([
        'thu_id' => 'required',
        'chi_id' => 'required',
        'name' => 'required',
        'amount' => 'required|numeric',
        'payment_date' => [
            'required',
            'date',
            function ($attribute, $value, $fail) use ($request) {
                $selectedYear = $request->input('thu_id');
                $year = Thu::findOrFail($selectedYear)->year;
                $startDate = "$year-01-01";
                $endDate = "$year-12-31";

                if ($value < $startDate || $value > $endDate) {
                    $fail("Ngày chi phải trong năm $year.");
                }
            },
        ],
    ]);

    // Create a new Dong instance
    $kchi = new KhoanChi();
    $kchi->thu_id = $request->input('thu_id');
    $kchi->chi_id = $request->input('chi_id');
    $kchi->name = $request->input('name');
    $kchi->amount = $request->input('amount');
    $kchi->payment_date = $request->input('payment_date');
    $kchi->save();

    return redirect()->route('admin.kchi.manage')->with('success', 'Thêm khoản chi thành công');
}

    
    public function manage(Request $request)
    {
        $yearId = $request->input('year_id');
        $thus = Thu::all();
        $chis = Chi::all();
        $kchis = KhoanChi::when($yearId, function ($query, $yearId) {
            return $query->where('thu_id', $yearId);
        })->get();
    
        return view('thuchi.kchi', compact('thus', 'kchis', 'yearId','chis' ));
    }
    
    public function edit(KhoanChi $kchi)
    {
        $thu = Thu::find($kchi->thu_id);
        $chis = Chi::all();
        $kchi->amount = (float) preg_replace('/[^\d.]/', '', $kchi->amount);

        return view('thuchi.editkchi', ['kchi' => $kchi, 'thu' => $thu, 'chis' => $chis]);
    }
    
    public function update(Request $request, $id)
    {
        $kchi = KhoanChi::find($id);
    
        // Lấy năm từ thu_id
        $thuYear = $kchi->thu->year;
        $chitype = $kchi->chi->type;
        $request->validate([
            'name' => 'required',
            'amount' => 'required|numeric',
            'payment_date' => [
                'required',
                'date',
                function ($attribute, $value, $fail) use ($thuYear) {
                    $paymentYear = date('Y', strtotime($value));
                    if ($paymentYear != $thuYear) {
                        $fail('Ngày thu phải nằm trong năm ' . $thuYear . '.');
                    }
                },
            ],
        ]);
    
        if (
            $kchi->name == $request->name &&
            $kchi->amount == $request->amount &&
            $kchi->payment_date == $request->payment_date 
        ) {
            return redirect()->route('admin.kchi.edit', $kchi)->with('error', 'Không có gì thay đổi');
        }
    
        $kchi->update($request->all());

    
        return redirect()->route('admin.kchi.edit', $kchi)->with('success', 'Thay đổi ghi nhận chi thành công');
    }
    
    public function delete($id)
    {
        $kchi = KhoanChi::find($id);
        if ($kchi == null) {
            return redirect()->route('admin.kchi.manage')->with('error', 'Không tìm thấy khoản chi');
        } else {
            $kchi->delete();
        }
        return redirect()->route('admin.kchi.manage')->with('success', 'Xóa thành công');
    }
}

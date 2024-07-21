<?php

namespace App\Http\Controllers;
use App\Models\Thu;
use App\Models\Person;
use App\Models\Dong;
use Illuminate\Http\Request;

class DongController extends Controller
{
    public function create()
    {
        $people = Person::all();
        $thus = Thu::all(); // Lấy tất cả các bản ghi Thu
        return view('thuchi.createdong', compact('thus', 'people'));
    }
    
    public function store(Request $request)
{
    $request->validate([
        'thu_id' => 'required',
        'person_id' => 'required',
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
                    $fail("Ngày đóng phải trong năm $year.");
                }
            },
        ],
        'note' => 'nullable|string|max:255',
    ]);

    // Create a new Dong instance
    $dong = new Dong();
    $dong->thu_id = $request->input('thu_id');
    $dong->person_id = $request->input('person_id');
    $dong->amount = $request->input('amount');
    $dong->payment_date = $request->input('payment_date');
    $dong->note = $request->input('note');
    $dong->save();

    return redirect()->route('admin.dong.manage')->with('success', 'Thêm người đóng thành công');
}

    
    public function manage(Request $request)
    {
        $yearId = $request->input('year_id');
        $thus = Thu::all();
        $people = Person::all();
        $dongs = Dong::when($yearId, function ($query, $yearId) {
            return $query->where('thu_id', $yearId);
        })->get();
    
        return view('thuchi.dong', compact('thus', 'dongs', 'yearId', 'people'));
    }
    
    public function edit(Dong $dong)
    {
        $thu = Thu::find($dong->thu_id);
        $dong->amount = (float) preg_replace('/[^\d.]/', '', $dong->amount);

        $people = Person::all(); // Lấy tất cả người từ bảng people
        return view('thuchi.editdong', ['dong' => $dong, 'thu' => $thu, 'people' => $people]);
    }
    
    public function update(Request $request, $id)
    {
        $dong = Dong::find($id);
    
        // Lấy năm từ thu_id
        $thuYear = $dong->thu->year;

        $request->validate([
            'person_id' => 'required',
            'amount' => 'required|numeric',
            'payment_date' => [
                'required',
                'date',
                function ($attribute, $value, $fail) use ($thuYear) {
                    $paymentYear = date('Y', strtotime($value));
                    if ($paymentYear != $thuYear) {
                        $fail('Ngày đóng phải nằm trong năm ' . $thuYear . '.');
                    }
                },
            ],
            'note' => 'nullable|string|max:255',
        ]);
    
        if (
            $dong->person_id == $request->person_id &&
            $dong->amount == $request->amount &&
            $dong->payment_date == $request->payment_date &&
            $dong->note == $request->note
        ) {
            return redirect()->route('admin.dong.edit', $dong)->with('error', 'Không có gì thay đổi');
        }
    
        $dong->update($request->all());

    
        return redirect()->route('admin.dong.edit', $dong)->with('success', 'Thay đổi người đóng thành công');
    }
    
    public function delete($id)
    {
        $dong = Dong::find($id);
        if ($dong == null) {
            return redirect()->route('admin.dong.manage')->with('error', 'Không tìm thấy người trên');
        } else {
            $dong->delete();
        }
        return redirect()->route('admin.dong.manage')->with('success', 'Xóa thành công');
    }
}

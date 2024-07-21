<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    public function create()
    {
        $people = Person::all();
        return view('create', compact('people'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'required|in:male,female',
            'birth_date' => 'nullable|date',
            'death_date' => 'nullable|date',
            'parent_id' => 'nullable|integer|exists:people,id',
        ]);

        Person::create([
            'name' => $request->name,
            'gender' => $request->gender,
            'birth_date' => $request->birth_date,
            'death_date' => $request->death_date,
            'parent_id' => $request->parent_id,
        ]);

        return redirect()->route('admin.person.manage')->with('success', 'Người đã được thêm thành công!');
    }

    public function manage()
    {
        $persons = Person::all();
        return view('manage', ['persons' => $persons]);
    }

    public function edit(Person $person)
    {
        $people = Person::all();
        return view('edit', compact('person', 'people'));
    }

    public function update(Request $request, Person $person)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'required|in:male,female',
            'birth_date' => 'nullable|date',
            'death_date' => 'nullable|date',
            'parent_id' => 'nullable|integer|exists:people,id',
        ]);

        $person->update([
            'name' => $request->name,
            'gender' => $request->gender,
            'birth_date' => $request->birth_date,
            'death_date' => $request->death_date,
            'parent_id' => $request->parent_id,
        ]);

        return redirect()->route('admin.person.edit', $person)->with('success', 'Thông tin người đã được cập nhật thành công!');
    }

    public function delete($id)
    {
        $person = Person::find($id);
        if ($person == null) {
            return redirect()->route('admin.person.manage')->with('error', 'Person not found');
        } else {
            $person->delete();
        }
        return redirect()->route('admin.person.manage')->with('success', 'Person deleted successfully');
    }

    public function showProfile($id)
    {
        $person = Person::find($id);
        if (!$person) {
            return redirect()->route('/')->with('error', 'Person not found');
        }

        return view('profile', compact('person'));
    }

    public function updatePicture(Request $request, $id)
    {
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $person = Person::findOrFail($id);

        if ($request->hasFile('profile_picture')) {
            $image = $request->file('profile_picture');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('profile_pic'), $imageName);

            // Xóa ảnh cũ nếu có
            if ($person->profile_pic) {
                File::delete(public_path('profile_pic/' . $person->profile_pic));
            }

            // Lưu ảnh mới
            $person->profile_picture = $imageName;
            $person->save();

            return redirect()->back()->with('success', 'Cập nhật ảnh đại diện thành công.');
        }

        return redirect()->back()->with('error', 'Có lỗi xảy ra khi cập nhật ảnh đại diện.');
    }
}

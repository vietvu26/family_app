@extends('layouts.app')

@section('main')
@if (session('success'))
    <div class="success-message">
        <div class="toast align-items-center" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    {{ session('success') }}
                </div>
                <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
@endif
@if (session('error'))
    <div class="error-message">
        <div class="toast align-items-center" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    {{ session('error') }}
                </div>
                <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
@endif

<div class="container mt-4 h-100 manage-job">
    <div class="row">
        <div class="col-md-12">
            <a href="{{ route('admin.person.create') }}" class="btn btn-primary">Thêm người</a>
            <a href="{{ route('admin.tree') }}" class="btn btn-primary">Xem cây gia phả</a>
            <table class="table table-bordered mt-4">
                <thead>
                    <tr>
                        <th class="fw-bold">Họ và tên</th>
                        <th class="fw-bold">Giới tính</th>
                        <th class="fw-bold">Năm sinh</th>
                        <th class="fw-bold">Năm mất</th>
                        <th class="fw-bold">Thế hệ thứ</th>
                        <th class="fw-bold">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($persons as $person)
                        <tr>
                            <td>{{ $person->name }}</td>
                            <td>{{ $person->gender }}</td>
                            <td>{{ $person->birth_date }}</td>
                            <td>{{ $person->death_date }}</td>
                            <td>{{ $person->parent_id }}</td>
                            <td class="btn-action">
                                <a href="{{ route('admin.person.edit', $person->id) }}" class="btn btn-primary edit-button">Edit</a>
                                <form action="{{ route('admin.person.delete', $person->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger delete-button mt-2" onclick="return confirm('Bạn có chắc xóa người này khỏi danh sách không?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Không có dữ liệu</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection

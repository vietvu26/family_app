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
            <a href="{{ route('admin.chi.create') }}" class="btn btn-primary">Thêm loại chi</a>
            <table class="table table-bordered mt-4">
                <thead>
                    <tr>
                        <th class="fw-bold">Tên loại chi</th>
                        <th class="fw-bold">Ghi chú</th>
                        <th class="fw-bold">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($chis as $chi)
                        <tr>
                            <td>{{ $chi->type }}</td>
                            <td>{{ $chi->note }}</td>
                            <td>
                                <a href="{{ route('admin.chi.edit', $chi->id) }}" class="btn btn-primary">Sửa</a>
                                <form action="{{ route('admin.chi.delete', $chi->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa loại chi này ?')">Xóa</button>
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

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
        <div class="col-md-6">
            <a href="{{ route('admin.kchi.create') }}" class="btn btn-primary">Thêm khoản chi </a>
        </div>
        <div class="col-md-6 d-flex justify-content-end align-items-center">
            <select name="year" id="year" class="form-select ms-2" onchange="fetchContributorsByYear(this.value)">
                <option value="" selected disabled>Chọn năm</option>
                @foreach($thus as $thu)
                    <option value="{{ $thu->id }}" {{ isset($yearId) && $yearId == $thu->id ? 'selected' : '' }}>
                        {{ $thu->year }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered mt-4">
                <thead>
                    <tr>
                        <th class="fw-bold">Loại chi</th>
                        <th class="fw-bold">Người được chi</th>
                        <th class="fw-bold">Số tiền</th>
                        <th class="fw-bold">Ngày chi</th>
                        <th class="fw-bold">Thao tác</th>
                    </tr>
                </thead>
                <tbody id="contributor-list">
                    @if ($kchis->isNotEmpty())
                        @foreach($kchis as $kchi)
                            <tr>
                                <td>{{ $kchi->chi->type }}</td> <!-- Sửa lại dòng này để hiển thị tên người -->
                                <td>{{ $kchi->name }}</td>
                                <td>{{ number_format((float) preg_replace('/[^\d.]/', '', $kchi->amount), 0, ',', '.') }} VND</td>
                                <td>{{ $kchi->payment_date }}</td>
                                <td class="btn-action">
                                    <a href="{{ route('admin.kchi.edit', $kchi->id) }}" class="btn btn-primary edit-button">Edit</a>
                                    <form action="{{ route('admin.kchi.delete', $kchi->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger delete-button mt-2" onclick="return confirm('Bạn có chắc xóa người này khỏi danh sách không?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6" class="text-center">Không có dữ liệu</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function fetchContributorsByYear(yearId) {
        window.location.href = "{{ route('admin.kchi.manage') }}" + "?year_id=" + yearId;
    }
</script>

<style>
    .manage-job .form-select {
        width: auto;
    }
</style>
@endsection

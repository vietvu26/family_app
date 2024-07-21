@extends ('layouts.app')
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
            <a href="{{ route('admin.thu.create') }}" class="btn btn-primary">Thêm định mức thu</a>
            <table class="table table-bordered mt-4">
                <thead>
                    <tr>
                        <th class="fw-bold">Năm</th>
                        <th class="fw-bold">Số tiền</th>
                        <th class="fw-bold">Ghi chú</th>
                        <th class="fw-bold">Thao tác</th>

                    </tr>
                </thead>
                <tbody>
                    @if ($thus->isNotEmpty())
                        @foreach($thus as $thu)
                            <tr>
                                <td>{{ $thu->year }}</td>
                                <td>{{ $thu->amount }}</td>
                                <td>{{ $thu->note }}</td>
                                <td class="btn-action">
                                    <a href="{{ route('admin.thu.edit', $thu->id) }}"
                                        class="btn btn-primary edit-button">Edit</a>
                                    <form action="{{ route('admin.thu.delete', $thu->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger delete-button mt-2"
                                            onclick="return confirm('Bạn có chắc xóa định mức thu năm này không ')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="8" class="text-center">Chưa có định mức thu được thiết lập</td>
                        </tr>
                    @endif
                </tbody>
            </table>
            {{-- <div class="d-flex justify-content-center">
                {{ $person->links() }}
            </div> --}}
        </div>
    </div>
</div>
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
@endsection
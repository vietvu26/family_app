@extends ('layouts.app')
@section('main')
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
<form action="{{ route('admin.thu.update', $thu->id) }}" method="post" class="container mt-4 mb-4">
    @csrf

    <div class="form-group">
        <label for="title">Năm</label>
        <input type="text" name="year" id="year" value="{{$thu->year}}" class="form-control">
        @error('year')
        <div class="error-validate mt-3">{{ $message }}</div>
        @enderror
    </div>
    
    <div class="form-group">
        <label for="title">Số tiền</label>
        <input type="text" name="amount" id="amount" class="form-control" value="{{$thu->amount}}">
    @error('birth_date')
    <div class="error-validate mt-3">{{ $message }}</div>
    @enderror
    </div>
    <!-- select job type -->
    <div class="form-group">
        <label for="title">Ghi chú</label>
        <input type="text" name="note" id="note" class="form-control" value="{{$thu->note}}">
        @error('death_date')
        <div class="error-validate mt-3">{{ $message }}</div>
        @enderror
    </div>
    
    <div class="form-group mt-4">
        <button type="submit" class="btn btn-primary">Sửa thông tin </button>
    </div>
</form>
@if (session('success'))
<script>
document.addEventListener('DOMContentLoaded', (event) => {
    var toast = new bootstrap.Toast(document.querySelector('.toast'));
    toast.show();
});
</script>
@endif
@endsection
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
<form action="{{ route('admin.chi.store') }}" method="post" class="container mt-4 mb-4">
    @csrf

    
    <div class="form-group">
        <label for="title">Tên loại chi</label>
   
            <input type="text" name="type" id="type" value="{{old('type')}}" class="form-control">
     
        @error('type')
        <div class="error-validate mt-3">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="title">Ghi chú </label>
        <input type="text" name="note" id="note" class="form-control" value="{{ old('note') }}">
    @error('note')
    <div class="error-validate mt-3">{{ $message }}</div>
    @enderror
    </div>
    <div class="form-group mt-4">
        <button type="submit" class="btn btn-primary">Thêm loại chi </button>
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
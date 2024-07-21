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
<form action="{{ route('admin.person.update', $person->id) }}" method="post" class="container mt-4 mb-4">
    @csrf

    <div class="form-group">
        <label for="title">Họ và tên</label>
        <input type="text" name="name" id="name" value="{{$person->name}}" class="form-control">
        @error('name')
        <div class="error-validate mt-3">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="gender">Giới tính</label>
        <select name="gender" id="gender" class="form-control">
            <option value="male" @if(old('gender') == 'male') selected @endif>Nam</option>
            <option value="female" @if(old('gender') == 'female') selected @endif>Nữ</option>
        </select>
        @error('gender')
        <div class="error-validate mt-3">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="birth_date">Ngày tháng năm sinh </label>
        <input type="date" name="birth_date" id="birth_date" class="form-control" value="{{$person->birth_date}}">
    @error('birth_date')
    <div class="error-validate mt-3">{{ $message }}</div>
    @enderror
    </div>
    <!-- select job type -->
    <div class="form-group">
        <label for="death_date">Ngày tháng năm mất </label>
        <input type="date" name="death_date" id="death_date" class="form-control" value="{{$person->death_date}}">
        @error('death_date')
        <div class="error-validate mt-3">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="parent_id">Là con của</label>
        <select name="parent_id" id="parent_id" class="form-control">
            <option value="">Không có</option>
            @foreach($people as $otherPerson)
                <option value="{{ $otherPerson->id }}" @if($person->parent_id == $otherPerson->id) selected @endif>{{ $otherPerson->name }}</option>
            @endforeach
        </select>
        @error('parent_id')
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
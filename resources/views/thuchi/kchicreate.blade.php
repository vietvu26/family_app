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

<form action="{{ route('admin.kchi.store') }}" method="post" class="container mt-4 mb-4">
    @csrf

    <div class="form-group">
        <label for="thu_id">Năm chi</label>
        <select name="thu_id" id="thu_id" class="form-select">
            @foreach($thus as $thu)
                <option value="{{ $thu->id }}" {{ old('thu_id') == $thu->id ? 'selected' : '' }}>
                    {{ $thu->year }}
                </option>
            @endforeach
        </select>
        @error('thu_id')
            <div class="error-validate mt-3">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="chi_id">Loại chi</label>
        <select name="chi_id" id="chi_id" class="form-select">
            @foreach($chis as $chi)
                <option value="{{ $chi->id }}" {{ old('chi_id') == $chi->id ? 'selected' : '' }}>
                    {{ $chi->type }}
                </option>
            @endforeach
        </select>
        @error('chi_id')
            <div class="error-validate mt-3">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="name">Nguời được chi</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control">
        @error('name')
            <div class="error-validate mt-3">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="amount">Số tiền chi</label>
        <input type="text" name="amount" id="amount" value="{{ old('amount') }}" class="form-control">
        @error('amount')
            <div class="error-validate mt-3">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="payment_date">Ngày đóng</label>
        <input type="date" name="payment_date" id="payment_date" value="{{ old('payment_date') }}" class="form-control">
        @error('payment_date')
            <div class="error-validate mt-3">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group mt-4">
        <button type="submit" class="btn btn-primary">Thêm khoản chi</button>
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

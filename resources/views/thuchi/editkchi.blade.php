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

<form action="{{ route('admin.kchi.update', $kchi->id) }}" method="post" class="container mt-4 mb-4">
    @csrf

    <div class="form-group">
        <label for="thu_id">Năm đóng:</label>
        <input type="text" name="thu_id" id="thu_id" value="{{ $kchi->thu->year }}" class="form-control" disabled>
        @error('thu_id')
            <div class="error-validate mt-3">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="chi_id">Loại chi:</label>
        <select name="chi_id" id="chi_id" class="form-select">
            @foreach($chis as $chi)
                <option value="{{ $chi->id }}" {{ $kchi->chi_id == $chi->id ? 'selected' : '' }}>
                    {{ $chi->type }}
                </option>
            @endforeach
        </select>
        @error('chi_id')
            <div class="error-validate mt-3">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="name">Nguời được chi:</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ $kchi->name }}">
        @error('amount')
            <div class="error-validate mt-3">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="amount">Số tiền:</label>
        <input type="text" name="amount" id="amount" class="form-control" value="{{ number_format((float) $kchi->amount, 0, ',', '.') }} VND">
        @error('amount')
            <div class="error-validate mt-3">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="payment_date">Ngày chi:</label>
        <input type="date" name="payment_date" id="payment_date" value="{{ $kchi->payment_date }}" class="form-control">
        @error('payment_date')
            <div class="error-validate mt-3">{{ $message }}</div>
        @enderror
    </div>



    <div class="form-group mt-4">
        <button type="submit" class="btn btn-primary">Sửa thông tin</button>
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

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

<form action="{{ route('admin.dong.update', $dong->id) }}" method="post" class="container mt-4 mb-4">
    @csrf

    <div class="form-group">
        <label for="thu_id">Năm đóng:</label>
        <input type="text" name="thu_id" id="thu_id" value="{{ $dong->thu->year }}" class="form-control" disabled>
        @error('thu_id')
            <div class="error-validate mt-3">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="person_id">Họ và tên:</label>
        <select name="person_id" id="person_id" class="form-select">
            @foreach($people as $person)
                <option value="{{ $person->id }}" {{ $dong->person_id == $person->id ? 'selected' : '' }}>
                    {{ $person->name }}
                </option>
            @endforeach
        </select>
        @error('person_id')
            <div class="error-validate mt-3">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="amount">Số tiền:</label>
        <input type="text" name="amount" id="amount" class="form-control" value="{{ old('amount', $thu->amount) }}">
        @error('amount')
            <div class="error-validate mt-3">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="payment_date">Ngày đóng:</label>
        <input type="date" name="payment_date" id="payment_date" value="{{ $dong->payment_date }}" class="form-control">
        @error('payment_date')
            <div class="error-validate mt-3">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="note">Ghi chú:</label>
        <input type="text" name="note" id="note" class="form-control" value="{{ $dong->note }}">
        @error('note')
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

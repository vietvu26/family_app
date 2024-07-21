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

<form action="{{ route('admin.dong.store') }}" method="post" class="container mt-4 mb-4">
    @csrf

    <div class="form-group">
        <label for="thu_id">Năm đóng</label>
        <select name="thu_id" id="thu_id" class="form-select">
            @foreach($thus as $thu)
                <option value="{{ $thu->id }}" data-amount="{{ $thu->amount }}" {{ old('thu_id') == $thu->id ? 'selected' : '' }}>
                    {{ $thu->year }}
                </option>
            @endforeach
        </select>
        @error('thu_id')
            <div class="error-validate mt-3">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="person_id">Họ và tên</label>
        <select name="person_id" id="person_id" class="form-select">
            @foreach($people as $person)
                <option value="{{ $person->id }}" {{ old('person_id') == $person->id ? 'selected' : '' }}>
                    {{ $person->name }}
                </option>
            @endforeach
        </select>
        @error('person_id')
            <div class="error-validate mt-3">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="amount">Số tiền đóng</label>
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

    <div class="form-group">
        <label for="note">Ghi chú</label>
        <input type="text" name="note" id="note" class="form-control" value="{{ old('note') }}">
        @error('note')
            <div class="error-validate mt-3">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group mt-4">
        <button type="submit" class="btn btn-primary">Thêm người đóng</button>
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var thuSelect = document.getElementById('thu_id');
        var amountInput = document.getElementById('amount');

        thuSelect.addEventListener('change', function () {
            var selectedOption = thuSelect.options[thuSelect.selectedIndex];
            var amount = selectedOption.getAttribute('data-amount');
            amountInput.value = amount;
        });

        // Trigger change event on page load to set initial amount value if needed
        thuSelect.dispatchEvent(new Event('change'));
    });
</script>
@endsection

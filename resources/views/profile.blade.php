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
<section class="section-1 py-5">
    <div class="container">
        <div class="card border-0 shadow p-5 card-profile">
            @if ($person->profile_picture == null)
            <div class="avt mx-auto">
                <img src="{{ asset('assets/images/avatar7.png') }}" alt="avatar" class="img-fluid">
            </div>
        @else
            <div class="avt mx-auto">
                <img src="{{ asset('profile_pic/' . $person->profile_picture) }}" alt="avatar" class="img-fluid">
                <!-- Debug: -->
                
            </div>
        @endif
        

            <!-- Form to upload new profile picture -->
            <div class="mt-4 text-center">
                <form action="{{ route('profile.update_picture', $person->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="mb-3">
                        <input type="file" class="form-control" id="profile_picture" name="profile_picture">
                    </div>
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </form>
            </div>

            <div class="profile-detail mt-4">
                <h3 class="text-center">{{ $person->name }}</h3>
                <div class="profile-item mt-3">
                    <p class="fw-bold"><i class="fa fa-venus-mars me-2"></i>Giới tính:</p>
                    <p>{{ $person->gender == 'male' ? 'Nam' : 'Nữ' }}</p>
                </div>
                <div class="profile-item mt-3">
                    <p class="fw-bold"><i class="fa fa-birthday-cake me-2"></i>Ngày sinh:</p>
                    <p>{{ $person->birth_date }}</p>
                </div>
                @if ($person->death_date)
                    <div class="profile-item mt-3">
                        <p class="fw-bold"><i class="fa fa-cross me-2"></i>Ngày mất:</p>
                        <p>{{ $person->death_date }}</p>
                    </div>
                @endif
                <div class="d-flex justify-content-center">
                    <button onclick="window.location.href='{{ route('admin.person.edit', $person->id) }}'"type="submit" class="btn btn-success me-2" >Sửa thông tin</button>
                </div>
            </div>
        </div>
    </div>
</section>

@if (session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            let toast = new bootstrap.Toast(document.querySelector('.success-message .toast'));
            toast.show();
        });
    </script>
@endif
@if (session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            let toast = new bootstrap.Toast(document.querySelector('.error-message .toast'));
            toast.show();
        });
    </script>
@endif
@endsection

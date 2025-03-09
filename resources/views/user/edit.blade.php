@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center my-4">تعديل البيانات</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <form action="{{ route('profile.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">الاسم</label>
                    <input type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}" required>
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="phone_number">رقم الهاتف</label>
                    <input type="text" class="form-control" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}">
                    @error('phone_number')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-4">تحديث البيانات</button>
    </form>
</div>
@endsection

@extends('backend.admin.master')
@section('title', 'Admin Profile Edit')
@section('content')
<br>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Centered Card with Wider Width -->
    <div class="row justify-content-center">
        <div class="col-md-12"> <!-- Adjust this value to control the width -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-primary text-white">
                    <h6 class="m-0 font-weight-bold">Edit Admin Profile </h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <!-- Admin Name Field -->
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <label for="name" class="form-label">New Admin Name<strong class="text-danger"> *</strong></label>
                                <input name="name" type="text" class="form-control" id="name"
                                    placeholder="Enter Admin Name" value="{{ $admin->name }}">
                                @error('name')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>

                        <!-- Admin UserName Field -->
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <label for="username" class="form-label">New Admin UserName<strong class="text-danger"> *</strong></label>
                                <input name="username" type="text" class="form-control" id="username"
                                    placeholder="Enter Admin UserName" value="{{ $admin->username }}">
                                @error('username')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>

                        <!-- Admin Email Field -->
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <label for="email" class="form-label">New Admin Email<strong class="text-danger"> *</strong></label>
                                <input name="email" type="email" class="form-control" id="email"
                                    placeholder="Enter Admin Email" value="{{ $admin->email }}">
                                @error('email')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>

                        <!--Current Admin Password Field -->
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <label for="password" class="form-label">Current Admin Password<strong class="text-danger"> *</strong></label>
                                <input name="current_password" type="password" class="form-control" id="password"
                                    placeholder="Enter Admin Currect Password">
                                @error('current_password')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>

                         <!--New Admin Password Field -->
                         <div class="row mb-4">
                            <div class="col-md-12">
                                <label for="new_password" class="form-label">New Admin Password<strong class="text-danger"> *</strong></label>
                                <input name="new_password" type="password" class="form-control" id="new_password"
                                    placeholder="Enter Admin New Password">
                                @error('new_password')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>

                         <!--New Admin Password Field -->
                         <div class="row mb-4">
                            <div class="col-md-12">
                                <label for="new_password_confirm" class="form-label">New Admin Password Confirmation<strong class="text-danger"> *</strong></label>
                                <input name="new_password_confirmation" type="password" class="form-control" id="password"
                                    placeholder="Enter Admin New Password Confirmation">
                                @error('new_password_confirmation')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>

                        <input name="admin_id" type="hidden" value="{{ $admin->id }}" />
                        <!-- Submit and Back Buttons -->
                        <div class="row mb-3">
                            <div class="col-md-12 d-flex justify-content-between">
                                <!-- Edit Button -->
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-edit"></i> Edit Profile
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
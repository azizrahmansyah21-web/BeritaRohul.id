@extends('backend.admin.master')
@section('title', 'Post Edit')
@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="card-title mb-0">Create New Post</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Title Field -->
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="title" class="form-label">Title<strong class="text-danger"> *</strong></label>
                            <input name="title" type="text" class="form-control" id="title"
                                placeholder="Enter Post Title" value="{{ old('title')}}">
                            @error('title')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>

                    <!-- Small Description Field -->
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="small_description" class="form-label">Small Description<strong class="text-danger">
                                    *</strong></label>
                            <textarea name="small_description" class="form-control" id="small_description" rows="3"
                                placeholder="Enter Small Description">{{ old('small_description') }}</textarea>
                            @error('small_description')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>

                    <!-- Description Field -->
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="description" class="form-label">Description<strong class="text-danger">
                                    *</strong></label>
                            <textarea name="description" class="form-control" id="description" rows="6" placeholder="Enter Post Description">{{ old('description') }}</textarea>
                            @error('description')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>

                    <!-- Comment Ability and Status Fields -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="comment_able" class="form-label">Comment Ability<strong class="text-danger">
                                    *</strong></label>
                            <select name="comment_able" class="form-select">
                                <option value="" {{ old('comment_able') === null ? 'selected' : ''}}>Select Comment Ability</option>
                                <option value="1" {{ old('comment_able') == 1 ? 'selected' : ''}}>Active</option>
                                <option value="0" {{ old('comment_able') == 0 ? 'selected' : ''}} >Not Active</option>
                            </select>
                            @error('comment_able')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="status" class="form-label">Status<strong class="text-danger"> *</strong></label>
                            <select name="status" class="form-select">
                                <option disabled {{ old('status') == null ? 'selected' : ''}}>Select Status</option>
                                <option value="1" {{ old('status') == 1 ? 'seleced' : ''  }}>Active</option>
                                <option value="0" {{ old('status') == 0 ? 'seleced' : '' }}>Not Active</option>
                            </select>
                            @error('status')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>

                    <!-- Post Category Field -->
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="category" class="form-label">Category<strong class="text-danger"> *</strong></label>
                            <select name="category_id" class="form-select">
                                <option disabled {{ old('category_id') == null ? 'selected' : ''}}>Select Post Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : ''}} >{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>

                    <!-- Post Image Field -->
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="image" class="form-label">Image<strong class="text-danger"> *</strong></label>
                            <input name="images[]" type="file" class="form-control" id="image" value="{{ old('image') }}" multiple>
                            @error('images.*')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary w-100">Create New Post</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $('#image').fileinput({
            theme: 'fa5',
            showUpload: false,
            maxFileCount: 5,
            maxFileSize: 2048,
            allowedFileExtensions: ['jpg', 'png', 'jpeg', 'webp'],
        });
        $('#description').summernote({
            height: 300, // Set the height of the editor
            placeholder: 'Enter Post Description...',
        });
    </script>
@endpush

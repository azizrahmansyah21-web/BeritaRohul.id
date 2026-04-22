@extends('backend.admin.master')
@section('title', 'Post Edit')
@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="card-title mb-0">Edit Post</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Title Field -->
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="title" class="form-label">Title<strong class="text-danger"> *</strong></label>
                            <input name="title" type="text" class="form-control" id="title"
                                placeholder="Enter Post Title" value="{{ $post->title }}">
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
                                placeholder="Enter Small Description">{{ $post->small_description }}</textarea>
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
                            <textarea name="description" class="form-control" id="description" rows="6" placeholder="Enter Post Description">{!!$post->description !!}</textarea>
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
                                <option disabled selected>Select Comment Ability</option>
                                <option value="1" @selected($post->comment_able == 1)>Active</option>
                                <option value="0" @selected($post->comment_able == 0)>Not Active</option>
                            </select>
                            @error('comment_able')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="status" class="form-label">Status<strong class="text-danger"> *</strong></label>
                            <select name="status" class="form-select">
                                <option value="" selected>Select Status</option>
                                <option value="1" @selected($post->status == 1)>Active</option>
                                <option value="0" @selected($post->status == 0)>Not Active</option>
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
                                <option disabled>Select Post Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @selected($category->id == $post->category_id)>{{ $category->name }}
                                    </option>
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
                            <input name="images[]" type="file" class="form-control" id="image" multiple required>
                            @error('image')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary w-100">Update Post</button>
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
            initialPreviewAsData: true,
            initialPreviewFileType: 'image',
            initialPreview: [
                @if ($post->images->count() > 0)
                    @foreach ($post->images as $image)
                        "{{ asset('storage/uploads/' . $image->image) }}",
                    @endforeach
                @endif
            ],
            initialPreviewConfig: [
                @if ($post->images->count() == 1) // if the post have only one image don't reomve it
                    {
                        "caption": "{{ $image->image }}",
                        "width": "120px",
                        "key": "{{ $image->id }}",
                        "type": 'image',
                    },
                @endif
                @if ($post->images->count() > 0)
                    @foreach ($post->images as $image)
                        {
                            "caption": "{{ $image->image }}",
                            "width": "120px",
                            "url": "{{ route('frontend.dashboard.post.image.delete', [$image->id, '_token' => csrf_token(), '_method' => 'DELETE']) }}",
                            "key": "{{ $image->id }}",
                            "type": 'image',
                        },
                    @endforeach
                @endif
            ],
        });
        $('#description').summernote({
            height: 300, // Set the height of the editor
            placeholder: 'Enter Post Description...',
        });
    </script>
@endpush

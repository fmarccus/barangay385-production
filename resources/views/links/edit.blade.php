@extends('layouts.server_test')
@section('title', 'Edit a quick link')
@section('content')

<section class="mt-3 mb-5">
    @if(session()->has('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Quick link updated successfully',
            footer: '<a href="/links/index">Return to links list</a>'
        })
    </script>
    @else
    @endif
    <div class="card shadow-sm rounded-4 border-white">
        <div class="card-body">
            <a href="{{route('links.index')}}" class="btn btn-light mb-3"><i class="fa-solid fa-angles-left"></i> Quick Links</a>
            <h4 class="card-title">Edit a quick link</h4>
            <p class="admin-card-text">Perform modifications on existing quick link</p>
            <hr>
            <form action="{{route('links.update',$link->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="title" class=" admin-card-text">Title</label>
                    <input type="text" class="form-control shadow-none rounded-0 @error('title') is-invalid @enderror" name="title" id="title" value="{{$link->title}}" placeholder="The title of the quick link"></input>
                    @error('title')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="subtitle" class=" admin-card-text">Subtitle</label>
                    <input type="text" class="form-control shadow-none rounded-0 @error('subtitle') is-invalid @enderror" name="subtitle" id="subtitle" value="{{$link->subtitle}}" placeholder="Enter a descriptive subtitle or helper text to the quick link"></input>
                    @error('subtitle')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="hyperlink" class=" admin-card-text">Hyperlink</label>
                    <input type="text" class="form-control shadow-none rounded-0 @error('hyperlink') is-invalid @enderror" name="hyperlink" id="hyperlink" value="{{$link->hyperlink}}" placeholder="Paste in the actual URL for this link."></input>
                    @error('hyperlink')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="file" class=" admin-card-text">Image</label>
                    <input type="file" class="form-control rounded-0 shadow-none @error('file') is-invalid @enderror" onchange="previewFile(this)" name="file">
                    <img id="previewImg" alt="Link image" style="max-width:15rem; margin-top:2rem;">
                    @error('file')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
                <button type="submit" class="btn btn-dark btn-modern float-end shadow-none">Save changes</button>
            </form>
        </div>
    </div>

</section>
@endsection
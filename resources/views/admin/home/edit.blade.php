@extends('admin.admin_master')

@section('admin')

<div class="py-12">

    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Edit About
                    </div>
                    <div class="card-body">
                        @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                        @endif
                        <form class="row g-3" action="{{ url('about/update/'.$homeabouts->id) }}" method="POST">
                            @csrf

                            <div class="col-md-12">
                                <label for="about_title" class="form-label">About title</label>
                                <input value="{{ $homeabouts->title }}" type="text" name="about_title" class="form-control" id="about_title">

                                @error('about_title')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label for="slider_desc" class="form-label">Slider Description</label>
                                <textarea name="short_desc" cols="100" rows="5" style="display:block;">{{ $homeabouts->short_desc }}</textarea>

                                @error('short_desc')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <label for="long_desc" class="form-label">Long Description</label>
                                <textarea name="long_desc" cols="100" rows="5" style="display:block;">{{ $homeabouts->long_desc }}</textarea>

                                @error('long_desc')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                    </div>

                    <div class="col-md-12" style="margin-top:20px;">
                        <button type="submit" class="badge bg-secondary btn btn-secondary" style="padding:15px 20px;margin-bottom:30px;">Update About</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>


    </div>
</div>
</div>
@endsection
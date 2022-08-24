@extends('admin.admin_master')

@section('admin')

<div class="py-12">

    <div class="container">
        <div class="row">

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Edit Slider
                    </div>
                    <div class="card-body">
                        @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                        @endif
                        <form class="row g-3" action="{{ url('slider/update/'.$sliders->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="old_image" value="{{ $sliders->image }}">
                            <div class="col-md-12">
                                <label for="slider_title" class="form-label">Slider title</label>
                                <input value="{{ $sliders->title }}" type="text" name="slider_title" class="form-control" id="slider_title">

                                @error('slider_title')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label for="slider_desc" class="form-label">Slider Description</label>
                                <input type="text" value="{{ $sliders->description }}" name="slider_desc" class="form-control" id="slider_desc">

                                @error('slider_desc')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                    </div>
                    <div class="col-md-12">
                        <label for="slider_image" class="form-label">Update Slider Image</label>
                        <input type="file" name="slider_image" class="form-control" id="slider_image">


                        @error('slider_image')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <img src="{{ asset($sliders->image)}}" alt="brand image" style="width:150px;height:150px;margin-top:30px;" />
                    </div>

                    <div class="col-12">
                        <button type="submit" class="badge bg-secondary btn btn-secondary">Update Slider</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>


    </div>
</div>
</div>
@endsection
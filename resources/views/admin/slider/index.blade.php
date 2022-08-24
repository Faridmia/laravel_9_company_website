@extends('admin.admin_master')

@section('admin')

<div class="col-lg-12">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    All Slider
                </div>

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">SL NO</th>
                            <th scope="col"> Slider Title</th>
                            <th scope="col">Slider Image</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <!-- @php ($i =1); @endphp -->

                        @foreach($sliders as $slider)

                        <tr>
                            <th scope="row">{{ $sliders->firstItem()+$loop->index }}</th>
                            <td>{{ $slider->title }}</td>
                            <?php //{{ $categorie->user->name }} i orm eloquent 
                            ?>
                            <td><img src="{{ asset($slider->image)}}" alt="slider image" style="width:70px;height:70px;" /></td>
                            <td>
                                @if($slider->created_at === null)
                                <span class="text-danger">No data set</span>
                                @else
                                {{ Carbon\Carbon::parse($slider->created_at)->diffForHumans() }}
                                @endif
                            </td>
                            <td>
                                <a href="{{ url('slider/edit/'.$slider->id) }}" class="btn btn-info">Edit</a>
                                <a href="{{ url('delete/slider/'.$slider->id) }}" onclick="return confirm('Are you sure to delete')" class="btn btn-danger">Delete</a>
                            </td>

                        </tr>
                        @endforeach

                    </tbody>
                </table>

                {{ $sliders->links() }}


            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Add Slider
                </div>
                <div class="card-body">
                    @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                    @endif
                    <form class="row g-3" action="{{ route('store.slider') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-12">
                            <label for="slider_title" class="form-label">Slider title</label>
                            <input type="text" name="slider_title" class="form-control" id="slider_title">

                            @error('slider_title')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label for="slider_desc" class="form-label">Slider Description</label>
                            <input type="text" name="slider_desc" class="form-control" id="slider_desc">

                            @error('slider_desc')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <label for="slider_image" class="form-label">Slider Image</label>
                            <input type="file" name="slider_image" class="form-control" id="slider_image">

                            @error('slider_image')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <button type="submit" class="badge bg-secondary btn btn-secondary">Add Slider</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>

    @endsection
@extends('admin.admin_master')

@section('admin')

<div class="py-12">

    <div class="container">
        <div class="row">

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Edit Brand
                    </div>
                    <div class="card-body">
                        @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                        @endif
                        <form class="row g-3" action="{{ url('brand/update/'.$brands->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="old_image" value="{{ $brands->brand_image }}">
                            <div class="col-md-12">
                                <label for="brand_id" class="form-label">Update Brand</label>
                                <input type="text" name="brand_name" class="form-control" id="brand_id" value="{{ $brands->brand_name }}">

                                @error('brand_name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label for="brand_image" class="form-label">Update Brand Image</label>
                                <input type="file" name="brand_image" class="form-control" id="brand_image">


                                @error('brand_image')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <img src="{{ asset($brands->brand_image)}}" alt="brand image" style="width:150px;height:150px;margin-top:30px;" />
                            </div>

                            <div class="col-12">
                                <button type="submit" class="badge bg-secondary btn btn-secondary">Update Brand</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
@endsection
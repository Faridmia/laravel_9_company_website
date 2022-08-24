@extends('admin.admin_master')

@section('admin')

<div class="py-12">

    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        All Brand
                    </div>

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">SL NO</th>
                                <th scope="col"> Brand Name</th>
                                <th scope="col">Brand Image</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <!-- @php ($i =1); @endphp -->

                            @foreach($brands as $brand)

                            <tr>
                                <th scope="row">{{ $brands->firstItem()+$loop->index }}</th>
                                <td>{{ $brand->brand_name }}</td>
                                <?php //{{ $categorie->user->name }} i orm eloquent 
                                ?>
                                <td><img src="{{ asset($brand->brand_image)}}" alt="brand image" style="width:70px;height:70px;" /></td>
                                <td>
                                    @if($brand->created_at === null)
                                    <span class="text-danger">No data set</span>
                                    @else
                                    {{ Carbon\Carbon::parse($brand->created_at)->diffForHumans() }}
                                    @endif
                                </td>
                                <td><a href="{{ url('brand/edit/'.$brand->id) }}" class="btn btn-info">Edit</a>
                                    <a href="{{ url('delete/brand/'.$brand->id) }}" onclick="return confirm('Are you sure to delete')" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>

                    {{ $brands->links() }}


                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Add Brand
                    </div>
                    <div class="card-body">
                        @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                        @endif
                        <form class="row g-3" action="{{ route('store.brand') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-12">
                                <label for="brand_name" class="form-label">Brand Name</label>
                                <input type="text" name="brand_name" class="form-control" id="brand_name">

                                @error('brand_name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <label for="brand_image" class="form-label">Brand Image</label>
                                <input type="file" name="brand_image" class="form-control" id="brand_image">

                                @error('brand_image')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <button type="submit" class="badge bg-secondary btn btn-secondary">Add Brand</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


        </div>
    </div>

    @endsection
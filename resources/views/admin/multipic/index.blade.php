@extends('admin.admin_master')

@section('admin')

    <div class="py-12">

        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card-group">
                        @foreach( $images as $multi ) 
                            <div class="col-md-4 mt-5">
                                <div class="card">
                                    <img src="{{ asset($multi->image) }}" alt="image"/>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            Multiple Image
                        </div>
                        <div class="card-body">
                        @if(session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                        @endif
                            <form class="row g-3" action="{{ route('store.multimage') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                
                                <div class="col-md-12">
                                    <label for="image" class="form-label">Brand Image</label>
                                    <input type="file" name="image[]" class="form-control" id="image" multiple="">

                                    @error('image')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="badge bg-secondary btn btn-secondary">Add Multiple Image</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

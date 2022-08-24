@extends('admin.admin_master')

@section('admin')

<div class="col-lg-12">
    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Add About
                </div>
                <div class="card-body">
                    @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                    @endif
                    <form class="row g-3" action="{{ route('store.about') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-12">
                            <label for="about_title" class="form-label">About title</label>
                            <input type="text" name="about_title" class="form-control" id="about_title">

                            @error('title')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label for="short_desc" class="form-label">Short Description</label>
                            <input type="text" name="short_desc" class="form-control" id="short_desc">

                            @error('short_desc')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <label for="long_desc" class="form-label">Long Description</label>
                            <input type="text" name="long_desc" class="form-control" id="long_desc">

                            @error('long_desc')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12" style="margin-top:30px;">
                            <button type="submit" class="badge bg-secondary btn btn-secondary" style="padding:15px 30px;">Add About</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>

    @endsection
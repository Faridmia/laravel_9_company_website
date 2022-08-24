@extends('admin.admin_master')

@section('admin')

<div class="col-lg-12">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    All About
                </div>

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">SL NO</th>
                            <th scope="col"> About Title</th>
                            <th scope="col">Short Description</th>
                            
                            <th scope="col">Created At</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <!-- @php ($i =1); @endphp -->

                        @foreach( $homeabout as $about )

                        <tr>
                            <th scope="row">{{ $homeabout->firstItem()+$loop->index }}</th>
                            <td>{{ $about->title }}</td>
                            <?php //{{ $categorie->user->name }} i orm eloquent 
                            ?>
                            <td>{{ $about->short_desc }}</td>
                            <td>
                                @if($about->created_at === null)
                                <span class="text-danger">No data set</span>
                                @else
                                {{ Carbon\Carbon::parse($about->created_at)->diffForHumans() }}
                                @endif
                            </td>
                            <td>
                                <a href="{{ url('about/edit/'.$about->id) }}" class="btn btn-info">Edit</a> 
                                <a href="{{ url('delete/about/'.$about->id) }}" onclick="return confirm('Are you sure to delete')" class="btn btn-danger">Delete</a>
                            </td>

                        </tr>
                        @endforeach

                    </tbody>
                </table>
                {{ $homeabout->links() }}


            </div>
        </div>


    </div>

    @endsection
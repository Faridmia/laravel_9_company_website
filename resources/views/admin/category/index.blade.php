<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            All Category
            </b>
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            All Category
                        </div>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">SL NO</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">User Id</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <!-- @php ($i =1); @endphp -->

                                @foreach($categories as $category)




                                <tr>
                                    <th scope="row">{{ $categories->firstItem()+$loop->index }}</th>
                                    <td>{{ $category->category_name }}</td>
                                    <?php //{{ $categorie->user->name }} i orm eloquent 
                                    ?>
                                    <td>{{ $category->user->name }}</td>
                                    <td>
                                        @if($category->created_at === null)
                                        <span class="text-danger">No data set</span>
                                        @else
                                        {{ Carbon\Carbon::parse($category->created_at)->diffForHumans() }}
                                        @endif
                                    </td>
                                    <td><a href="{{ url('category/edit/'.$category->id) }}" class="btn btn-info">Edit</a>
                                        <a href="{{ url('softdelete/category/'.$category->id) }}" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>

                        {{ $categories->links() }}


                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            Add Category
                        </div>
                        <div class="card-body">
                            @if(session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                            @endif
                            <form class="row g-3" action="{{ route('store.category') }}" method="POST">
                                @csrf
                                <div class="col-md-12">
                                    <label for="category_id" class="form-label">Category Name</label>
                                    <input type="text" name="category_name" class="form-control" id="category_id">

                                    @error('category_name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="badge bg-secondary btn btn-secondary">Add Category</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


            </div>
        </div>


        <!-- trash part -->

        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            Trash List
                        </div>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">SL NO</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">User Id</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <!-- @php ($i =1); @endphp -->

                                @foreach($trashcat as $category)

                                <tr>
                                    <th scope="row">{{ $categories->firstItem()+$loop->index }}</th>
                                    <td>{{ $category->category_name }}</td>
                                    <?php //{{ $categorie->user->name }} i orm eloquent 
                                    ?>
                                    <td>{{ $category->user->name }}</td>
                                    <td>
                                        @if($category->created_at === null)
                                        <span class="text-danger">No data set</span>
                                        @else
                                        {{ Carbon\Carbon::parse($category->created_at)->diffForHumans() }}
                                        @endif
                                    </td>
                                    <td><a href="{{ url('category/restore/'.$category->id) }}" class="btn btn-info">Restore</a>
                                        <a href="{{ url('pdelete/category/'.$category->id) }}" class="btn btn-danger">P Delete</a>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>

                        {{ $trashcat->links() }}


                    </div>
                </div>

                <div class="col-md-4">
                </div>


            </div>
        </div>

        <!-- end trash part -->




    </div>
</x-app-layout>
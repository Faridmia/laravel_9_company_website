<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Category
            </b>
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="container">
            <div class="row">

                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            Edit Category
                        </div>
                        <div class="card-body">
                            @if(session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                            @endif
                            <form class="row g-3" action="{{ url('category/update/'.$categories->id) }}" method="POST">
                                @csrf
                                <div class="col-md-12">
                                    <label for="category_id" class="form-label">Update Category</label>
                                    <input type="text" name="category_name" class="form-control" id="category_id" value="{{ $categories->category_name }}">

                                    @error('category_name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="badge bg-secondary btn btn-secondary">Update Category</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</x-app-layout>
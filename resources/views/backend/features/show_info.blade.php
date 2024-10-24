@extends('backend.home.master')



@section('content')

<div class="container mt-4">
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Profile Image</th>
                    <th>Banner Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                
                @foreach ($user as $item)
                <tr>
                   ;
                    <td>{{ $item->id }}</td>
                    <td class="text-center mt-5">{{ $item->name }}</td>
                    <td>
                        @if($item->profile_image)
                            <img class="rounded-circle" src="{{ asset('storage/' . $item->profile_image) }}" alt="Profile Image" width="150" height="150" class="img-thumbnail">
                        @else
                            <span class="text-muted">No Image</span>
                        @endif
                    </td>
                    <td>
                        @if($item->banner_image)
                            <img class="rounded-circle" src="{{ asset('storage/' . $item->banner_image) }}" alt="Banner Image" width="150" height="150" class="img-thumbnail">
                        @else
                            <span class="text-muted">No Image</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{route('edit.profile.info',['id' => $item->id])}}" class="btn btn-success">edit</a>
                        <a href="{{route('delete.profile.info',['id' => $item->id])}}" class="btn btn-danger">delete</a>
                   
                   

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>



@endsection
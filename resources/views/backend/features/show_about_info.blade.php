@extends('backend.home.master')

@section('keyTitle','All about info')

@section('content')


<div class="container mt-4">
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Profession</th>
                    <th>Birthday</th>
                    <th>Age</th>
                    <th>Website</th>
                    <th>Degree</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>City</th>
                    <th>Freelance</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($aboutInfo as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->profession }}</td>
                    <td>{{ $item->birthday }}</td>
                    <td>{{ $item->age }}</td>
                    <td>{{ $item->website ?? 'N/A' }}</td>
                    <td>{{ $item->degree }}</td>
                    <td>{{ $item->phone }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->city }}</td>
                    <td>{{ ucfirst($item->freelance) }}</td>
                    <td>
                        <a  href="{{route('edit.about.info',['id' => $item->id])}}" class="btn btn-success m-1">Edit</a>
                        <a href="{{route('delete.about.info',['id' => $item->id])}}" class="btn btn-danger m-1">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection




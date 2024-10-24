@extends('backend.home.master')

@section('keyTitle', 'Show Skills')

@section('content')
 
<div class="container mt-4">
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Skill Name</th>
                    <th>Skill Capacity</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                
                @foreach ($skills as $skill)
                <tr>
                    <td>{{ $skill->id }}</td>
                    <td>{{ $skill->skill_name }}</td>
                    <td>{{ $skill->skill_capacity }}%</td>
                    <td>
                        <a href="{{ route('edit.skill', ['id' => $skill->id]) }}" class="btn btn-success">Edit</a>
                        <a href="{{ route('delete.skill', ['id' => $skill->id]) }}" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div> 

@endsection

@extends('backend.home.master')


@section('keyTitle','show overview')


@section('content')

<div class="container mt-4">
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Emogi</th>
                    <th>Number</th>
                    <th>Title</th>
                    <th>description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                
                @foreach ($overviewdata as $item)
                <tr>
                   ;
                    <td>{{ $item->id }}</td>
                    
                    <td>
                        @if($item->imogi)
                            <img class="rounded-circle" src="{{ asset('storage/' . $item->imogi) }}" alt="imogi" width="150" height="150" class="img-thumbnail">
                        @else
                            <span class="text-muted">No Emoji</span>
                        @endif
                    </td>
                    <td>
                    <h2>{{$item->number}}</h2>
                    </td>
                    <td>
                    <p>{{$item->title}}</p>
                    </td>
                    <td>
                        <p>{{$item->desc}}</p>
                    </td>
                    <td>
                        <a href="{{route('edit.overview.info',['id' => $item->id])}}" class="btn btn-success">edit</a>
                        <a href="{{route('delete.overview.info',['id' => $item->id])}}" class="btn btn-danger">delete</a>
                   
                   

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>



@endsection
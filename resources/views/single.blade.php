@extends('layouts.noauth')

@section('content')
<div class="container">
    <div class="mb-2 w-75">
        <a class="btn btn-primary" href="{{route("characters.index")}}">All Characters</a>
    </div>
    
    @if (!is_null($character))
        @if (is_array($character))
            <div class="card w-75 mx-auto mb-4">
                <div class="row no-gutter">
                    <div class="col-md-4">
                        <img src="{{$character["image"]}}" class="card-img-top" alt="character {{$character["id"]}}">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            @if ($character["status"] == "Alive")
                                <span class="badge badge-primary float-right">{{$character["status"]}}</span>
                            @elseif ($character["status"] == "Dead")
                                <span class="badge badge-danger float-right">{{$character["status"]}}</span>
                            @else
                                <span class="badge badge-warning float-right">{{$character["status"]}}</span>
                            @endif
                            <h5 class="card-title">{{$character["name"]}}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">{{$character["species"]}}</h6>
                            <p class="card-text mb-0">Origin: <b>{{$character["origin"]["name"]}}</b></p>
                            <p class="card-text">Location: <b>{{$character["location"]["name"]}}</b></p>

                            <ul class="list-group list-group-flush">
                                @foreach ($character["episode"] as $episode)
                                    <li class="list-group-item">Episode {{Str::of($episode)->afterLast("/")}}</li>
                                @endforeach
                            </ul>
                            
                            <p class="card-text"><small class="text-muted">Created {{Carbon\Carbon::parse($character["created"])->diffForHumans()}}</small></p>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="alert alert-danger" role="alert">
                        Rate Limit exceeded. please wait for some time!
                    </div>
                </div>
            </div>
        @endif
    @else 
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="alert alert-success" role="alert">
                    No characters found!
                </div>
            </div>
        </div>
    @endif
</div>
@endsection

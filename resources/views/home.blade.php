@extends('layouts.noauth')

@section('content')
<div class="container">    
    @if (isset($pager))
        <div class="w-100 pr-4">
            {{$pager->render()}}
        </div>
        <br />
        <div class="row w-100 justify-content-center">
        @if (!empty($pager->items()))
            @foreach ($pager->items() as $character)
                <div class="col-md-3">
                    <div class="card mb-4">
                        <img src="{{$character["image"]}}" class="card-img-top" alt="character {{$character["id"]}}">
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
                            <a href="{{action('Characters@show', ['character' => $character["id"]])}}" class="btn btn-sm btn-primary">View</a>
                            
                            <p class="card-text"><small class="text-muted">Created {{Carbon\Carbon::parse($character["created"])->diffForHumans()}}</small></p>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
        @else
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="alert alert-danger" role="alert">
                        No characters found!
                    </div>
                </div>
            </div>
        @endif
    @else 
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="alert alert-success" role="alert">
                    {{$error}}
                </div>
            </div>
        </div>
    @endif
</div>
@endsection

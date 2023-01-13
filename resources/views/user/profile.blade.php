@extends("layout")

@section("body")
    <a href="{{ route('logout') }}" class="btn btn-danger">logout</a>
    <a href="{{ route('list') }}" class="btn btn-primary">Main Page</a>
    
    @foreach($infos as $info)

        <div class="card text-light bg-dark mb-3" style="max-width: 540px;">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="{{$info['url']}}" class="img-fluid rounded-start" alt="no img">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">{{$info['name']}}</h5>
                        <p class="card-text">{{$info['desc']}}</p>
                        <p class="card-text"><small class="text-muted">creator {{$info['creator_name']}}</small></p>
                        <br>
                        <form  method="post" action='/quiz_change/{{$info["id"]}}'>
                            @csrf
                            <button class="btn btn-primary" name="edit" value="{{$info['id']}}">edit</button>
                        </form>   
                    </div>
                </div>
            </div>
        </div>

    @endforeach
@endsection
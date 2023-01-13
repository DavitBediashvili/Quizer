@extends("layout")

@section("body")
<a href="{{ route('list') }}" class="btn btn-primary">Main Page</a>
<br>
<form  method="post">
    @csrf
    <button class="btn btn-primary" name="questions" value='a'>questions</button>
</form>   
@foreach($infos as $info)
    <div class="card mb-3" style="max-width: 540px;">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="{{$info['url']}}" class="img-fluid rounded-start" alt="no img">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">{{$info['name']}}</h5>
                    <p class="card-text">id {{$info['id']}}</p>
                    <p class="card-text">{{$info['desc']}}</p>
                    <p class="card-text"><small class="text-muted">creator {{$info['creator_name']}}</small></p>
                    <p class="card-text"><small class="text-muted">showing {{$info['showing']}}</small></p>
                    <form  method="post">
                        @csrf
                        <input type=hidden name='status' value="{{$info['showing']}}">
                        <button class="btn btn-primary" name="play" value="{{$info['id']}}">change_showing</button>
                        <button class="btn btn-primary" name="delete" value="{{$info['id']}}">delete</button>
                    </form>   
                </div>
            </div>
        </div>
    </div>

@endforeach
@endsection
@extends("layout")

@section("body")

    @guest
        <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
        <a href="{{ route('register') }}" class="btn btn-secondary">Register</a>
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
                            <form  method="post" action='/quizz/{{$info["id"]}}'>
                                @csrf
                                <button class="btn btn-primary" name="play" value="{{$info['id']}}">Play</button>
                            </form>   
                        </div>
                    </div>
                </div>
            </div>

        @endforeach

    @endguest


    @auth
        <a href="{{ route('create') }}" class="btn btn-primary">create</a>
        <a href="{{ route('profile') }}" class="btn btn-primary">profile</a>
        <a href="{{ route('admin') }}" class="btn btn-primary">admin</a>

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
                            <form  method="post" action='/quizz/{{$info["id"]}}'>
                                @csrf
                                <button class="btn btn-primary" name="play" value="{{$info['id']}}">Play</button>
                            </form>   
                        </div>
                    </div>
                </div>
            </div>

        @endforeach

    @endauth


@endsection
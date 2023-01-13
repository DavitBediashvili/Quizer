@extends("layout")

@section("body")
        <div  id="demo" class="card mb-3" style="max-width: 1000px;">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="{{$infos[0]['url']}}" class="img-fluid" alt="no img">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h2 class="card-title">{{$infos[0]['name']}}</h2>
                        <h4 class="card-text">{{$infos[0]['desc']}}</h4>
                        <p class="card-text"><small class="text-muted">creator {{$infos[0]['creator_name']}}</small></p>
                        <br></br>
                        <form  method="post">
                                @csrf
                                <button class="btn btn-primary btn-lg" name="play12" value="{{$infos[0]['id']}}">Play</button>
                        </form>   
                        <br>
                    </div>
                </div>
            </div>
        </div>
        

@endsection
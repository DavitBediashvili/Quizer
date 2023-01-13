@extends("layout")

@section("body")
<center>
        <div class="card text-light bg-dark mb-3" style="max-width: 540px;">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="{{$infos[0]['url']}}" class="img-fluid rounded-start" alt="no img">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">{{$infos[0]['name']}}</h5>
                        <p class="card-text">{{$infos[0]['desc']}}</p>
                        <p class="card-text"><small class="text-muted">creator {{$infos[0]['creator_name']}}</small></p>
                        <br>
                    </div>
                </div>
            </div>
        </div>

        <form method="post">
                @csrf
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Name</span>
                    <input type="text" class="form-control" aria-label="Sizing example input" name="name" aria-describedby="inputGroup-sizing-default">
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">URL</span>
                    <input type="text" class="form-control" aria-label="Sizing example input" name="url" aria-describedby="inputGroup-sizing-default">
                </div>

                <div class="input-group">
                    <span class="input-group-text">Description</span>
                    <textarea class="form-control" name="desc" aria-label="Description"></textarea>
                </div>

                <button type="submit" name="add" value="v" class="btn btn-primary">Submit</button>

                <button type="submit" name="delete" value="v" class="btn btn-danger">delete</button>

                <button type="submit" name="edit_quest" value="v" class="btn btn-primary">edit questions</button>

                
        </form>
        </center>
@endsection
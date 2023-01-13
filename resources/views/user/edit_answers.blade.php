@extends("layout")

@section("body")
<center>
    @foreach($infos as $info)

        <div class="card">
            <div class="card text-light bg-dark mb-3">
                    answer: {{$info['answer']}} 
                    <br>
                    type: {{$info['type']}}
                    <form method="post">
                        @csrf
                        <span class="input-group-text" id="inputGroup-sizing-default">Answer</span>
                        <input type="text" class="form-control" aria-label="Sizing example input" name="an" aria-describedby="inputGroup-sizing-default">
                        <br>
                        <span class="input-group-text" id="inputGroup-sizing-default">Type</span>
                        <input type="text" class="form-control" aria-label="Sizing example input" name="type" aria-describedby="inputGroup-sizing-default">
                        <br>
                        <button type="submit" name="change_an" value="{{$info['id']}}" class="btn btn-primary">change</button>
                        <br>
                        <button type="submit" name="delete_an" value="{{$info['id']}}" class="btn btn-danger">delete</button>
                        
                    </form>
            </div>
            
        </div>
        <br></br>

    @endforeach
    </center>
@endsection
@extends("layout")

@section("body")
    @foreach($infos as $info)

        <div class="card">
            <div class="card text-light bg-dark mb-3">
                    {{$info['question']}}
                    <form method="post">
                        @csrf
                        <input type="text" class="form-control" aria-label="Sizing example input" name="qu" aria-describedby="inputGroup-sizing-default">
                        <br>
                        position: {{$info['position']}}
                        <input type="text" class="form-control" aria-label="Sizing example input" name="pos" aria-describedby="inputGroup-sizing-default">
                        <br>
                        {{$info['url']}}
                        <input type="text" class="form-control" aria-label="Sizing example input" name="url" aria-describedby="inputGroup-sizing-default">
                        <br>
                        <button type="submit" name="add_qu" value="{{$info['id']}}" class="btn btn-primary">change</button>
                        <br>
                        <button type="submit" name="delete_qu" value="{{$info['id']}}" class="btn btn-danger">delete</button>
                        <br>
                        <button type="submit" name="edit_answers" value="{{$info['id']}}" class="btn btn-primary">change answers</button>
                    </form>
            </div>
            
        </div>

    @endforeach

    <form method="post">
        @csrf
        <br>
        <span class="input-group-text" id="inputGroup-sizing-default">Question</span>
        <input type="text" class="form-control" aria-label="Sizing example input" name="qu_new" aria-describedby="inputGroup-sizing-default">
        <span class="input-group-text" id="inputGroup-sizing-default">URL</span>
        <input type="text" class="form-control" aria-label="Sizing example input" name="qu_url" aria-describedby="inputGroup-sizing-default">
        <span class="input-group-text" id="inputGroup-sizing-default">Position</span>
        <input type="text" class="form-control" aria-label="Sizing example input" name="qu_pos" aria-describedby="inputGroup-sizing-default">

        <br>
        <button type="submit" name="add_qu_new" value="{{$infos[0]['quiz_id']}}" class="btn btn-primary">add</button>
    </form>

@endsection
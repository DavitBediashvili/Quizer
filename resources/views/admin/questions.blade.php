@extends("layout")

@section("body")
<a href="{{ route('list') }}" class="btn btn-primary">Main Page</a>
    @foreach($infos as $info)
        <div class="card text-light bg-dark mb-3" style="max-width: 540px;">
            <div class="row g-0">
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">{{$info['question']}}</h5>
                        <p class="card-text">position {{$info['position']}}</p>
                        <p class="card-text">quiz id {{$info['quiz_id']}}</p>
                        <p class="card-text"><small class="text-muted">{{$info['url']}}</small></p>
                        <form  method="post">
                            @csrf
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-default">quiz id</span>
                                <input type="number" class="form-control" aria-label="Sizing example input" name="ch_quiz" aria-describedby="inputGroup-sizing-default">
                                <button class="btn btn-primary" name="q_id" value="{{$info['id']}}">change quiz</button>
                            </div>
                            
                        </form>   
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <form method="post" action="">
        @csrf
        <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Question</span>
            <input type="text" class="form-control" aria-label="Sizing example input" name="question" aria-describedby="inputGroup-sizing-default">
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default">quiz id</span>
             <input type="number" class="form-control" aria-label="Sizing example input" name="id" aria-describedby="inputGroup-sizing-default">
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default">URL</span>
            <input type="text" class="form-control" aria-label="Sizing example input" name="url_quest" aria-describedby="inputGroup-sizing-default">
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Position</span>
            <input type="number" class="form-control" aria-label="Sizing example input" name="position" aria-describedby="inputGroup-sizing-default">
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Answer1(input correct answer)</span>
            <input type="text" class="form-control" aria-label="Sizing example input" name="answer1" aria-describedby="inputGroup-sizing-default">
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Answer2</span>
            <input type="text" class="form-control" aria-label="Sizing example input" name="answer2" aria-describedby="inputGroup-sizing-default">
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Answer3</span>
            <input type="text" class="form-control" aria-label="Sizing example input" name="answer3" aria-describedby="inputGroup-sizing-default">
        </div>

        <button type="submit" name="add_answer" value="a" class="btn btn-primary">next question</button>
    </form>
@endsection
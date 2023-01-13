@extends("layout")

@section("body")
<center>
        <form method="post" action="">
                @csrf
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Question</span>
                    <input type="text" class="form-control" aria-label="Sizing example input" name="question" aria-describedby="inputGroup-sizing-default">
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

                <button type="submit" name="add_answer" value="{{$named}}" class="btn btn-primary">next question</button>
                <button type="submit" name="end_answer" value="{{$named}}" class="btn btn-primary">end</button>
        </form>
        </center>
@endsection
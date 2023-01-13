@extends("layout")

@section("body")
<center>
    <form method="post" action="">
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
     </form>
     </center>
@endsection
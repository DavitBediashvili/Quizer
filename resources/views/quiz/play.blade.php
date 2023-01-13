@extends("layout")

@section("body")
<div id='main'>
        <div class="card mb-3" style="max-width: 540px;">
            <div class="row g-0">
                <div id='picture' class="col-md-4">
                    <img src='' class="img-fluid rounded-start" alt="no img">
                    <h3>0/1</h3>
                </div>
                <div class="col-md-8">
                    <div  id='question' class="card-body">
                        <h3 class="card-title"></h3>
                    </div>
                    <div  id='answers' class="card-body">
                    </div>

                </div>
            </div>
        </div>
</div>


    <script>
            window.onload = function (){
                fetch('http://127.0.0.1:8000/api/answer_checker/{{$ids}}')
                .then(response =>{
                    return response.json();
                }).then(data =>{
                    let div = document.getElementById('main');
                    let div1 = document.getElementById('picture');
                    let div2 = document.getElementById('question');
                    let div3 = document.getElementById('answers');
                    const object1 = data.quiz_que_url;
                    const object2 = data.quiz_que_answ;
                    let keys1 = [];
                    let values1 = [];
                    let keys2 = [];
                    let values2 = [];
                    let index = 0;
                    let index2 = 0;
                    let size = 0;
                    let size2 = 0;
                    let good = 0;
                    let a = 1;
                    for (const [key, value] of Object.entries(object1)) {
                        size += 1;
                        keys1.push(key);
                        values1.push(value);
                    }
                    for (const [key, value] of Object.entries(object2)) {
                        keys2.push(key);
                        values2.push(value);
                    }
                    div1.innerHTML = '<img src="'+ values1[index] +'" class="img-fluid rounded-start" alt="no img">';
                    div1.innerHTML += '<h3>'+ good +'/'+ size +'</h3>';
                    div2.innerHTML = '<h3 class="card-title">'+ keys1[index] +'</h3>';
                    div3.innerHTML = '';
                    
                    
                        
                        for (const one of values2[index]) { 
                            console.log(one);
                            div3.innerHTML += '<h5 class="card-title">'+ one['answer'] +'</h5>';
                            div3.innerHTML += '<button class="btn btn-primary" id="b' + a + '" value="' + one['type'] + '">Choose</button>';
                            a +=1;

                        }

                        function newf(){
                                index += 1
                            if (index == size) {
                                div.innerHTML = '<div class="d-grid gap-2">';
                                div.innerHTML += '<h1>'+ good +'/'+ size +'</h1>';
                                div.innerHTML += '<form  method="post">'+'@csrf'+'<button class="btn btn-primary btn-lg" name="end" value="a">end test</button>';
                                div.innerHTML += '</form>';
                                div.innerHTML += '</div>';
                            }else{
                                div1.innerHTML = '<img src="'+ values1[index] +'" class="img-fluid rounded-start" alt="no img">';
                                div1.innerHTML += '<h3>'+ good +'/'+ size +'</h3>';
                                div2.innerHTML = '<h3 class="card-title">'+ keys1[index] +'</h3>';
                                div3.innerHTML = '';
                                
                                for (const one of values2[index]) { 
                                console.log(one);
                                div3.innerHTML += '<h5 class="card-title">'+ one['answer'] +'</h5>';
                                div3.innerHTML += '<button class="btn btn-primary" id="b' + a + '" value="' + one['type'] + '">Choose</button>';
                                a+=1
                                

                                }
                                b1.addEventListener("click", () => {
                                    const b1Input = document.getElementById("b1").value;
                                    if (b1Input == 'true'){
                                        good += 1
                                    }
                                    newf()
                                })
                                b2.addEventListener("click", () => {
                                    const b2Input = document.getElementById("b2").value;
                                    if (b2Input == 'true'){
                                        good += 1
                                    }
                                    newf()
                                })
                                b3.addEventListener("click", () => {
                                    const b3Input = document.getElementById("b3").value;
                                    if (b3Input == 'true'){
                                        good += 1
                                    }
                                    newf()
                                })
                                a = 1;
                                index2+=1;
                                

                            }
                            a = 1;
                        }

                        b1.addEventListener("click", () => {
                            const b1Input = document.getElementById("b1").value;
                            if (b1Input == 'true'){
                                good += 1
                            }
                            newf()
                        })
                        b2.addEventListener("click", () => {
                            const b2Input = document.getElementById("b2").value;
                            if (b2Input == 'true'){
                                good += 1
                            }
                            newf()
                        })
                        b3.addEventListener("click", () => {
                            const b3Input = document.getElementById("b3").value;
                            if (b3Input == 'true'){
                                good += 1
                            }
                            newf()
                        })
                        a = 1;
                        index2+=1;

                        

                            
                        
                    
                    
                    
                    btn2.addEventListener("click", () => {
                        
                    })
            
                })
 
            }
          
        </script>

@endsection
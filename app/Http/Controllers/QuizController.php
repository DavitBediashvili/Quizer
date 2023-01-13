<?php

namespace App\Http\Controllers;

use App\Models\answer;
use App\Models\question;
use App\Models\quiz;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use PSpell\Dictionary;

class QuizController extends Controller
{
    #არსებული ქვიზების გამოსახვს
    public function list(Request $request){
        $infos = quiz::where(['showing' => 'yes'])->orderBy('created_at')->get();
        if ($request->input("play") != "") {
            $quiz_name = $request->input('play');
            return redirect('/quizz/'.$quiz_name);
        }
        return view('quiz.quiz_list', ["infos" => $infos]);

    }

    #ქვიზის შექმნა, კითხვებიანად, ყველაფრიანად
    public function create(Request $request){
        $named = $request->input('name');
        $url = $request->input('url');
        $desc = $request->input('desc');
        $idi = Auth::id();
        $creator_name = User::where(['id' => $idi])->get('name');
        
        if ($request->input("add") != "") {
            quiz::create([
                "name" => $named,
                 "url" => $url,
                "creator_name" => $creator_name[0]['name'],
                "desc" => $desc,
                "showing" => 'no'
            ]);
            return view('quiz.questions', ["named"=>$named]);
        }

        if ($request->input("add_answer") != "" or $request->input("end_answer") != "") {
            $question = $request->input('question');
            $url_quest = $request->input('url_quest');
            $position = $request->input('position');
            if($request->input("add_answer") != ""){
                $named = $request->input("add_answer");
            }
            if($request->input("end_answer") != ""){
                $named = $request->input("end_answer");
            }
            $quiz_id = quiz::where(['name' => $named])->where(['creator_name' => $creator_name[0]['name']])->get('id');
            $questi = question::create([
                "question" => $question,
                 "url" => $url_quest,
                "position" => $position,
                "quiz_id" => $quiz_id[0]['id']
            ]);
            $currentTime = Carbon::now()->toDateTimeString();
            $answer1 = $request->input('answer1');
            $answer2 = $request->input('answer2');
            $answer3 = $request->input('answer3');
            $question_id = $questi->id;
            $ans_list = array($answer1, $answer2, $answer3);

            $i = 0;
            while($i < count($ans_list)){
                    if($i == 0){
                        answer::create([
                            "answer" => $ans_list[$i],
                            "question_id" => $question_id,
                            "type" => 'true'
                        ]);
                    }else{
                        answer::create([
                            "answer" => $ans_list[$i],
                            "question_id" => $question_id,
                            "type" => 'false'
                        ]);
                    }
                    
                    $i++;
                }
            if($request->input("add_answer") != ""){
                return view('quiz.questions', ["named"=>$named]);
            }

            if($request->input("end_answer") != ""){
                return redirect('/quizzes');
            }
            
        }
        return view('quiz.create');

    }

    #ავტორიზებული იუზერისთვის პროფილზე, მის მიერ გაკეთებული ქვიზების გამოსახვა
    public function profile(Request $request){
        $id = Auth::id();
        $creator_name = User::where(['id' => $id])->get('name');
        $infos = quiz::where(['creator_name' => $creator_name[0]['name']])->get();
        if ($request->input("add") != "") {
            $quiz_name = $request->input('edit');
            return redirect('/quiz_change/'.$quiz_name);
        }

        

        return view('user.profile', ["infos" => $infos]);

    }

    #უკვე არსებული ქვიზის, მისი კითხვების ან პასუხების შეცვლა
    public function quiz_change(Request $request){

        $names = $request->names;
        $id = Auth::id();
        $creator_name = User::where(['id' => $id])->get('name');
        $info = quiz::select()->where('creator_name', '=' ,$creator_name[0]['name'])->where('id', '=' ,$names)->get();

        
        if ($request->input("add") != ""){

            
            if ($request->input("name") != "") {
                $name = $request->input('name');
                quiz::select()->where('id', '=' , $names)->update(['name' => $name]);  
            }
    
            if ($request->input("url") != "") {
                $url = $request->input('url');
                quiz::where('id', $names)->update(['url' => $url]);        
            }
    
            if ($request->input("desc") != "") {
                $desc = $request->input('desc');
                quiz::where('id', $names)->update(['desc' => $desc]);        
            }

            return redirect('profile'); 

            
    

        }

        if ($request->input("delete") != "") {
            quiz::select()->where('id', '=' , $names)->delete();
            $aba = question::where('quiz_id', $names)->get('id');
            question::select()->where('quiz_id', '=' , $names)->delete();
            foreach ($aba as $each) {
                answer::select()->where('question_id', '=' , $each['id'])->delete();
            }
            return redirect('profile');   
        }

        if ($request->input("edit_quest") != "") {
            $infos = question::where('quiz_id', $names)->get();    
            return view('user.edit_question', ["infos" => $infos]);   
        }

        if ($request->input("delete_qu") != "") {
            question::select()->where('id', '=' , $request->input("delete_qu"))->delete();
            answer::select()->where('question_id', '=' , $request->input("delete_qu"))->delete();
            return redirect('profile');   
        }
        if ($request->input("add_qu") != "") {
            if ($request->input('qu') != ''){
                $qu = $request->input('qu');
                question::where('id', $request->input("add_qu"))->update(['question' => $qu]);    
            }
            if ($request->input('pos') != ''){
                $po = $request->input('pos');
                question::where('id', $request->input("add_qu"))->update(['position' => $po]);
            }
            
            return redirect('profile');     
        }

        if ($request->input("add_qu_new") != "") {
            $qu_id = $request->input('add_qu_new');
            $qu_new = $request->input('qu_new');
            $qu_url = $request->input('qu_url');
            $qu_pos = $request->input('qu_pos');
            question::create([
                "question" => $qu_new,
                 "url" => $qu_url,
                "position" => $qu_pos,
                "quiz_id" => $qu_id
            ]);
            return redirect('profile');     
        }

        if ($request->input("edit_answers") != "") {
            $que_id = $request->input('edit_answers');  
            $infos = answer::where('question_id', $que_id)->get();   
            return view('user.edit_answers', ['infos' => $infos]);     
        }

        if ($request->input("change_an") != "") {
            if ($request->input('an') != "") {
                $an = $request->input('an');
                answer::where('id', $request->input("change_an"))->update(['answer' => $an]);
            }
            if ($request->input('type') != "") {
                $type = $request->input('type');
                answer::where('id', $request->input("change_an"))->update(['type' => $type]);
            }
        
            return redirect('profile');     
        }

        if ($request->input("delete_an") != "") {
            answer::select()->where('id', '=' , $request->input("delete_an"))->delete();
            return redirect('profile');   
        }

        

        
        return view('user.edit', ["infos" => $info]);
    }

    public function quiz_play(Request $request){
        $ids = $request->ids;
        $quiz_info = quiz::where(['id' => $ids])->get();
        if ($request->input("play12") != "") {
            return view('quiz.play', ["ids" => $request->input("play12")]);   
        }
        if ($request->input("end") != "") {
            return redirect('/quizzes'); 
        }
        
        
        return view('quiz.quiz', ["infos" => $quiz_info]);
    }
    
    #ქვიზის გავლის ნაწილი
    public function check(Request $request){
        
        
            $quiz_que_url = [];
            $quiz_answ = [];
            $quiz_id = $request->ide;
            $questions = question::select()->where('quiz_id', '=' , $quiz_id)->orderBy('position')->get();
            foreach ($questions as $question) {
                $quiz_que_url[$question['question']] = $question['url'];
                $answers = answer::select()->where('question_id', '=' , $question['id'])->orderBy('answer')->get();
                foreach ($answers as $each) {
                    array_push($quiz_answ, $each);
                }
                $quiz_que_answ[$question['question']] = $quiz_answ;
                $quiz_answ = [];
            }
        

        return response()->json(['quiz_que_url' => $quiz_que_url, 'quiz_que_answ' => $quiz_que_answ]);
        

    }


    public function admin(Request $request){
        $infos = quiz::select('id','name', 'url', 'creator_name', 'desc', 'showing')->orderBy('created_at')->get();
        if ($request->input("play") != "") {
            if ($request->input("status") == 'yes'){
                quiz::where('id', $request->input("play"))->update(['showing' => 'no']);
            }else{
                quiz::where('id', $request->input("play"))->update(['showing' => 'yes']);
            }
            
            return redirect('/quizzes'); 
        }

        if ($request->input("questions") != "") {
            $infos = question::select()->get();
            return view('admin.questions', ["infos" => $infos]);
        }

        if ($request->input("q_id") != "") {
            question::where('id', $request->input("q_id"))->update(['quiz_id' => $request->input("ch_quiz")]);
            return redirect('/admin');
        }


        if ($request->input("add_answer") != "") {
            $question = $request->input('question');
            $url_quest = $request->input('url_quest');
            $position = $request->input('position');
            $quiz_id = $request->input('id');
            $questi = question::create([
                "question" => $question,
                 "url" => $url_quest,
                "position" => $position,
                "quiz_id" => $quiz_id
            ]);
            $answer1 = $request->input('answer1');
            $answer2 = $request->input('answer2');
            $answer3 = $request->input('answer3');
            $question_id = $questi->id;
            $ans_list = array($answer1, $answer2, $answer3);

            $i = 0;
            while($i < count($ans_list)){
                    if($i == 0){
                        answer::create([
                            "answer" => $ans_list[$i],
                            "question_id" => $question_id,
                            "type" => 'true'
                        ]);
                    }else{
                        answer::create([
                            "answer" => $ans_list[$i],
                            "question_id" => $question_id,
                            "type" => 'false'
                        ]);
                    }
                    
                    $i++;
                }
            return redirect('/quizzes');    
            
        }

        if ($request->input("delete") != "") {
            $names = $request->input("delete");
            quiz::select()->where('id', '=' , $names)->delete();
            $aba = question::where('quiz_id', $names)->get('id');
            question::select()->where('quiz_id', '=' , $names)->delete();
            foreach ($aba as $each) {
                answer::select()->where('question_id', '=' , $each['id'])->delete();
            }
            return redirect('/quizzes'); ;
        }

        return view('admin.admin', ["infos" => $infos]);
    }
}

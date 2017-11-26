<?php

namespace App\Http\Controllers;

use App\Mail\MailClass;
use Illuminate\Http\Request;
use App\Page;
use App\Service;
use App\Portfolio;
use App\People;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
class IndexController extends Controller
{
    public function execute(Request $request){

        if($request->isMethod('post')){
            $messages=[
                'required'=>"Поле :attribute обязательно к заполнению",
                'email'=>"Поле :attribute должно соответствовать *.@mail.ru",
            ];
            $this->validate($request,[
               'name'=>'required|max:255',
               'email'=>'required|email',
               'text'=>'required'
            ],$messages);
            $data=$request->all();
//           $result=Mail::send('site.email',['data'=>$data],function ($message) use($data){
//                $mail_admin=env('MAIL_ADMIN');
//                $message->from($data['email'],$data['name']);
//                $message->to($mail_admin)->subject('Question');
//            });
//           if($result){
//               return redirect()->route('home')->with('status','Email is send');
//           }
            //mail
            $result=Mail::to($data['email'])->send(new MailClass($data['name'],$data['email'],$data['text']));
            if(count(Mail::failures())==0 ){
                return redirect()->route('home')->with('status','Email is send');

            }

//            if($result){
//                return redirect()->route('home')->with('status','Email is send');
//            }
        }
        $pages=Page::all();
        $portfolios=Portfolio::get(array('name','filter','images'));
        $services=Service::where('id','<',20)->get();
        $peoples=People::take(3)->get();

        $tags=DB::table('portfolios')->distinct()->pluck('filter');

        $menu=array();
        foreach ($pages as $page){
            $item=array('title'=>$page->name,'alias'=>$page->alias);
            array_push($menu,$item);

        }
        $item=array('title'=>'Services','alias'=>'service');
        array_push($menu,$item);
        $item=array('title'=>'Portfolio','alias'=>'Portfolio');
        array_push($menu,$item);
        $item=array('title'=>'Team','alias'=>'team');
        array_push($menu,$item);
        $item=array('title'=>'Contact','alias'=>'Contact');
        array_push($menu,$item);

        return view('site.index',with([
            'menu'=>$menu,
            'pages'=>$pages,
            'services'=>$services,
            'portfolios'=>$portfolios,
            'peoples'=>$peoples,
            'tags'=>$tags,
                'status'=>'Email is send'
]
        ));
    }
}

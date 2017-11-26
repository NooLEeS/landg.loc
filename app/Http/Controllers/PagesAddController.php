<?php

namespace App\Http\Controllers;

use App\Page;
use Validator;
use Illuminate\Http\Request;
class PagesAddController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function execute(Request $request){

        if($request->isMethod('POST')){
            $input=$request->except('_token');
            $message=[
                'required'=>'Pole :attribute obya3atelno k zapolneniyy',
                'unique'=>'Pole :arttribute doljno bitb ynikalnim'
            ];
            $validator=Validator::make($input,[
               'name'=>'required|max:255',
               'alias'=>'required|max:255|unique:pages',
               'text'=>'required',
            ],$message);
            if($validator->fails()){
                return redirect()->route('pagesAdd')->withErrors($validator)->withInput();
            }
            if($request->hasFile('images')) {
                $file = $request->file('images');
                $input['images'] = $file->getClientOriginalName();
                $file->move(public_path().'/assets/img',$input['images']);

            }
            $page= new Page();
            $page->fill($input);
            if($page->save()){
                return redirect('admin')->with('status','StraniCa DobaBlena');

            }
        }
        if(view()->exists('admin.pages_add')){
            $data=[
                'title'=>'New page'
            ];
            return view('admin.pages_add',$data);
        }
abort(404);
    }
}

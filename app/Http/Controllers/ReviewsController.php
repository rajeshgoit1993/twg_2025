<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log; // Import the Log facade
use Illuminate\Http\Request;
use App\Reviews;
use App\Packages;
use App\User;
use Validator;

class ReviewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_reviews = Reviews::all();
       // dd($all_reviews);
        return view('reviews.list',['reviews'=>$all_reviews]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
  
    public function create()
    {
        $package = Packages::select('id','title')->where('status','1')->get();
        $user = User::select('id','first_name','last_name')->get();
       // dd($user);
        return view('reviews.create',['packages'=>$package,
                                      'users'=>$user
                                        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $this->validate($request, [
            'package_id' => 'required',
            'user_id' => 'required',
            'user_exp' => 'required',
            'user_rating' => 'required',
        ]);
        if($request->input('id')){
            $rev = Reviews::findOrFail($request->input('id'));
            $rev->package_id = $request->input('package_id');
            $rev->user_id = $request->input('user_id');
            $rev->user_exp = $request->input('user_exp');
            $rev->user_rating = $request->input('user_rating');
            $rev->status = $request->input('status');
            if($rev->save()){
                            return redirect('testimonials')->with('success','Review has been updated successfuly!');
                        }
        }else{
            $rev = new Reviews;
            $rev->package_id = $request->input('package_id');
            $rev->user_id = $request->input('user_id');
            $rev->user_exp = $request->input('user_exp');
            $rev->user_rating = $request->input('user_rating');
            $rev->status = $request->input('status');
            if($rev->save()){
                            return redirect('testimonials')->with('success','Review has been created successfuly!');
                        }
        }
     }
    public function delete(Request $request){
        Reviews::find ( $request->id )->delete ();
        return redirect('/testimonials')->with('success','Review has been Deleted succesfuly');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Reviews::findOrFail($id);
        $package = Packages::select('id','title')->where('status','1')->get();
        $user = User::select('id','first_name','last_name')->get();
       // dd($user);
        return view('reviews.edit',['packages'=>$package,
                                      'users'=>$user  ,
                                      'reviewData'=>$data,
                                        ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
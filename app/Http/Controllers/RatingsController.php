<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Rating;
use App\User;
use Illuminate\Http\Request;

class RatingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }
    public function productRatings($id)
    {
        $product = Product::where('id', $id)->first();
        if (!$product)
            return response()->json(['msg' => 'invalid data']);
        $ratings = Rating::where('prod_id', $id)
        ->with('user')->get();
        return response()->json(['ratings' => $ratings]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$request->token)
            return response()->json(['msg' => 'token required']);
        if (!$request->prod_id)
            return response()->json(['msg' => 'product id required']);
        if (!$request->degree)
            return response()->json(['msg' => 'degree required']);

        $user = User::where('tokens', $request->token)->first();
        if (!$user)
            return response()->json(['msg' => 'invalid token']);
        $rating = Rating::where('user_id', $user->id)
            ->where('prod_id', $request->prod_id)
            ->first();
        if ($rating) {
            return response()->json(['msg' => 'you are rating this product before']);
        } else {
            Rating::create([
                'user_id' => $user->id,
                'prod_id' => $request->prod_id,
                'degree' => $request->degree
            ]);
            return response()->json(['msg' => 'rating added successfully']);
        }
    }
    public function replyRating(Request $request)
    {
        if (!$request->rate_id)
            return response()->json(['msg' => 'rate_id required']);
        if (!$request->comment)
            return response()->json(['msg' => 'comment required']);
        $rating = Rating::find($request->rate_id);
        if($rating)
            $rating->update(['comment' => $request->comment]);
        else
            return response()->json(['msg' => 'invalid data']);
        return response()->json(['msg' => 'comment added successfully']);
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
        //
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

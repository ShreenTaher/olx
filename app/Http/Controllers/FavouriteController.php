<?php

namespace App\Http\Controllers;

use App\Models\Favourite;
use App\User;
use Illuminate\Http\Request;

class FavouriteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

        $user = User::where('tokens', $request->token)->first();
        if (!$user)
            return response()->json(['msg' => 'invalid token']);
        $fav = Favourite::where('user_id', $user->id)->where('prod_id', $request->prod_id)->first();
        if ($fav) {
            Favourite::destroy($fav->id);
            $favourite_count = Favourite::where('prod_id', $request->prod_id)->count();
                return response()->json(['fav' => 'false', 'favourite_count' => $favourite_count]);
        } else {
            Favourite::create([
                'user_id' => $user->id,
                'prod_id' => $request->prod_id,
            ]);
            $favourite_count = Favourite::where('prod_id', $request->prod_id)->count();
            return response()->json(['fav' => 'true', 'favourite_count' => $favourite_count]);
        }
    }
    public function getUserFavs($token)
    {
        $user = User::where('tokens', $token)->first();
        if (!$user)
            return response()->json(['msg' => 'invalid token']);
        $favs = $user->favourites;
        if ($favs->isEmpty())
            return response()->json(['msg' => 'No favourites']);
        return response()->json(['favs' => $favs]);
    }
    public function isFav($id, $token)
    {
        $user = User::where('tokens', $token)->first();
        if(! $user)
            return response()->json(['msg' => 'invalid token']);
        $fav = Favourite::where('user_id', $user->id)
            ->where('prod_id', $id)->first();
        if($fav)
            return response()->json(['fav' => 'true']);
        return response()->json(['fav' => 'false']);
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

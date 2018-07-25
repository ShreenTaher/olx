<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Image;
use App\Models\PhoneData;
use App\Models\Product;
use App\Models\Rating;
use App\Notifications\NewOrder;
use App\Notifications\NotifyOrder;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Route::current()->getPrefix() == 'olx/') {
            $products = Product::where('approve', 1)->get();
            return view('olx.products.index', compact('products'));
        }
        $products = Product::where('approve', 1)
            ->with('user', 'category', 'images')->get();
        return response()->json(['products' => $products]);
    }
    public function waitingApprove()
    {
        $products = Product::where('approve', 0)->get();
        return view('olx.products.waitingApprove', compact('products'));
    }
    public function catProducts($id)
    {
        $products = Product::where('cat_id', $id)
            ->where('approve', 1)
            ->with(['images' => function ($query) {
                $query->where('is_primary', 1)->get();
            }])->get();
        return response()->json(['catProducts' => $products]);
    }
    public function userProducts($token)
    {
        $user = User::where('tokens', $token)->first();
        if(! $user)
            return response()->json(['msg' => 'invalid data']);
        $products = Product::where('user_id', $user->id)
            ->where('approve', 1)
            ->with('category', 'images')
            ->get();
        return response()->json(['products' => $products]);
    }
    public function searchProducts(Request $request)
    {
        if(! $request->title)
            return response()->json(['msg' => 'title required']);
        $products = Product::where('title', 'LIKE', '%' . $request->title . '%')
            ->where('approve', 1)
            ->with('user', 'category', 'images')
            ->get();
        return response()->json(['products' => $products]);

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
        if (Route::current()->getPrefix() == 'olx/') {

        }else {
            if (!$request->token)
                return response()->json(['msg' => 'token required']);
            if (!$request->cat_id)
                return response()->json(['msg' => 'category id required']);
            if (!$request->title)
                return response()->json(['msg' => 'title required']);
            if (!$request->description)
                return response()->json(['msg' => 'description required']);
            if (!$request->price)
                return response()->json(['msg' => 'price required']);
            if (!$request->phone)
                return response()->json(['msg' => 'phone required']);
            if (!$request->address)
                return response()->json(['msg' => 'address required']);
//            if (!$request->images)
//                return response()->json(['msg' => 'images required']);
            if (!$request->photos_ids) // as string 1,2,3
                return response()->json(['msg' => 'photos_ids required']);
            if (!is_numeric($request->phone))
                return response()->json(['msg' => 'mobile must be a number']);
            if (!is_numeric($request->price))
                return response()->json(['msg' => 'price must be a number']);
            $user = User::where('tokens', $request->token)->first();
            if (!$user)
                return response()->json(['msg' => 'invalid token']);
            $product = Product::create([
                'user_id' => $user->id,
                'cat_id' => $request->cat_id,
                'title' => $request->title,
                'content' => $request->description,
                'price' => $request->price,
                'phone' => $request->phone,
                'address' => $request->address
            ]);
            $images_ids = explode(',',$request->photos_ids);
            $photos = Image::whereIn('id',$images_ids)->get();

            foreach ($photos as $photo){
                $photo->prod_id = $product->id;

                if($images_ids[0] == $photo->id)
                    $photo->is_primary = 1;
                $photo->save();
            }
            $admin = User::where('role', 1)->get();
            Notification::send($admin, new NewOrder($product));
            return response()->json(['msg' => 'product created successfully.']);
        }
    }
    public function addImage(Request $request)
    {
        $data = $request->all();
        $validator = $this->imageValidator($data);

        if ($validator->fails()) {
            $errors = [];
            foreach($validator->errors()->toArray() as $key => $value){
                $errors[$key] = $value[0];
            }
            return response()->json(['errors' => $errors]);
        }

        $photo = unique_file($data['image']->getClientOriginalName());
        $data['image']->move(
            base_path() . '/public/images/products/', $photo
        );

        $image = new Image();
        $image->image = $photo;
        $image->save();

        return response()->json(['msg' => 'image uploaded successfully', 'image_id' => $image->id]);
    }


    private function imageValidator($data)
    {
        return Validator::make($data, [
            'image' => 'required|mimes:jpg,jpeg,png,gif|max:5120',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Route::current()->getPrefix() == 'olx/') {
            $product = Product::find($id);
            return view('olx.products.show', compact('product'));
        }
        $product = Product::where('id', $id)->with('user', 'category', 'images')->first();
        if (! $product)
            return response()->json(['msg' => 'invalid data']);
        return response()->json(['product' => $product]);
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
        $product = Product::find($id);
        if(! $product->images->isEmpty()){
            foreach ($product->images as $img){
                $old_file = 'images/products/' . $img->image;
                if (is_file($old_file)) unlink($old_file);
            }
            Image::where('prod_id', $id)->delete();
        }
        if (Route::current()->getPrefix() == 'olx/') {
            Rating::where('prod_id', $id)->delete();
            Product::destroy($id);
        }else{
            Product::destroy($id);
            return response()->json(['msg'=> 'product deleted successfully']);
        }
    }
    public function sendNotification(Request $request)
    {
//        dd($request->all());
        $this->validate($request, [
            'message' => 'required',
            'order_id' => 'required',
            'type' => 'required',
        ]);
        $order = Product::where('id', $request->order_id)->first();

        $user = $order->user;
        $title = $request->type == 0 ? 'Reject Order' : 'Accept Order';
        $message = $request->message;
        Notification::send($user, new NotifyOrder($order, $message, $title));
//        $user->notify(new NotifyOrder($order, $message, $title));
        $phone_datas = PhoneData::where('user_id', $order->user->id)
            ->get(); // user who receive notification
        $arr = [];
        foreach ($phone_datas as $phone_data)
            array_push($arr, $phone_data->token);
        Firebase_notifications_fcm(
            $arr,
            array(
                'title' => $title,
                'message' => $message,
            )
        );
        if ($request->type == 1)
            $order->update([
                'approve' => 1
            ]);
        else {
            if(! $order->images->isEmpty()){
                foreach ($order->images as $img){
                    $old_file = 'images/products/' . $img->image;
                    if (is_file($old_file)) unlink($old_file);
                }
                Image::where('prod_id', $order->id)->delete();
            }
            Product::destroy($order->id);
        }
        return redirect()->back()->with('success', 'Notification Sent Successfully.');
    }
}

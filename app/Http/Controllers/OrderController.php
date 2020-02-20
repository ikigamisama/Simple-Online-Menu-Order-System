<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\MenuCategory;
use App\Models\MenuItem;
use App\Models\MenuOrder;
use App\Models\MenuTemporaryOrder;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $categoryRoute = null){
        if(!session('CustomerName')){
            return redirect('/');
        }

        $category = MenuCategory::all();
        $item = null;
        if($categoryRoute !== null){
            switch($categoryRoute){
                case 'burgers':{
                    $item = MenuItem::where('category_id', "1")->get();
                    break;
                }
                case 'beverages':{
                    $item = MenuItem::where('category_id', "2")->get();
                    break;
                }
                case 'combo-meals':{
                    $item = MenuItem::where('category_id', "3")->get();
                    break;
                }
            }
        } 
        else{
            $item = MenuItem::all();  
        }
        $orderTempoList = MenuTemporaryOrder::where('customer_name',session('CustomerName'))->get();
        return view('order.index')
                ->with('category_list',$category)
                ->with('item_list',$item)
                ->with('category',$categoryRoute)
                ->with('order_list',$orderTempoList)
                ->with('coupon',session('Coupon'));;

    }
    public function welcomeOrder(){
        return view('index');
    }
    public function summaryOrder(){
        if(!session('CustomerName')){
            return redirect('/');
        }
        $orderTempoList = MenuTemporaryOrder::where('customer_name',session('CustomerName'))->get();
        return view('order.summary')->with('order_list',$orderTempoList)
                ->with('coupon',session('Coupon'))
                ->with('customer_name',session('CustomerName'));
    }

    public function doneOrder(){
        return view('order.success');
    }
    public function addName(Request $request){

        session(['CustomerName' => $request->customer_name]);

        if(session('CustomerName')){
            return 1;
        }
    }
    public function addOrder(Request $request){

        $arrayToJson = array(
            'quantity' => $request->quantity,
            'item_name' => $request->item_name,
            'item_price' => $request->item_price
        );
        
        $isOrderExists = MenuTemporaryOrder::where('customer_name',session('CustomerName'))->where('order_item',$request->item_name)->count();
        if($isOrderExists){
            $quantityChange = MenuTemporaryOrder::where('customer_name',session('CustomerName'))->where('order_item',$request->item_name)->firstOrFail();
            $quantityChange->quantity =  $quantityChange->quantity + 1;
            $quantityChange->save();

            $arrayToJson['last_insert_id'] = $quantityChange->id;
            $arrayToJson['new_quantity'] = $quantityChange->quantity;
            $arrayToJson['type'] = 'edit';           
        }
        else{
            $insertNewOrder = new MenuTemporaryOrder;
            $insertNewOrder->customer_name = session('CustomerName');
            $insertNewOrder->quantity = 1;
            $insertNewOrder->order_item = $request->item_name;
            $insertNewOrder->price = $request->item_price;
            $insertNewOrder->save();

            $arrayToJson['last_insert_id'] = $insertNewOrder->id; 
            $arrayToJson['type'] = 'insert';                
        }
        return response()->json($arrayToJson,200);
    }
    public function editQuantityOrder(Request $request){

        $quantityChange = MenuTemporaryOrder::where('customer_name',session('CustomerName'))->where('id',$request->id)->firstOrFail();
        $quantityChange->quantity = $request->quantity_new;
        $quantityChange->save();
    }
    public function deleteOrder(Request $request){
        $deleteOrder = MenuTemporaryOrder::where('id', $request->delete_data)->delete();
        if($deleteOrder){
            return 1;
        }
    }
    public function clearOrder(Request $request){
        $clearOrder = MenuTemporaryOrder::where('customer_name',session('CustomerName'))->delete();
        if($clearOrder){
            return 1;
        }
    }
    public function applyCoupon(Request $request){
        $arrayToJSON = array();
        if($request->coupon_code == "GO2018"){
            session(['Coupon' => $request->coupon_code]);
            $arrayToJSON['message'] = "Success Add Coupon";
        }
        else{
            $arrayToJSON['message'] = "Invalid Coupon Code";
        }
        return response()->json($arrayToJSON,200);
    }
    public function submitOrder(Request $request){
       $insertNewOrder = new MenuOrder;
       $insertNewOrder->customer_name = $request->customer_name;
       $insertNewOrder->order_coupon = (int)$request->order_coupon;
       $insertNewOrder->tax_price = (double)$request->tax_price;
       $insertNewOrder->total_price = (double)$request->total_price;
       $insertNewOrder->save();

       $request->session()->flush();
    }
}

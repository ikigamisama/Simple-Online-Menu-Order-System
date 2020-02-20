@include('layouts.header')
    <div class="container">
        <div class="row">
            <div class="col-8">
                <div class="order-component">
                    <div class="order-title">
                        <img src="{{asset('images/dish-dark.png')}}" alt="{{asset('images/dish-dark.png')}}">
                        <h2>CHOOSE <br> YOUR ORDER</h2>
                    </div>
                    <div class="order-content">
                        <div class="category-list-container">
                            @foreach($category_list as $categories => $category)
                                <div class="category-list-card">
                                    <img src="{{asset('images/category/' . $category->image)}}" alt="" >
                                    <p>{{$category->category}}</p>
                                </div> 
                            @endforeach
                        </div>
                        <div class="menu-list-container">
                            <div class="row">
                                @foreach($item_list as $items => $item)
                                    <div class="col-4">
                                        <div class="menu-list-card">
                                            <img src="{{asset('images/item/' . $item->image)}}" alt="{{$item->image}}">
                                            <p class="item-name">{{ $item->item }}</p>
                                            <p class="item-price">P {{ $item->price }}</p>
                                        </div> 
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="table-list-component">
                    <div class="order-title">
                        <img src="{{asset('images/dish-dark.png')}}" alt="{{asset('images/dish-dark.png')}}">
                        <h2>LIST <br> OF ORDER</h2>
                    </div>
                    <table class="table table-borderless" id="order_list">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Qty.</th>
                                <th scope="col">Item</th>
                                <th scope="col">Price</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order_list as $orders => $order)
                                <tr data-id="{{ $order->id }}">
                                    <td class="item-qty-list" scope="row" contenteditable>{{$order->quantity}}</td>
                                    <td>{{$order->order_item}}</td>
                                    <td>{{$order->price}}</td>
                                    <td><button class="btn btn-danger btn-sm btn-delete-order">Delete</button></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="button-list-order">
                        <button class="btn btn-warning btn-block" id="clear_list_order">CLEAR ORDER</button>
                        <button class="btn btn-success btn-block" id="move_summary">DONE </button>
                    </div>
                </div>
                <div class="table-list-component">
                    <div class="order-title">
                        <img src="{{asset('images/dish-dark.png')}}" alt="{{asset('images/dish-dark.png')}}">
                        <h2>COUPONS</h2>
                    </div>
                    <form method="post" id="coupon">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Enter Coupon" name="coupon_code" value="{{$coupon ?? ''}}">
                        </div>
                        <button class="btn btn-secondary btn-block" type="submit" id="button-addon2">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    

    <div class="modal fade" id="modal_coupon_message" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="coupon_message"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@include('layouts.footer')
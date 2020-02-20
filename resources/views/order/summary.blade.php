@include('layouts.header')
    <div class="container">
        <div class="table-list-component">
            <div class="order-summary-title">
                <img src="{{asset('images/dish-dark.png')}}" alt="{{asset('images/dish-dark.png')}}">
                <h2>ORDER <br> SUMMARY</h2>
            </div>
            <table class="table table-borderless" id="order_summary">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Qty.</th>
                        <th scope="col">Item</th>
                        <th scope="col">Price</th>
                        <th scope="col">Total Pirce</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order_list as $orders => $order)
                        <tr data-id="{{ $order->id }}">
                            <td class="quantity">{{$order->quantity}}</td>
                            <td class="items-ordered">{{$order->order_item}}</td>
                            <td class="price">{{$order->price}}</td>
                            <td class="total_price"></td>
                           
                        </tr>
                    @endforeach
                    <input type="hidden" id="customer_name" value="{{$customer_name}}">
                            <input type="hidden" id="coupon" value="{{$coupon ? 1 : 0}}">
                </tbody>
            </table>
            <div class="row">
                <div class="col-4">

                </div>
                <div class="col-4">
                   
                </div>
                <div class="col-4">
                    <div class="price-compute-component">
                        <p>Estimated Price: <span id="price_estimate"></span></p>
                        <p>Tax: <span id="tax"></span></p>
                        <p>Coupon: <span id="coupon">{{ $coupon ? "10%" : "None" }}</span></p>
                        <p>Total: <span id="total_price"></span></p>
                    </div>
                </div>
            </div>
            <div class="button-list-order">
                <button class="btn btn-warning btn-block" id="go_Back">GO BACK </button>
                <button class="btn btn-success btn-block" id="submit_order">ORDER </button>
            </div>
        </div>
    </div>
@include('layouts.footer')
@include('layouts.header')
    <div class="welcome-container">
        <h1>Welcome To My Restaurant</h1>
        <img class="logo" src="{{asset('images/dish.png')}}" alt="">
        <div class="input-form-component">
            <input type="text" id="customer_name" name="customer_name" placeholder="Enter Name">
            <span class="input-focus"></span>
        </div>
        <p id="error_submit_name"></p>
        <button id="submit_name" class="btn btn-lg btn-order">
            <span>TAKE ORDER</span>
        </button>
    </div>
@include('layouts.footer')
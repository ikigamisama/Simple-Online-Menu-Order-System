$(function(){
    var url =  window.location.protocol + '//'+  window.location.host; 
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#submit_name').click(function(){
        var customerName = $('#customer_name').val();

        if(customerName == ""){
            $('#customer_name').addClass('error')
            $('#error_submit_name').addClass('active').text("Please Enter your Name") ;
        }
        else{
            $.ajax({
                url:url + '/add_name',
                method:"POST",
                data:{'customer_name':customerName},
                success:function(data){
                    if(data) window.location.href = url + '/menu'
                }
            })
        }
    })
    $('#customer_name').focus(function(){
        $(this).removeClass('error')
        $('#error_submit_name').removeClass('active').text("");
    })

    $('.category-list-card').each(function(){
        $(this).click(function(){
            var linkTo = $(this).find('p').text().toLowerCase().replace(' ','-'),
                routeTo = window.location.protocol + '//'+  window.location.host + '/menu/' + linkTo;

            window.location.href = routeTo;
        })
    })

    $('.order-title').click(function(){
        var routeTo = window.location.protocol + '//'+  window.location.host + '/menu/';
        window.location.href = routeTo;
    })
    $('#move_summary').click(function(){
        var routeTo = window.location.protocol + '//'+  window.location.host + '/order_summary';
        window.location.href = routeTo;
    })
    $('#go_Back').click(function(){
        window.history.back();
    })

    $('.menu-list-card').each(function(){
        $(this).click(function(){
            var itemName = $(this).find('.item-name').text(),
            itemPrice = $(this).find('.item-price').text().replace('P ','');

            $.ajax({
                url:url + '/add_order',
                method:"POST",
                dataType: "json",
                data:{
                    'quantity' : 1,
                    'item_name' : itemName,
                    'item_price' : itemPrice,
                },
                success:function(data){
                    var data = JSON.parse(JSON.stringify(data))
                    if(data.type == 'insert'){
                        $('#order_list tbody').append(
                            '<tr data-id="'+data.last_insert_id+'"><td class="item-qty-list" scope="row" contenteditable>1</td><td class="item-name-list">'+data.item_name+'</td><td class="item-price-list">'+data.item_price+'</td><td><button class="btn btn-danger btn-sm btn-delete-order">Delete</button></td></tr>'
                        )
                    }
                    else{
                        $('#order_list tbody tr[data-id="'+data.last_insert_id+'"] td.item-qty-list').text(data.new_quantity);

                    }
                    
                }
            })
        })
    })
    $(document).on('click','.btn-delete-order',function(){
        var deleteID = $(this).parents('tr').data('id');
        $.ajax({
            url:url + '/delete_order',
            method:"POST",
            dataType: "json",
            data:{'delete_data':deleteID},
            success:function(){ 
            }
        })
        $(this).closest('tr').remove();
        return false;
    }).on('blur','.item-qty-list',function(){
        var newQuantityItem = parseInt($(this).text()),
            itemID = $(this).parents('tr').data('id');

        $.ajax({
            url:url + '/edit_quantity_order ',
            method:"POST",
            dataType: "json",
            data:{'quantity_new':newQuantityItem,'id':itemID},
            success:function(){

            }
        })
    })
    $('#clear_list_order').click(function(){
        $.ajax({
            url:url + '/clear_order',
            method:"POST",
            dataType: "json",
            data:{ },
            success:function(data){
                if(data)$('#order_list tbody').empty();
                
            }
        })
    })
    $('#coupon').submit(function(e){
        e.preventDefault();
        $.ajax({
            url:url + '/apply_coupon ',
            method:"POST",
            dataType: "json",
            data:$(this).serialize(),
            success:function(data){
                var data = JSON.parse(JSON.stringify(data))
                $('#coupon_message').text(data.message)
                $('#modal_coupon_message').modal('show')
            }
        })
       
    })


    function computingTotalOrderSummary(){
        $('#order_summary tbody tr').each(function(){
            var quantity = $(this).find('.quantity').text(),
                price = $(this).find('.price').text(),
                totalPrice = 0;
    
            totalPrice = quantity * price;
            $(this).find('.total_price').text(totalPrice);
    
        })
        var estimate_total_price = 0;
        var tax = 0;
        var coupon_discount = 0;
        var total = 0;
        $('.total_price').each(function(){
            estimate_total_price += parseFloat($(this).text());
        })
        tax = 0.12 * estimate_total_price;
        coupon_discount = (estimate_total_price + tax) - (estimate_total_price + tax) * 0.10   
        $('#price_estimate').text("P " + estimate_total_price.toFixed(2));
        $('#tax').text("P " + tax.toFixed(2));
        total = $('#coupon').text == "10%" ? coupon_discount : (estimate_total_price + tax)
        $('#total_price').text("P " + total.toFixed(2));

    }
    computingTotalOrderSummary();

    $('#submit_order').click(function(){
        var customerName = $('#customer_name').val(),
            orderCoupon = parseInt($('#coupon').val()),
            taxPrice = $('#tax').text().replace("P ", ''),
            totalPrice = $('#total_price').text().replace("P ", '');
        var routeTo = window.location.protocol + '//'+  window.location.host + '/order_success';
            
        $.ajax({
            url:url + '/submit_order',
            method:"POST",
            data:{
                'customer_name':customerName,
                'order_coupon': orderCoupon,
                'tax_price': taxPrice,  
                'total_price': totalPrice
            },
            success:function(){
                window.location.href = routeTo;
            }
        })
    })
})
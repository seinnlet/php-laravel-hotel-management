$(function () {

	show_product_count();

  function show_product_count() {

    // get cart JSON form localStorage
    let cart = localStorage.getItem('cart');

    if (cart) {
      let cart_obj = JSON.parse(cart);

      let order_count = 0, amount = 0;
      if (cart_obj.order_list) {
        $.each(cart_obj.order_list, function(i, v) {
          order_count += v.quantity;
          amount += +v.price;
        });
        
        $('.totalqty').text(order_count);
        $('.amount').text('$ ' + amount.toFixed(2));
      }

    }

  } 

	// function add to order list
	function add_to_cart(product) {

    let cart = localStorage.getItem('cart');
    if (!cart) {
      cart = '{"order_list":[]}';
    }

    let cart_obj = JSON.parse(cart);
    let has_value = false;
    $.each(cart_obj.order_list, function(i, v) {

      if (product.id == v.id) {
        v.quantity++;
        has_value = true;
      }

    });

    if (!has_value) {
      cart_obj.order_list.push(product);
    }

    localStorage.setItem('cart', JSON.stringify(cart_obj));
    // console.log(cart_obj);

  }

  $('.btn-add').click(function() {
			
		let id = $(this).data('id');
    let name = $(this).data('name');
    let price = $(this).data('price');

    var product = {
      id: id,
      name: name,
      price: price,
      quantity: 1
    };
    add_to_cart(product);
    show_product_count();
    doBounce($('.totalqty'), 1, '5px', 300);   
	});

  function doBounce(element, times, distance, speed) {
    for(i = 0; i < times; i++) {
      element.animate({marginTop: '-='+distance},speed)
          .animate({marginTop: '+='+distance},speed);
    }        
	}

	// in order list 
  showTable();

  function showTable() {

    let cart = localStorage.getItem('cart');
    if (cart) {

      let cart_obj = JSON.parse(cart);
      if (cart_obj.order_list) {
        if (cart_obj.order_list.length) {
          
          let html = ''; let total = 0;
          $.each(cart_obj.order_list, function(i, v) {
            html += `
           	<tr>
              <td class="td-delete">
                <button type="button" class="btn-delete" data-id='${v.id}'><i class="icofont-close"></i></button>
              </td>
              <td>
                ${v.name} <br> 
                <span class="font-italic"><small>$ ${v.price}</small></span>
              </td>
              <td class="td-qty">
                <button type="button" class="btn-minus" data-id='${v.id}'><i class="icofont-minus"></i></button>
                <span class="qty">${v.quantity}</span>
                <button type="button" class="btn-plus" data-id='${v.id}'><i class="icofont-plus"></i></button>
              </td>
              <td>$ ${(v.quantity * v.price).toFixed(2)}</td>
            </tr>
            `;
            total += v.quantity * v.price;
          });

          total = total.toFixed(2);
          $('#totalprice').val(total);
          $('#totalamount').text(total);

          $('#tbody-cart').html(html);

        } else {
          $("#table-order").html('<div class="col-12">There is no selected menu. <a href="/hotelservices/menus">Show Menu <i class="icofont-long-arrow-right"></i></div>');
        }
      } else {
        $("#table-order").html('<div class="col-12">There is no selected menu. <a href="/hotelservices/menus">Show Menu <i class="icofont-long-arrow-right"></i></div>');
      }

    } else {
      $("#table-order").html('<div class="col-12">There is no selected menu. <a href="/hotelservices/menus">Show Menu <i class="icofont-long-arrow-right"></i></div>');
    }

  }


  // plus - minus
  function change_product_quantity(type, id) {
    
    let cart = localStorage.getItem('cart');

    let cart_obj = JSON.parse(cart);
    $.each(cart_obj.order_list, function(i, v) {

      if (v.id == id) {
        if (type == 1) {
          v.quantity++;
        } else {

          if (v.quantity > 1) {
            v.quantity--;
          }
        }
      }

    });

    localStorage.setItem('cart', JSON.stringify(cart_obj));
    showTable();
    show_product_count();

  }

  // plus
  $('#tbody-cart').on('click', '.btn-plus', function() {
    let id = $(this).data('id');
    change_product_quantity(1, id);
  });
  // minus
  $('#tbody-cart').on('click', '.btn-minus', function() {
    let id = $(this).data('id');
    change_product_quantity(2, id);
  });

  $('#tbody-cart').on('click', '.btn-delete', function(e) {
			    
    swal({
  			title: "Are you sure to Delete?",
  			text: "The data will be permanently deleted.",
  			icon: "warning",
  			buttons: true,
  			dangerMode: true,
  		})
  		.then((willDelete) => {
  			if (willDelete) {

  				let cart = localStorage.getItem('cart');
			    let id = $(this).data('id');
  				
  				let cart_obj = JSON.parse(cart);
			    $.each(cart_obj.order_list, function(i, v) {
			      if (v.id == id) {
			        cart_obj.order_list.splice(i, 1);
			        return false;
			      }
			    });
			            
			    localStorage.setItem('cart', JSON.stringify(cart_obj));
			    showTable();
			    show_product_count();

  			} 
  		});	    
    
  });


}) // end of doc ready fun 
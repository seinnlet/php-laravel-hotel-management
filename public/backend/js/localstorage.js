$(function () {
	show_product_count();

  function show_product_count() {

    // get cart JSON form localStorage
    let cart = localStorage.getItem('cart');

    if (cart) {
      let cart_obj = JSON.parse(cart);

      let order_count = 0;
      if (cart_obj.order_list) {
        $.each(cart_obj.order_list, function(i, v) {
          order_count += v.quantity;
        });
        
        $('#order-count').html(`New Order Items: <span class="badge badge-primary badge-pill">${order_count}</span>`);
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
	});

  // in order create, like showing cart 
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
              <td>${i+1}.</td>
              <td>${v.name}</td>
              <td>$ ${v.price}</td>
              <td class='td-quantity'>
                <button type='button' class='btn btn-outline-secondary btn-sm btn-minus border-0 mr-2 px-2 rounded-circle' data-id='${v.id}'>
                  <i class="fas fa-minus"></i>
                </button>
                ${v.quantity}
                <button type='button' class='btn btn-outline-secondary btn-sm btn-plus border-0 ml-2 px-2 rounded-circle' data-id='${v.id}'>
                  <i class="fas fa-plus"></i>
                </button>
              </td>
              <td>$ ${(v.quantity * v.price).toFixed(2)}</td>
              <td align='center'><button type='button' class='btn btn-outline-danger border-0 btn-sm btn-remove px-2 rounded-circle' data-id='${v.id}'><i class="fas fa-times"></i></button></td>
            </tr>
            `;
            total += v.quantity * v.price;
          });

          total = total.toFixed(2);
          $('#totalprice').val(total);

          $('#tbody-cart').html(html);

        } else {
          $(".div-cart").html('<p>There is no Menu Selected to Order.</p>');
        }
      } else {
        $(".div-cart").html('<p>There is no Menu Selected to Order.</p>');
      }

    } else {
      $(".div-cart").html('<p>There is no Menu Selected to Order.</p>');
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

          if (v.quantity == 1) {
            let ans = confirm('Are you Sure to Delete?');
            if (ans) cart_obj.order_list.splice(i, 1);
            return false;
          } else {
            v.quantity--;
          }
        }
      }

    });

    localStorage.setItem('cart', JSON.stringify(cart_obj));
    showTable();

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

  $('#tbody-cart').on('click', '.btn-remove', function() {
    let cart = localStorage.getItem('cart');
    let id = $(this).data('id');

    let cart_obj = JSON.parse(cart);
    $.each(cart_obj.order_list, function(i, v) {
      if (v.id == id) {
        let ans = confirm('Are you Sure to Delete?');
        if (ans) cart_obj.order_list.splice(i, 1);
        return false;
      }
    });
            
    localStorage.setItem('cart', JSON.stringify(cart_obj));
    showTable();
    
  });

})
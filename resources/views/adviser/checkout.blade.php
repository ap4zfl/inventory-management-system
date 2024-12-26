@include('adviser.header')

<div class="container p-4">
    <h1>Checkout</h1>
    <div class="notifications"></div>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="cartItems">
                <!-- Cart items will be dynamically loaded here -->
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-between">
        <h4>Total Balance: £<span id="totalBalance">0.00</span></h4>
        {{-- <a href="/place-order" class="btn btn-primary place-order">Place Order</a> --}}
        <form action="">
            @csrf
            <button type="button" class="btn btn-primary place-order">Place Order</button>
        </form>
    </div>
</div>

<script>
$(document).ready(function() {
    // Fetch cart items using AJAX when the page loads
    $.ajax({
        url: '/checkout',  // Endpoint for fetching checkout data
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.cart && Object.keys(response.cart).length > 0) {
                // Populate cart items in the table
                let cartItems = '';
                Object.keys(response.cart).forEach(function(id) {
                    let item = response.cart[id];
                    cartItems += `
                        <tr>
                            <td>${id}</td>
                            <td>${item.name}</td>
                            <td>£${parseFloat(item.price).toFixed(2)}</td>
                            <td>${item.quantity}</td>
                            <td>£${(parseFloat(item.price) * item.quantity).toFixed(2)}</td>
                            <td>
                                <button class="btn btn-danger btn-sm remove-item" data-id="${id}">
                                    Remove
                                </button>
                            </td>
                        </tr>
                    `;
                });

                $('#cartItems').html(cartItems);
                $('#totalBalance').text(parseFloat(response.total_balance).toFixed(2));
            } else {
                $('#cartItems').html('<tr><td colspan="6" class="text-center">No items in the cart.</td></tr>');
            }
        },
        error: function() {
            alert('Failed to fetch cart data.');
        }
    });

    // Remove item from cart
    $(document).on('click', '.remove-item', function() {
        var productId = $(this).data('id');

        $.ajax({
            type: "POST",
            url: "/remove-from-cart",
            data: {
                id: productId,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.status === 200) {
                    $('button[data-id="' + productId + '"]').closest('tr').remove();
                    $('#totalBalance').text(response.total_balance.toFixed(2));
                    $('#cartCount').text(response.cart_count);
                    $('.notifications').html(response.message);
                } else {
                    alert(response.message);
                }
            }
        });
    });

    // Place order
    $('.place-order').on('click', function() {
        $.ajax({
            type: "POST",
            url: "/place-order",
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.status === 200) {
                    alert(response.message);
                    if (response.pdf_path) {
                    var pdfUrl = response.pdf_path;
                    window.open(pdfUrl, '_blank');
                }
                window.location.href = "/product"; 
                } else {
                    alert(response.message);
                }
            }
        });
    });
});
</script>

@include('adviser.footer')

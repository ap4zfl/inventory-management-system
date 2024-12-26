@include('adviser.header')

<div class="container p-4">
    <h1>All Products</h1>

  
    <div class="notifications"></div>
    <div class="table-responsive">
        <table id="productTable" class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>

<!-- Stack Comment Modal -->
<div class="modal fade" id="stackCommentModal" tabindex="-1" aria-labelledby="stackCommentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="stackCommentModalLabel">Add Stack Comment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <label for="stack_comment_input">Enter Stack Comment:</label>
                <input type="text" class="form-control" id="stack_comment_input" placeholder="Enter your comment">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="submitStackComment">Submit</button>
            </div>
        </div>
    </div>
</div>

<!-- Add to Cart Modal -->
<div class="modal fade" id="addToCartModal" tabindex="-1" aria-labelledby="addToCartModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addToCartModalLabel">Add to Cart</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <label for="cart_quantity_input">Enter Quantity:</label>
                <input type="number" class="form-control" id="cart_quantity_input" min="1" placeholder="Enter quantity">
                <div id="cart_error_message" class="text-danger mt-2 d-none">Quantity exceeds available stock!</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="submitCartQuantity">Add to Cart</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    var table = $('#productTable').DataTable({
        "order": []
    });

    viewProducts();

    function viewProducts() {
        $.ajax({
            type: "GET",
            url: "/view-products-adviser", 
            dataType: "json",
            success: function(response) {
                table.clear();
                $.each(response.products, function(keys, items) {
                    var actionButtons = '';
                    if (items.stack_comments === 'None') {
                        actionButtons += `
                            <button class="btn btn-info btn-sm stack-comment" data-id="${items.id}">
                                Stack Comment
                            </button>
                        `;
                    } else {
                        actionButtons += `
                            <button class="btn btn-warning btn-sm" disabled>
                                Processing...
                            </button>
                        `;
                    }
                    actionButtons += `
                        <button class="btn btn-success btn-sm add-to-cart" data-id="${items.id}" data-stock="${items.stock}" data-name="${items.name}">
                            Add to Cart
                        </button>
                    `;
                    var price = "€" + items.price;
                    table.row.add([
                        items.id,
                        items.name,
                        price,
                        items.stock,
                        actionButtons 
                    ]);
                });
                table.draw();
            }
        });
    }

    // Show Stack Comment Modal
    $('#productTable').on('click', '.stack-comment', function() {
        var productId = $(this).data('id');
        $('#submitStackComment').data('id', productId);
        $('#stackCommentModal').modal('show');
    });

    // Submit Stack Comment
    $('#submitStackComment').on('click', function() {
        var productId = $(this).data('id');
        var stackComment = $('#stack_comment_input').val();

        if (stackComment.trim() === '') {
            alert('Please enter a valid comment!');
            return;
        }

        $.ajax({
            type: "POST",
            url: "/update-stack-comment", 
            data: {
                id: productId,
                stack_comment: stackComment,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.status === 200) {
                    $('#stackCommentModal').modal('hide');
                    $('#stack_comment_input').val('');
                    viewProducts();
                    $('.notifications').html(response.message);
                } else {
                    alert('Failed to update stack comment');
                }
            }
        });
    });

    // Show Add to Cart Modal
    $('#productTable').on('click', '.add-to-cart', function() {
    var productId = $(this).data('id');
    var productStock = $(this).data('stock');
    var productName = $(this).data('name');
    
    // Store product details in modal for later use
    $('#addToCartModal').data('id', productId);
    $('#addToCartModal').data('stock', productStock);
    $('#addToCartModal').modal('show');
});

// Submit Cart Quantity
$('#submitCartQuantity').on('click', function() {
    var productId = $('#addToCartModal').data('id');
    var productStock = $('#addToCartModal').data('stock');
    var quantity = parseInt($('#cart_quantity_input').val());

    if (quantity > productStock) {
        $('#cart_error_message').removeClass('d-none');
    } else {
        $('#cart_error_message').addClass('d-none');

        // Send AJAX request to add to cart
        $.ajax({
            type: "POST",
            url: "/add-to-cart",
            data: {
                id: productId,
                quantity: quantity,
                _token: $('meta[name="csrf-token"]').attr('content') // CSRF Token for security
            },
            success: function(response) {
                if (response.status === 200) {
                    // Hide the modal and reset quantity input
                    $('#addToCartModal').modal('hide');
                    $('#cart_quantity_input').val('');
                    $('.notifications').html(response.message);
                    // $('.notifications').html(`Product added to cart successfully! Total items: ${response.cart_count}`);
                    
                    // Update the cart count in the UI
                    $('#cartCount').text(response.cart_count);  // Update cart count element with new value
                } else {
                    alert('Failed to add product to cart');
                }
            }
        });
    }
});

});
</script>

@include('adviser.footer')

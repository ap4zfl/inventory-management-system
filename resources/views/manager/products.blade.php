@include('manager.header')
<div class="container p-4">
    <h1>All Products</h1>
    <div class="notifications"></div>
   <div class="col-md-12 d-flex justify-content-end">
    <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addProductModal">Add New Product</button>
   </div>
   <div class="table-reponsive">
    <table id="productTable" class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Price</th>
                <th>Old Price</th>
                <th>Stock</th>
                <th>Hot</th>
                <th>Publish</th>
                <th>Images</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
   </div>
</div>
<!-- Add Product Modal -->
<div class="modal fade modal-lg" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductModalLabel">Add Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addProductForm" enctype="multipart/form-data">
               <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <label for="productName" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="productName" name="name" required>
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3">
                        <label for="productCategory" class="form-label">Product Category</label>
                        <select class="form-control" id="productCategory" name="product_cat" style="width: 100%;">
                            <option value="">Select Category</option>
                            @foreach($category as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->cat_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
               </div>
               <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <label for="productPrice" class="form-label">Price</label>
                        <input type="number" class="form-control" id="productPrice" name="price" required>
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3">
                        <label for="productOldPrice" class="form-label">Old Price</label>
                        <input type="number" class="form-control" id="productOldPrice" name="old_price" required>
                    </div>
                </div>
               </div>
               <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <label for="productStock" class="form-label">Stock</label>
                        <input type="number" class="form-control" id="productStock" name="stock" required>
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3">
                        <label for="productImage" class="form-label">Product Image</label>
                        <input type="file" class="form-control" id="productImage" name="image" accept="image/*" required>
                    </div>
                </div>
               </div>
                    <div class="mb-3">
                        <label for="productGallery" class="form-label">Product Gallery</label>
                        <input type="file" class="form-control" id="productGallery" name="gallery[]" accept="image/*" multiple required>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="editProductPrice" class="form-label">Short Descriptions <span class="text-danger">(Max 100 Characters)</span></label>
                                <textarea name="excerpt" maxlength="100"  class="form-control"  id="excerpt" cols="5" rows="5" required></textarea>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="editProductOldPrice" class="form-label w-100">Long Descriptions</label>
                                <textarea name="descriptions"  class="form-control"  id="descriptions" cols="5" rows="5" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label">Trending</label><br>
                                <input type="radio" id="hotYes" name="hot" value="Yes">
                                <label for="hotYes">Yes</label>
                                <input type="radio" id="hotNo" name="hot" value="No" checked>
                                <label for="hotNo">No</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label">Popular</label><br>
                                <input type="radio" id="popularYes" name="popular" value="Yes">
                                <label for="popularYes">Yes</label>
                                <input type="radio" id="popularNo" name="popular" value="No" checked>
                                <label for="popularNo">No</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label">Best Selling</label><br>
                                <input type="radio" id="bestsellingYes" name="bestselling" value="Yes">
                                <label for="bestsellingYes">Yes</label>
                                <input type="radio" id="bestsellingNo" name="bestselling" value="No" checked>
                                <label for="bestsellingNo">No</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label">Just Arrived</label><br>
                                <input type="radio" id="justarrivedYes" name="justarrived" value="Yes">
                                <label for="justarrivedYes">Yes</label>
                                <input type="radio" id="justarrivedNo" name="justarrived" value="No" checked>
                                <label for="justarrivedNo">No</label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Product</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Product Modal (same as Add Product Modal) -->

<div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProductModalLabel">Edit <span class="editproduct"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editProductForm" enctype="multipart/form-data">
                    <input type="hidden" id="editProductId" name="id">
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="editProductName" class="form-label">Product Name</label>
                                <input type="text" class="form-control" id="editProductName" name="name" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="editProductCategory" class="form-label">Product Category</label>
                                <select class="form-control select2" id="editProductCategory" name="product_cat" style="width: 100%;" required>
                                    <option value="">Select Category</option>
                                    @foreach($category as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->cat_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="editProductPrice" class="form-label">Price</label>
                                <input type="number" class="form-control" id="editProductPrice" name="price" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="editProductOldPrice" class="form-label">Old Price</label>
                                <input type="number" class="form-control" id="editProductOldPrice" name="old_price" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="editProductStock" class="form-label">Stock</label>
                                <input type="number" class="form-control" id="editProductStock" name="stock" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="editProductImage" class="form-label">Product Image</label>
                                <input type="file" class="form-control" id="editProductImage" name="image" accept="image/*">
                                <div id="editProductImagePreview" style="margin-top: 10px;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="editProductGallery" class="form-label">Product Gallery</label>
                        <input type="file" class="form-control" id="editProductGallery" name="gallery[]" accept="image/*" multiple>
                        <div id="editProductGalleryPreview" class="mt-2"></div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="editProductPrice" class="form-label">Short Descriptions <span class="text-danger">(Max 100 Characters)</label>
                                <textarea name="editexcerpt" maxlength="100" class="form-control"  id="editexcerpt" cols="5" rows="5" required></textarea>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="editProductOldPrice" class="form-label w-100">Long Descriptions</label>
                                <textarea name="editdescriptions"  class="form-control"  id="editdescriptions" cols="5" rows="5" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label">Hot</label><br>
                                <input type="radio" id="editHotYes" name="edithot" value="Yes">
                                <label for="editHotYes">Yes</label>
                                <input type="radio" id="editHotNo" name="edithot" value="No" checked>
                                <label for="editHotNo">No</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label">Popular</label><br>
                                <input type="radio" id="editPopularYes" name="editpopular" value="Yes">
                                <label for="editPopularYes">Yes</label>
                                <input type="radio" id="editPopularNo" name="editpopular" value="No" checked>
                                <label for="editPopularNo">No</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label">Best Selling</label><br>
                                <input type="radio" id="editbestsellingYes" name="editbestselling" value="Yes">
                                <label for="editbestsellingYes">Yes</label>
                                <input type="radio" id="editbestsellingNo" name="editbestselling" value="No" checked>
                                <label for="editbestsellingNo">No</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label">Just Arrived</label><br>
                                <input type="radio" id="editjustarrivedYes" name="editjustarrived" value="Yes">
                                <label for="editjustarrivedYes">Yes</label>
                                <input type="radio" id="editjustarrivedNo" name="editjustarrived" value="No" checked>
                                <label for="editjustarrivedNo">No</label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Product</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Product Confirmation Modal -->
<div class="modal fade" id="deleteProductModal" tabindex="-1" aria-labelledby="deleteProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteProductModalLabel">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this product?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteProduct">Delete</button>
            </div>
        </div>
    </div>
</div>
<!-- View Comment Modal -->
<div class="modal fade" id="viewCommentModal" tabindex="-1" aria-labelledby="viewCommentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewCommentModalLabel">View Comment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="productComment">No comment available</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal for updating stock -->
<div class="modal fade" id="updateStockModal" tabindex="-1" aria-labelledby="updateStockModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="updateStockModalLabel">Update Stock</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <label for="stock">Enter New Stock Quantity</label>
          <input type="number" class="form-control" id="newStock" required>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="confirmUpdateStock">Update Stock</button>
        </div>
      </div>
    </div>
  </div>
  

<script>
$(document).ready(function() {
    $('#productCategory').select2({
        placeholder: "Select a category",
        allowClear: true,
        dropdownParent: $('#addProductModal')
    });
    $('#editProductCategory').select2({
        placeholder: "Select a category",
        allowClear: true,
        dropdownParent: $('#editProductModal')
    });
    var table = $('#productTable').DataTable({
        "order": []
    });
    viewProducts();
    function viewProducts() {
    $.ajax({
        type: "GET",
        url: "/view-products", 
        dataType: "json",
        success: function(response) {
            table.clear();
            $.each(response.products, function(keys, items) {
            //    console.log(items);
                var actionButtons = `
                    <button class="btn btn-warning btn-sm edit-product" 
                        data-id="${items.id}" 
                        data-name="${items.name}" 
                        data-product_cat="${items.product_cat}" 
                        data-price="${items.price}" 
                        data-old_price="${items.old_price}" 
                        data-status="${items.status}"
                        data-stock="${items.stock}"
                        data-image="${items.image}"
                        data-excerpt="${items.excerpt}"
                        data-descriptions="${items.descriptions}"
                        data-hot="${items.hot}"
                        data-popular="${items.popular}"
                        data-bestselling="${items.bestselling}"
                        data-justarrived="${items.justarrived}"
                        data-gallery='${items.gallery ? JSON.stringify(items.gallery).replace(/\\"/g, '"') : "[]"}'>
                        Edit
                    </button>
                    <button class="btn btn-danger btn-sm delete-product" data-id="${items.id}">
                        Delete
                    </button>
                `;
                
                // Show Update Stock button if stack_comments is not "None"
                if (items.stack_comments && items.stack_comments !== "None") {
                    actionButtons += `
                        <button class="btn btn-info btn-sm view-comment" data-id="${items.id}">
                            View Comment
                        </button>
                        <button class="btn btn-primary btn-sm update-stock" data-id="${items.id}" data-name="${items.name}">
                            Update Stock
                        </button>
                    `;
                }

                var image = items.image ? `<img src="/${items.image}" width="50" height="50">` : 'No Image';
                // var gallery = 'No Gallery'; // Default value

                // // Check if gallery is a valid array or stringified array
                // if (Array.isArray(items.gallery)) {
                //     gallery = items.gallery.map(img => `<img src="/${img}" width="50" height="50">`).join(' ');
                // } else if (items.gallery) {
                //     try {
                //         var parsedGallery = JSON.parse(items.gallery);
                //         if (Array.isArray(parsedGallery)) {
                //             gallery = parsedGallery.map(img => `<img src="/${img}" width="50" height="50">`).join(' ');
                //         }
                //     } catch (e) {
                //         console.error('Error parsing gallery:', e);
                //     }
                // }
                var price = "€" + items.price;
                var old_price = "€" + items.old_price;

                var rowData = [
                    items.id,
                    items.name,
                    price,
                    old_price,
                    items.stock,
                    items.hot,
                    items.popular,
                    // image + '<br>' + gallery,
                    image,
                    actionButtons
                ];

                var rowNode = table.row.add(rowData).node();

                // Add table-warning class if stack_comments is not "None"
                if (items.stack_comments && items.stack_comments !== "None") {
                    $(rowNode).addClass('table-warning');
                }
            });
            table.draw();
        }
    });
}



  

$(document).on('click', '.edit-product', function() {
    const product = $(this).data();
    $('#editProductId').val(product.id);
    $('#editProductName').val(product.name);
    $('.editproduct').text(product.name);
    $('#editProductCategory').val(product.product_cat).trigger('change');
    $('#editProductPrice').val(product.price);
    $('#editProductOldPrice').val(product.old_price);
    $('#editProductStock').val(product.stock);
    $('#editexcerpt').val(product.excerpt);
    $('#editdescriptions').val(product.descriptions);
    $('#editHotYes').prop('checked', product.hot === 'Yes');
    $('#editHotNo').prop('checked', product.hot === 'No');
    $('#editPopularYes').prop('checked', product.popular === 'Yes');
    $('#editPopularNo').prop('checked', product.popular === 'No');
    $('#editbestsellingYes').prop('checked', product.bestselling === 'Yes');
    $('#editbestsellingNo').prop('checked', product.bestselling === 'No');
    $('#editjustarrivedYes').prop('checked', product.justarrived === 'Yes');
    $('#editjustarrivedNo').prop('checked', product.justarrived === 'No');
    if (product.gallery) {
        try {
            const galleryString = product.gallery.replace(/^"|"$/g, ''); 
            const gallery = JSON.parse(galleryString);
            const galleryHTML = gallery.map(img => `<img src="${img}" alt="Gallery Image" style="max-width: 50px; margin-right: 10px;">`).join('');
            $('#editProductGalleryPreview').html(galleryHTML);
        } catch (e) {
            console.error('Error parsing gallery:', e);
            $('#editProductGalleryPreview').html('');
        }
    } else {
        $('#editProductGalleryPreview').html('');
    }
    if (product.image) {
        $('#editProductImagePreview').html(`<img src="${product.image}" alt="Product Image" style="max-width: 50px; margin-top: 10px;">`);
    } else {
        $('#editProductImagePreview').html('');
    }
    $('#editProductModal').modal('show');
});


    $('#addProductForm').on('submit', function (e) {
    e.preventDefault();
    var formData = new FormData(this);
    formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
    $.ajax({
        url: '/add-product',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
         if (response.status === 200) {
                    $('#addProductModal').modal('hide');
                    $('#addProductForm')[0].reset(); 
                    viewProducts();
                    $('.notifications').html(response.message);
                } else {
                    alert('Failed to add product');
                }
            }
        });
    });
  


    $('#editProductForm').on('submit', function(e) {
    e.preventDefault();

    var productId = $('#editProductId').val();
    var name = $('#editProductName').val();
    var price = $('#editProductPrice').val();
    var oldPrice = $('#editProductOldPrice').val();
    var stock = $('#editProductStock').val();
    var excerpt = $('#editexcerpt').val();
    var descriptions = $('#editdescriptions').val();
    
    var hot = $('input[name="edithot"]:checked').val(); 
    var popular = $('input[name="editpopular"]:checked').val(); 
    var bestselling = $('input[name="editbestselling"]:checked').val(); 
    var justarrived = $('input[name="editjustarrived"]:checked').val(); 
    
    var productCat = $('#editProductCategory').val();
    
    var formData = new FormData();
    formData.append('id', productId);
    formData.append('name', name);
    formData.append('price', price);
    formData.append('old_price', oldPrice);
    formData.append('stock', stock);
    formData.append('excerpt', excerpt);  
    formData.append('descriptions', descriptions);  
    formData.append('hot', hot);  
    formData.append('popular', popular); 
    formData.append('bestselling', bestselling); 
    formData.append('justarrived', justarrived); 
    formData.append('product_cat', productCat);

    var imageFile = $('#editProductImage')[0].files[0];
    if (imageFile) {
        formData.append('image', imageFile);
    }
    
    var galleryFiles = $('#editProductGallery')[0].files;
    for (var i = 0; i < galleryFiles.length; i++) {
        formData.append('gallery[]', galleryFiles[i]);
    }

    formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

    $.ajax({
        type: "POST",
        url: "/edit-product",
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            if (response.status === 200) {
                $('#editProductModal').modal('hide');
                viewProducts(); 
                $('.notifications').html(response.message);
            } else {
                alert('Failed to update product');
            }
        }
    });
});




    // Delete Product
    $('#productTable').on('click', '.delete-product', function() {
        var productId = $(this).data('id');
        $('#confirmDeleteProduct').data('id', productId);
        $('#deleteProductModal').modal('show');
    });
    // Confirm Delete Product
    $('#confirmDeleteProduct').on('click', function() {
        var productId = $(this).data('id');
        $.ajax({
            type: "POST",
            url: "/delete-product", 
            data: {
                id: productId,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.status === 200) {
                    $('#deleteProductModal').modal('hide');
                    viewProducts();
                    $('.notifications').html(response.message);
                } else {
                    alert('Failed to delete product');
                }
            }
        });
    });
        // Show Comment in Modal
        $('#productTable').on('click', '.view-comment', function() {
        var productId = $(this).data('id');
        $.ajax({
            type: "GET",
            url: "/view-product-commentmanager/" + productId, 
            dataType: "json",
            success: function(response) {
                if (response.status === 200) {
                    $('#productComment').text(response.comment || 'No comment available');
                    $('#viewCommentModal').modal('show');
                } else {
                    alert('Failed to load comment');
                }
            }
        });
    });

    // Open Update Stock Modal
$('#productTable').on('click', '.update-stock', function() {
    var productId = $(this).data('id');
    var productName = $(this).data('name');
    $('#newStock').val(''); // Clear previous input
    $('#updateStockModal').data('id', productId).modal('show'); // Store productId in modal for later use
});

    $('#confirmUpdateStock').on('click', function() {
    var productId = $('#updateStockModal').data('id');
    var newStock = $('#newStock').val(); // Get new stock value

    if (!newStock) {
        alert('Please enter a valid stock value.');
        return;
    }

    $.ajax({
        type: "POST",
        url: "/update-stock", 
        data: {
            id: productId,
            stock: newStock,
            stack_comments: 'None',
            updated_at: new Date().toISOString(), // Current datetime in ISO format
            _token: $('meta[name="csrf-token"]').attr('content') // CSRF token
        },
        success: function(response) {
            if (response.status === 200) {
                $('#updateStockModal').modal('hide');
                    viewProducts();
                    $('.notifications').html(response.message);
                } else {
                    alert('Failed to update stack');
                }
        }
    });
});



});
</script>
@include('manager.footer')

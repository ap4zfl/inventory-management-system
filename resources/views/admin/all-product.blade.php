@include('admin.header')

<div class="container p-4">
    <h1>All Products</h1>
    <div class="notifications"></div>

    <table id="productTable" class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Price</th>
                {{-- <th>Status</th> --}}
                <th>Stock</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
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
<!-- Edit Product Modal (same as Add Product Modal) -->

<div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProductModalLabel"><span class="viewproduct"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form enctype="multipart/form-data">
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
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
            url: "/view-products-admin", 
            dataType: "json",
            success: function(response) {
                table.clear();
                $.each(response.products, function(keys, items) {
                    var actionButtons = `
                        <button class="btn btn-info btn-sm view-comment" data-id="${items.id}">
                            View Comment
                        </button>
                         <button class="btn btn-success btn-sm edit-product" 
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
                        data-gallery='${items.gallery ? JSON.stringify(items.gallery).replace(/\\"/g, '"') : "[]"}'>
                        View Details
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

    // Show Comment in Modal
    $('#productTable').on('click', '.view-comment', function() {
        var productId = $(this).data('id');
        $.ajax({
            type: "GET",
            url: "/view-product-comment/" + productId, 
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

    $(document).on('click', '.edit-product', function() {
    const product = $(this).data();
    $('#editProductId').val(product.id);
    $('#editProductName').val(product.name);
    $('.viewproduct').text(product.name);
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
});
</script>

@include('admin.footer')

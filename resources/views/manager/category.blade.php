@include('manager.header')
<div class="container p-4">
    <h1>Category</h1>
    <div class="notifications"></div>
   <div class="col-md-12 d-flex justify-content-end">
    <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addcategoryModal">Add New Category</button>
   </div>
   <div class="table-reponsive">
    <table id="categoryTable" class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Images</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
   </div>
</div>
<!-- Add Product Modal -->
<div class="modal fade" id="addcategoryModal" tabindex="-1" aria-labelledby="addcategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addcategoryModalLabel">Add Category</span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addcategoryForm" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="cat_name" class="form-label">Category Name</label>
                        <input type="text" class="form-control" id="cat_name" name="cat_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="cat_image" class="form-label">Category Image</label>
                        <input type="file" class="form-control" id="cat_image" name="cat_image" accept="image/*">
                    </div>
                    <button type="submit" class="btn btn-primary">Add Category</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Edit Product Modal (same as Add Product Modal) -->

<div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProductModalLabel">Edit <span class="editcategory"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editcategoryForm" enctype="multipart/form-data">
                    <input type="hidden" id="editcatId" name="id">
                    <div class="mb-3">
                        <label for="editcat_name" class="form-label">Category Name</label>
                        <input type="text" class="form-control" id="editcat_name" name="editcat_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="editcat_image" class="form-label">Product Image</label>
                        <input type="file" class="form-control" id="editcat_image" name="editcat_image" accept="image/*">
                        <div id="editcat_imagePreview" style="margin-top: 10px;"></div>
                    </div>
                   
                    <button type="submit" class="btn btn-primary">Update Category</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Delete Product Confirmation Modal -->
<div class="modal fade" id="deletecategoryModal" tabindex="-1" aria-labelledby="deletecategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deletecategoryModalLabel">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this category?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteProduct">Delete</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    var table = $('#categoryTable').DataTable({
        "order": []
    });
    viewProducts();
    function viewProducts() {
    $.ajax({
        type: "GET",
        url: "/view-category", 
        dataType: "json",
        success: function(response) {
            table.clear();
            $.each(response.category, function(keys, items) {
                var actionButtons = `
                    <button class="btn btn-warning btn-sm edit-category" data-id="${items.id}" 
                            data-cat_name="${items.cat_name}" 
                            data-cat_image="${items.cat_image}">
                        Edit
                    </button>
                    <button class="btn btn-danger btn-sm delete-category" data-id="${items.id}">
                        Delete
                    </button>
                `;

                var image = items.cat_image ? `<img src="/${items.cat_image}" width="50" height="50">` : 'No Image';
                var rowData = [
                    items.id,
                    items.cat_name,
                    image,
                    actionButtons
                ];
                var rowNode = table.row.add(rowData).node();
            });
            table.draw();
        }
    });
}



  

    $('#categoryTable').on('click', '.edit-category', function() {
    var productId = $(this).data('id');
    var name = $(this).data('cat_name');
    var image = $(this).data('cat_image');
    $('#editcatId').val(productId);
    $('#editcat_name').val(name);
    $('.editcategory').text(name);
    if (image) {
        $('#editcat_imagePreview').html(`<img src="/${image}" width="100" height="100">`);
    } else {
        $('#editcat_imagePreview').html('No Image');
    }
    $('#editProductModal').modal('show');
});
    $('#addcategoryForm').on('submit', function (e) {
    e.preventDefault();
    var formData = new FormData(this);
    formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
    $.ajax({
        url: '/add-category',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
         if (response.status === 200) {
                    $('#addcategoryModal').modal('hide');
                    $('#addcategoryForm')[0].reset(); 
                    viewProducts();
                    $('.notifications').html(response.message);
                } else {
                    alert('Failed to add product');
                }
            }
        });
    });
  


$('#editcategoryForm').on('submit', function(e) {
    e.preventDefault();
    var productId = $('#editcatId').val();
    var name = $('#editcat_name').val();
    var formData = new FormData();
    formData.append('id', productId);
    formData.append('editcat_name', name);
    var imageFile = $('#editcat_image')[0].files[0];
    if (imageFile) {
        formData.append('editcat_image', imageFile);
    }
    formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
    $.ajax({
        type: "POST",
        url: "/edit-category",
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
    $('#categoryTable').on('click', '.delete-category', function() {
        var productId = $(this).data('id');
        $('#confirmDeleteProduct').data('id', productId);
        $('#deletecategoryModal').modal('show');
    });
    $('#confirmDeleteProduct').on('click', function() {
        var productId = $(this).data('id');
        $.ajax({
            type: "POST",
            url: "/delete-category", 
            data: {
                id: productId,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.status === 200) {
                    $('#deletecategoryModal').modal('hide');
                    viewProducts();
                    $('.notifications').html(response.message);
                } else {
                    alert('Failed to delete product');
                }
            }
        });
    });
   

});
</script>
@include('manager.footer')

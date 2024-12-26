<x-header pagetitle="shop" />
<div class="shoptbanner bannerstyle">
    <div class="d-flex justify-content-center">
        <h2><span><a href="{{ url('/') }}">Home</a></span><span class="currenttext"> / Shop</span></h2>
    </div>
</div>
<div class="container-fluid my-5 py-4">
    <div class="row">
        <div class="col-md-3">
            <h1 class="mb-2">Filter</h1>
            <form id="filters-form">
                <div class="mb-4">
                    <h5>Category</h5>
                    @foreach ($categories as $category)
                        <div>
                            <input type="checkbox" name="categories[]" value="{{ $category->id }}" id="category-{{ $category->id }}">
                            <label for="category-{{ $category->id }}">{{ $category->cat_name }}</label>
                        </div>
                    @endforeach
                </div>

                <div class="mb-4">
                    <h5>Price</h5>
                    <select name="price" id="price-filter" class="form-select">
                        <option value="">Select</option>
                        <option value="low_to_high">Low to High</option>
                        <option value="high_to_low">High to Low</option>
                    </select>
                </div>

                <div class="mb-4">
                    <h5>Name</h5>
                    <select name="name" id="name-filter" class="form-select">
                        <option value="">Select</option>
                        <option value="asc">A to Z</option>
                        <option value="desc">Z to A</option>
                    </select>
                </div>

                <div class="mb-4">
                    <h5>Trending</h5>
                    <div>
                        <input type="checkbox" name="trendings" id="trendings" value="Yes">
                        <label for="trendings">Trending Products</label>
                    </div>
                </div>
                
                <div class="mb-4">
                    <h5>Bestselling</h5>
                    <div>
                        <input type="checkbox" name="bestselling" id="bestselling" value="Yes">
                        <label for="bestselling">Bestselling Products</label>
                    </div>
                </div>
                
                <div class="mb-4">
                    <h5>Popular</h5>
                    <div>
                        <input type="checkbox" name="popular" id="popular" value="Yes">
                        <label for="popular">Popular Products</label>
                    </div>
                </div>
                
                <div class="mb-4">
                    <h5>Just Arrived</h5>
                    <div>
                        <input type="checkbox" name="justarrived" id="justarrived" value="Yes">
                        <label for="justarrived">Just Arrived</label>
                    </div>
                </div>
                

                <button type="button" id="apply-filters" class="btn btn-primary w-100">Apply Filters</button>
            </form>
        </div>

 
        <div class="col-md-9">
            <h1  class="mb-2">Our Products</h1>
            <div class="row">
                <div class="col-md-12">
                    <div class="bootstrap-tabs product-tabs">
                        <div class="tabs-header d-flex justify-content-between border-bottom"></div>
                        <div id="product-grid" class="product-grid row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5">
                            <!-- Display Products -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<x-footer />

<script>
    $(document).ready(function () {
        $('#filters-form input[type="checkbox"]').prop('checked', false);
        loadProducts();
        $('#apply-filters').click(function () {
            const formData = $('#filters-form').serialize();
            loadProducts(formData);
        });

        function loadProducts(filters = '') {
            $.ajax({
                url: '/fetch-shop-products',
                method: 'GET',
                data: filters,
                success: function (response) {
                    const productGrid = $('#product-grid');
                    productGrid.empty();
                    if (response.length > 0) {
                        response.forEach(product => {
                            productGrid.append(`
                                <div class="col d-flex">
                                    <div class="product-item">
                                        <span class="badge bg-success position-absolute m-3">
                                            <del>£${product.old_price ?? ''}</del>
                                        </span>
                                        <a href="#" class="btn-wishlist">
                                            <svg width="24" height="24">
                                                <use xlink:href="#heart"></use>
                                            </svg>
                                        </a>
                                        <figure>
                                            <a href="/product/${product.slug}" title="${product.name}">
                                                <img src="/${product.image}" class="tab-image w-100" alt="${product.name}">
                                            </a>
                                        </figure>
                                        <h3>${product.name}</h3>
                                        <span class="qty">1 Item Price</span>
                                        <span class="price">£${product.price}</span>
                                        <div class="d-flex align-items-center justify-content-between">
                                        <div class="input-group product-qty">
                                            <span class="input-group-btn">
                                            <button type="button" class="quantity-left-minus btn btn-danger btn-number" data-type="minus">
                                                <svg width="16" height="16">
                                                <use xlink:href="#minus"></use>
                                                </svg>
                                            </button>
                                            </span>
                                            <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1">
                                            <span class="input-group-btn">
                                            <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus">
                                                <svg width="16" height="16">
                                                <use xlink:href="#plus"></use>
                                                </svg>
                                            </button>
                                            </span>
                                        </div>
                                        <a href="#" class="nav-link addtocartbtn">Add to Cart 
                                            <iconify-icon icon="uil:shopping-cart"></iconify-icon>
                                        </a>
                                        </div>
                                    </div>
                                </div>
                            `);
                        });
                    } else {
                        productGrid.html('<div class="col-12 text-center"><p class="text-muted">No products found</p></div>');
                    }
                },
                error: function () {
                    alert('Failed to load products. Please try again.');
                }
            });
        }
    });
</script>

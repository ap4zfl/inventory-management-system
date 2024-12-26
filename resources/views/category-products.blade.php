<x-header pagetitle="catgory-product" />

<section class="py-5">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="bootstrap-tabs product-tabs">
            <div class="tabs-header d-flex justify-content-between border-bottom my-5">
              <h3>Products in {{ $category->cat_name }} Category</h3>
            </div>
            <div class="product-grid row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5">
              @if ($trendings->isEmpty())
                <div class="col-12 text-center">
                  <p class="text-muted">No products found</p>
                </div>
              @else
                @foreach ($trendings as $trending)
                  <div class="col d-flex">
                    <div class="product-item">
                      <span class="badge bg-success position-absolute m-3">
                        <del>£{{ $trending->old_price }}</del>
                      </span>
                      <a href="#" class="btn-wishlist">
                        <svg width="24" height="24">
                          <use xlink:href="#heart"></use>
                        </svg>
                      </a>
                      <figure>
                        <a href="{{ url('product/' . $trending->slug) }}" title="{{ $trending->name }}">
                          <img src="{{ asset($trending->image) }}" class="tab-image w-100" alt="{{ $trending->name }}">
                        </a>
                      </figure>
                      <h3>{{ $trending->name }}</h3>
                      <span class="qty">1 Item Price</span>
                      <span class="price">£{{ $trending->price }}</span>
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
                @endforeach
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <x-footer />
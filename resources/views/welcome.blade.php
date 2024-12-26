

<x-header pagetitle="IMS-Home" />


<section class="py-3" style="background-image: url('images/background-pattern.jpg');background-repeat: no-repeat;background-size: cover;">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">

          <div class="banner-blocks">
          
            <div class="banner-ad large bg-info block-1">

              <div class="swiper main-swiper">
                <div class="swiper-wrapper">
                  
                  <div class="swiper-slide">
                    <div class="row banner-content p-5">
                      <div class="content-wrapper col-md-7">
                        <div class="categories my-3">Luxurious Design</div>
                        <h3 class="display-4">Elevate Your Living Room</h3>
                        <p>Discover the perfect blend of comfort and design with our modern collection. Featuring a range of elegant styles.</p>
                        <a href="{{ url('/shop')}}" class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1 px-4 py-3 mt-3">Shop Now</a>
                      </div>
                      <div class="img-wrapper col-md-5">
                        <img src="{{ url('my-images/f1.png')}}" class="img-fluid">
                      </div>
                    </div>
                  </div>
                  
                  <div class="swiper-slide">
                    <div class="row banner-content p-5">
                      <div class="content-wrapper col-md-7">
                        <div class="categories mb-3 pb-3">Secure Storage Solution</div>
                        <h3 class="banner-title">Keep Your Belongings Safe</h3>
                        <p> Invest in long-lasting protection with our heavy-duty safe almari. Built to resist forced entry and tampering.</p>
                        <a href="{{ url('/shop')}}" class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1">Shop Collection</a>
                      </div>
                      <div class="img-wrapper col-md-5">
                        <img src="{{ url('my-images/f3.png')}}" class="img-fluid">
                      </div>
                    </div>
                  </div>
                  
                  <div class="swiper-slide">
                    <div class="row banner-content p-5">
                      <div class="content-wrapper col-md-7">
                        <div class="categories mb-3 pb-3">Heavy Duty Safe</div>
                        <h3 class="banner-title">A Perfect Blend of Safety and Style for Your Home</h3>
                        <p>Designed with both aesthetics and functionality in mind, our safe almari features high-quality materials.</p>
                        <a href="{{ url('/shop')}}" class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1">Shop Collection</a>
                      </div>
                      <div class="img-wrapper col-md-5">
                        <img src="{{ url('my-images/f2.png')}}" class="img-fluid">
                      </div>
                    </div>
                  </div>
                </div>
                
                <div class="swiper-pagination"></div>

              </div>
            </div>
            
            <div class="banner-ad bg-success-subtle block-2" style="background:url('my-images/d1.png') no-repeat;background-position: right bottom">
              <div class="row banner-content p-5">

                <div class="content-wrapper col-md-7">
                  <div class="categories sale mb-3 pb-3">20% off</div>
                  <h3 class="banner-title">Dining Tables</h3>
                  <a href="{{ url('/shop')}}" class="d-flex align-items-center nav-link">Shop Collection <svg width="24" height="24"><use xlink:href="#arrow-right"></use></svg></a>
                </div>

              </div>
            </div>

            <div class="banner-ad bg-danger block-3" style="background:url('my-images/d2.png') no-repeat;background-position: right bottom">
              <div class="row banner-content p-5">

                <div class="content-wrapper col-md-7">
                  <div class="categories sale mb-3 pb-3">15% off</div>
                  <h3 class="item-title">FASONLA Bed</h3>
                  <a href="{{ url('/shop')}}" class="d-flex align-items-center nav-link">Shop Collection <svg width="24" height="24"><use xlink:href="#arrow-right"></use></svg></a>
                </div>

              </div>
            </div>

          </div>
          <!-- / Banner Blocks -->
            
        </div>
      </div>
    </div>
  </section>

  <section class="py-5 overflow-hidden">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">

          <div class="section-header d-flex flex-wrap justify-content-between mb-5">
            <h2 class="section-title">Category</h2>

            <div class="d-flex align-items-center">
              <a href="{{ url('shop')}}" class="btn-link text-decoration-none">View All Categories →</a>
              <div class="swiper-buttons">
                <button class="swiper-prev category-carousel-prev btn btn-yellow">❮</button>
                <button class="swiper-next category-carousel-next btn btn-yellow">❯</button>
              </div>
            </div>
          </div>
          
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="category-carousel swiper">
              <div class="swiper-wrapper">
                  @foreach ($categories as $category)
                      <a href="{{ url('/category/' . $category->cat_slug) }}" class="nav-link category-item swiper-slide">
                          <img src="{{ asset( $category->cat_image) }}" alt="{{ $category->cat_name }}" style="width: 50px">
                          <h3 class="category-title">{{ $category->cat_name }}</h3>
                      </a>
                  @endforeach
              </div>
          </div>
      </div>
      
      </div>
    </div>
  </section>

  <section class="py-5">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="bootstrap-tabs product-tabs">
            <div class="tabs-header d-flex justify-content-between border-bottom my-5">
              <h3>Trending Products</h3>
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
  
  

  <section class="py-5">
    <div class="container-fluid">
      <div class="row">
        
        <div class="col-md-6">
          <div class="banner-ad bg-danger mb-3" style="background: url('my-images/d2.png');background-repeat: no-repeat;background-position: right bottom;">
            <div class="banner-content p-5">

              <div class="categories text-primary fs-3 fw-bold">Upto 20% Off</div>
              <h3 class="banner-title">FASONLA Bed</h3>
              <p> Crafted with high-quality materials.</p>
              <a href="#" class="btn btn-dark text-uppercase">Show Now</a>

            </div>
          
          </div>
        </div>
        <div class="col-md-6">
          <div class="banner-ad bg-info" style="background: url('my-images/d1.png');background-repeat: no-repeat;background-position: right bottom;">
            <div class="banner-content p-5">

              <div class="categories text-primary fs-3 fw-bold">Upto 15% Off</div>
              <h3 class="banner-title">Dining Tables</h3>
              <p>Available in various materials, sizes, and designs.</p>
              <a href="#" class="btn btn-dark text-uppercase">Show Now</a>

            </div>
          
          </div>
        </div>
           
      </div>
    </div>
  </section>

  <section class="py-5 overflow-hidden">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="section-header d-flex flex-wrap justify-content-between my-5">
            <h2 class="section-title">Best Selling Products</h2>
            <div class="d-flex align-items-center">
              <a href="{{ url('shop')}}" class="btn-link text-decoration-none">View All Products →</a>
              <div class="swiper-buttons">
                <button class="swiper-prev products-carousel-prev btn btn-primary">❮</button>
                <button class="swiper-next products-carousel-next btn btn-primary">❯</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="products-carousel swiper">
            <div class="swiper-wrapper">
              @if ($bestselling->isEmpty())
                <div class="col-12 text-center">
                  <p class="text-muted">No products found</p>
                </div>
              @else
                @foreach ($bestselling as $bestsell)
                  <div class="product-item swiper-slide">
                    <span class="badge bg-success position-absolute m-3"><del>£{{ $bestsell->old_price }}</del></span>
                    <a href="#" class="btn-wishlist">
                      <svg width="24" height="24">
                        <use xlink:href="#heart"></use>
                      </svg>
                    </a>
                    <figure>
                      <a href="{{ url('product/' . $bestsell->slug) }}" title="{{ $bestsell->name }}">
                        <img src="{{ asset($bestsell->image) }}" class="tab-image w-100" alt="{{ $bestsell->name }}">
                      </a>
                    </figure>
                    <h3>{{ $bestsell->name }}</h3>
                    <span class="qty">1 Item Price</span>
                    <span class="price">£{{ $bestsell->price }}</span>
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
                @endforeach
              @endif
            </div>
          </div>
          <!-- / products-carousel -->
        </div>
      </div>
    </div>
  </section>
  
  

  <section class="py-5">
    <div class="container-fluid">

      <div class="bg-secondary py-5 my-5 rounded-5" style="background: url('images/bg-leaves-img-pattern.png') no-repeat;">
        <div class="container my-5">
          <div class="row">
            <div class="col-md-6 p-5">
              <div class="section-header">
                <h2 class="section-title display-4">Get <span class="text-primary">25% Discount</span> on your first purchase</h2>
              </div>
              <p>It's our way of welcoming you to a world of premium quality and stylish products. Whether you're upgrading your home, office, or shopping for essentials.</p>
            </div>
            <div class="col-md-6 p-5">
              <form>
                <div class="mb-3">
                  <label for="name" class="form-label">Name</label>
                  <input type="text"
                    class="form-control form-control-lg" name="name" id="name" placeholder="Name">
                </div>
                <div class="mb-3">
                  <label for="" class="form-label">Email</label>
                  <input type="email" class="form-control form-control-lg" name="email" id="email" placeholder="abc@mail.com">
                </div>
                <div class="form-check form-check-inline mb-3">
                  <label class="form-check-label" for="subscribe">
                  <input class="form-check-input" type="checkbox" id="subscribe" value="subscribe">
                  Subscribe to the newsletter</label>
                </div>
                <div class="d-grid gap-2">
                  <button type="submit" class="btn btn-dark btn-lg">Submit</button>
                </div>
              </form>
              
            </div>
            
          </div>
          
        </div>
      </div>
      
    </div>
  </section>

  <section class="py-5">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="bootstrap-tabs product-tabs">
            <div class="tabs-header d-flex justify-content-between border-bottom my-5">
              <h3>Most Popular Products</h3>
            </div>
            <div class="product-grid row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5">
              @if ($populars->isEmpty())
                <div class="col-12 text-center">
                  <p class="text-muted">No products found</p>
                </div>
              @else
                @foreach ($populars as $popular)
                <div class="col d-flex">
                  <div class="product-item">
                    <span class="badge bg-success position-absolute m-3">
                      <del>£{{ $popular->old_price }}</del>
                    </span>
                    <a href="#" class="btn-wishlist">
                      <svg width="24" height="24">
                        <use xlink:href="#heart"></use>
                      </svg>
                    </a>
                    <figure>
                      <a href="{{ url('product/' . $popular->slug) }}" title="{{ $popular->name }}">
                        <img src="{{ asset($popular->image) }}" class="tab-image w-100" alt="{{ $trending->name }}">
                      </a>
                    </figure>
                    <h3>{{ $popular->name }}</h3>
                    <span class="qty">1 Item Price</span>
                    <span class="price">£{{ $popular->price }}</span>
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

  <section class="py-5 overflow-hidden">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="section-header d-flex flex-wrap justify-content-between my-5">
            <h2 class="section-title">Just arrived</h2>
            <div class="d-flex align-items-center">
              <a href="{{ url('shop')}}" class="btn-link text-decoration-none">View All Products →</a>
              <div class="swiper-buttons">
                <button class="swiper-prev products-carousel-prev btn btn-primary">❮</button>
                <button class="swiper-next products-carousel-next btn btn-primary">❯</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="products-carousel swiper">
            <div class="swiper-wrapper">
              @if ($justarrived->isEmpty())
                <div class="col-12 text-center">
                  <p class="text-muted">No products found</p>
                </div>
              @else
                @foreach ($justarrived as $justarrive)
                  <div class="product-item swiper-slide">
                    <span class="badge bg-success position-absolute m-3"><del>£{{ $justarrive->old_price }}</del></span>
                    <a href="#" class="btn-wishlist">
                      <svg width="24" height="24">
                        <use xlink:href="#heart"></use>
                      </svg>
                    </a>
                    <figure>
                      <a href="{{ url('product/' . $justarrive->slug) }}" title="{{ $justarrive->name }}">
                        <img src="{{ asset($justarrive->image) }}" class="tab-image w-100" alt="{{ $justarrive->name }}">
                      </a>
                    </figure>
                    <h3>{{ $justarrive->name }}</h3>
                    <span class="qty">1 Item Price</span>
                    <span class="price">£{{ $justarrive->price }}</span>
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
                @endforeach
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="py-5 my-5">
    <div class="container-fluid">

      <div class="bg-warning py-5 rounded-5" style="background-image: url('images/bg-pattern-2.png') no-repeat;">
        <div class="container">
          <div class="row">
            <div class="col-md-4">
              <img src="{{ url('my-images/f3.png')}}" alt="phone" class="image-float img-fluid">
            </div>
            <div class="col-md-8">
              <h2 class="mt-5">Shop faster with IMS App</h2>
              <p>Shop faster and more conveniently with the IMS App, your ultimate companion for furniture shopping. Explore a wide range of stylish and functional furniture pieces tailored to suit every space and style. From sleek modern designs to timeless classics, the app offers an effortless browsing experience with intuitive filters to find exactly what you need. Enjoy exclusive deals, easy payment options, and seamless delivery scheduling—all at your fingertips. Transform your home with IMS and make shopping for furniture a hassle-free delight.</p>
              <div class="d-flex gap-2 flex-wrap">
                <img src="images/app-store.jpg" alt="app-store">
                <img src="images/google-play.jpg" alt="google-play">
              </div>
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </section>

  <section class="py-5">
    <div class="container-fluid">
      <h2 class="my-5">People are also looking for</h2>
      @foreach($peoplelooking as $product)
        <a href="{{ url('product/' . $product->slug) }}" class="btn btn-warning me-2 mb-2">{{ $product->name }}</a>
      @endforeach
    </div>
  </section>
  

  <section class="py-5">
    <div class="container-fluid">
      <div class="row row-cols-1 row-cols-sm-3 row-cols-lg-5">
        <div class="col">
          <div class="card mb-3 border-0">
            <div class="row">
              <div class="col-md-2 text-dark">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="currentColor" d="M21.5 15a3 3 0 0 0-1.9-2.78l1.87-7a1 1 0 0 0-.18-.87A1 1 0 0 0 20.5 4H6.8l-.33-1.26A1 1 0 0 0 5.5 2h-2v2h1.23l2.48 9.26a1 1 0 0 0 1 .74H18.5a1 1 0 0 1 0 2h-13a1 1 0 0 0 0 2h1.18a3 3 0 1 0 5.64 0h2.36a3 3 0 1 0 5.82 1a2.94 2.94 0 0 0-.4-1.47A3 3 0 0 0 21.5 15Zm-3.91-3H9L7.34 6H19.2ZM9.5 20a1 1 0 1 1 1-1a1 1 0 0 1-1 1Zm8 0a1 1 0 1 1 1-1a1 1 0 0 1-1 1Z"/></svg>
              </div>
              <div class="col-md-10">
                <div class="card-body p-0">
                  <h5>Free delivery</h5>
                  <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipi elit.</p>
                </div>
              </div>
            </div>
            </div>
        </div>
        <div class="col">
          <div class="card mb-3 border-0">
            <div class="row">
              <div class="col-md-2 text-dark">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="currentColor" d="M19.63 3.65a1 1 0 0 0-.84-.2a8 8 0 0 1-6.22-1.27a1 1 0 0 0-1.14 0a8 8 0 0 1-6.22 1.27a1 1 0 0 0-.84.2a1 1 0 0 0-.37.78v7.45a9 9 0 0 0 3.77 7.33l3.65 2.6a1 1 0 0 0 1.16 0l3.65-2.6A9 9 0 0 0 20 11.88V4.43a1 1 0 0 0-.37-.78ZM18 11.88a7 7 0 0 1-2.93 5.7L12 19.77l-3.07-2.19A7 7 0 0 1 6 11.88v-6.3a10 10 0 0 0 6-1.39a10 10 0 0 0 6 1.39Zm-4.46-2.29l-2.69 2.7l-.89-.9a1 1 0 0 0-1.42 1.42l1.6 1.6a1 1 0 0 0 1.42 0L15 11a1 1 0 0 0-1.42-1.42Z"/></svg>
              </div>
              <div class="col-md-10">
                <div class="card-body p-0">
                  <h5>100% secure payment</h5>
                  <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipi elit.</p>
                </div>
              </div>
            </div>
            </div>
        </div>
        <div class="col">
          <div class="card mb-3 border-0">
            <div class="row">
              <div class="col-md-2 text-dark">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="currentColor" d="M22 5H2a1 1 0 0 0-1 1v4a3 3 0 0 0 2 2.82V22a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1v-9.18A3 3 0 0 0 23 10V6a1 1 0 0 0-1-1Zm-7 2h2v3a1 1 0 0 1-2 0Zm-4 0h2v3a1 1 0 0 1-2 0ZM7 7h2v3a1 1 0 0 1-2 0Zm-3 4a1 1 0 0 1-1-1V7h2v3a1 1 0 0 1-1 1Zm10 10h-4v-2a2 2 0 0 1 4 0Zm5 0h-3v-2a4 4 0 0 0-8 0v2H5v-8.18a3.17 3.17 0 0 0 1-.6a3 3 0 0 0 4 0a3 3 0 0 0 4 0a3 3 0 0 0 4 0a3.17 3.17 0 0 0 1 .6Zm2-11a1 1 0 0 1-2 0V7h2ZM4.3 3H20a1 1 0 0 0 0-2H4.3a1 1 0 0 0 0 2Z"/></svg>
              </div>
              <div class="col-md-10">
                <div class="card-body p-0">
                  <h5>Quality guarantee</h5>
                  <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipi elit.</p>
                </div>
              </div>
            </div>
            </div>
        </div>
        <div class="col">
          <div class="card mb-3 border-0">
            <div class="row">
              <div class="col-md-2 text-dark">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="currentColor" d="M12 8.35a3.07 3.07 0 0 0-3.54.53a3 3 0 0 0 0 4.24L11.29 16a1 1 0 0 0 1.42 0l2.83-2.83a3 3 0 0 0 0-4.24A3.07 3.07 0 0 0 12 8.35Zm2.12 3.36L12 13.83l-2.12-2.12a1 1 0 0 1 0-1.42a1 1 0 0 1 1.41 0a1 1 0 0 0 1.42 0a1 1 0 0 1 1.41 0a1 1 0 0 1 0 1.42ZM12 2A10 10 0 0 0 2 12a9.89 9.89 0 0 0 2.26 6.33l-2 2a1 1 0 0 0-.21 1.09A1 1 0 0 0 3 22h9a10 10 0 0 0 0-20Zm0 18H5.41l.93-.93a1 1 0 0 0 0-1.41A8 8 0 1 1 12 20Z"/></svg>
              </div>
              <div class="col-md-10">
                <div class="card-body p-0">
                  <h5>guaranteed savings</h5>
                  <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipi elit.</p>
                </div>
              </div>
            </div>
            </div>
        </div>
        <div class="col">
          <div class="card mb-3 border-0">
            <div class="row">
              <div class="col-md-2 text-dark">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="currentColor" d="M18 7h-.35A3.45 3.45 0 0 0 18 5.5a3.49 3.49 0 0 0-6-2.44A3.49 3.49 0 0 0 6 5.5A3.45 3.45 0 0 0 6.35 7H6a3 3 0 0 0-3 3v2a1 1 0 0 0 1 1h1v6a3 3 0 0 0 3 3h8a3 3 0 0 0 3-3v-6h1a1 1 0 0 0 1-1v-2a3 3 0 0 0-3-3Zm-7 13H8a1 1 0 0 1-1-1v-6h4Zm0-9H5v-1a1 1 0 0 1 1-1h5Zm0-4H9.5A1.5 1.5 0 1 1 11 5.5Zm2-1.5A1.5 1.5 0 1 1 14.5 7H13ZM17 19a1 1 0 0 1-1 1h-3v-7h4Zm2-8h-6V9h5a1 1 0 0 1 1 1Z"/></svg>
              </div>
              <div class="col-md-10">
                <div class="card-body p-0">
                  <h5>Daily offers</h5>
                  <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipi elit.</p>
                </div>
              </div>
            </div>
            </div>
        </div>
      </div>
    </div>
  </section>




<x-footer />
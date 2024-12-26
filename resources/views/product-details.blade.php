<x-header pagetitle="page-details" />
<style>
    .slick-slide{
        margin-right: 7px;
    }
    .slick-slide img{
        width: 200px;
        height: 100px;
        object-fit: cover;
    }
    .ashover a:hover{
        color:#FFCD5E;
    }
</style>
<div class="container-fluid my-5">
    <div class="row">
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-6 position-relative">
                    <img src="{{ asset($product->image) }}" class="tab-image w-100" alt="{{ $product->name }}">
                    <span class="badge bg-success position-absolute m-3" style="left: 0">
                        <del>£{{ $product->old_price }}</del>
                      </span>
                    @php
                        $galleryImages = json_decode($product->gallery);
                    @endphp
                      <div class="product-gallery mt-2">
                        <div class="slick-slider">
                          @foreach($galleryImages as $image)
                            <div>
                              <img src="{{ asset($image) }}" alt="Product Image" class="w-100">
                            </div>
                          @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-md-6">

                  <div class="product-item">
                    <h3  style="font-size:36px; margin-bottom:1rem;">{{ $product->name }}</h3>
                    <span class="price">£{{ $product->price }}</span>
                    <p>{{ $product->excerpt }}</p>
                    <div class="d-flex align-items-center">
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
            </div>
            <div class="mt-3">
                <h2>Description</h2> 
                <p>{{ $product->descriptions }}</p>
            </div>
        </div>
        <div class="col-md-3">

            @if ($trendings->isNotEmpty())
                <div class="categories ashover">
                    <h4>Categories</h4>
                    @foreach ($categories as $category)
                        <a href="{{ url('/category/' . $category->cat_slug) }}" class="nav-link category-item swiper-slide">
                            <p>
                                <img src="{{ asset($category->cat_image) }}" alt="{{ $category->cat_name }}" style="width: 50px">
                                <span>{{ $category->cat_name }}</span>
                            </p>
                        </a>
                    @endforeach
                </div>
            @endif

            @if ($trendings->isNotEmpty())
                <div class="trendings ashover">
                    <h4>Trending</h4>
                    @foreach ($trendings as $trending)
                        <a href="{{ url('/product/' . $trending->slug) }}" class="nav-link category-item swiper-slide">
                            <p>
                                <img src="{{ asset($trending->image) }}" alt="{{ $trending->name }}" style="width: 50px">
                                <span>{{ $trending->name }}</span>
                            </p>
                        </a>
                    @endforeach
                </div>
            @endif

        @if ($bestselling->isNotEmpty())
            <div class="bestselling ashover">
                <h4>Best Selling</h4>
                @foreach ($bestselling as $bestselling)
                <a href="{{ url('/product/' . $bestselling->slug) }}" class="nav-link category-item swiper-slide">
                    <p>
                        <img src="{{ asset($bestselling->image) }}" alt="{{ $bestselling->name }}" style="width: 50px">
                        <span>{{ $bestselling->name }}</span>
                    </p>
                </a>
            @endforeach
            </div>
        @endif

    @if ($populars->isNotEmpty())
        <div class="popular ashover">
            <h4>Popular</h4>
            @foreach ($populars as $popular)
            <a href="{{ url('/product/' . $popular->slug) }}" class="nav-link category-item swiper-slide">
                <p>
                    <img src="{{ asset($popular->image) }}" alt="{{ $popular->name }}" style="width: 50px">
                    <span>{{ $popular->name }}</span>
                </p>
            </a>
        @endforeach
        </div>
    @endif

    @if ($justarrived->isNotEmpty())
        <div class="justarrived ashover">
            <h4>Just Arrived</h4>
            @foreach ($justarrived as $justarrived)
            <a href="{{ url('/product/' . $justarrived->slug) }}" class="nav-link category-item swiper-slide">
                <p>
                    <img src="{{ asset($justarrived->image) }}" alt="{{ $justarrived->name }}" style="width: 50px">
                    <span>{{ $justarrived->name }}</span>
                </p>
            </a>
        @endforeach
        </div>
    @endif
        
        </div>
    </div>
</div>

<x-footer />

<script>
    $(document).ready(function() {
  $('.slick-slider').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 2000,
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 2,  
          slidesToScroll: 1,
        }
      },
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 1, 
          slidesToScroll: 1,
        }
      }
    ]
  });
});

</script>

<section class="shop_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>Latest Products</h2>
        </div>

        @if ($products && $products->count() > 0)
        <div class="row">
            @foreach ($products as $product)
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="box">
                        <a href="{{ url('products/' . $product->id) }}">
                            <div class="img-box">
                                <img src="{{ $product->image ? asset('images/' . $product->image) : asset('images/default-placeholder.png') }}" alt="{{ $product->title }}">
                            </div>
                            <div class="detail-box">
                                <h6>{{ $product->title }}</h6>
                                <h6><span>${{ number_format($product->price, 2) }}</span></h6>
                            </div>
                            <div class="new">
                                <span>New</span>
                            </div>
                        </a>
                        <div style="padding: 10px">
                            <a href="{{ url('product_details/' . $product->id) }}" class="btn btn-danger">Details</a>
                            <a href="{{ url('add_cart/' . $product->id) }}" class="btn btn-primary">Add To Cart</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-center text-muted">No products available at this time. Please check back later!</p>
    @endif


        <div class="btn-box">
            <a href="{{ url('products') }}">View All Products</a>
        </div>
    </div>
</section>

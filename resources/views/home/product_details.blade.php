<!DOCTYPE html>
<html>

<head>

    @include('home.css')
</head>

<body>
    <div class="hero_area">
        <!-- header section strats -->
        @include('home.header')
        <!-- end header section -->

    </div>
    <!-- end hero area -->

    <section class="shop_section layout_padding">
        <div class="container">
            <div class="heading_container heading_center">
                <h2>Latest Products</h2>
            </div>

                <div class="row">
                        <div class="col-md-11">
                            <div class="box">
                                <a href="{{ url('products/' . $products->id) }}">
                                    <div class="img-box">
                                        <img src="{{ asset('images/' . $products->image) }}" alt="{{ $products->title }}">
                                    </div>
                                    <div class="detail-box"style="padding:15px">
                                        <h6>{{ $products->title }}</h6>
                                        <h6><span>${{ number_format($products->price, 2) }}</span></h6>
                                    </div>
                                    <div class="detail-box" style="padding:15px">
                                        <h6>Category:{{ $products->category_id  }}</h6>

                                        <h6>Available Quantity
                                            <span>{{ $products->quantity }}</span>
                                        </h6>
                                    </div>



                                    <div class="detail-box"style="padding:15px">
                                        <p>{{$products->description}}</p>
                                    </div>
                                    <div class="new">
                                        <span>New</span>
                                    </div>
                                </a>

                                <div style="padding: 10px">
                                    <a href="{{ url('product_details', $products->id) }}" class="btn btn-danger">Details</a>
                                </div>
                            </div>
                        </div>
                </div>

            <div class="btn-box">
                <a href="{{ url('view_products') }}">View All Products</a>
            </div>
        </div>
    </section>


    <!-- end contact section -->



    <!-- info section -->

   @include('home.footer')
</body>

</html>

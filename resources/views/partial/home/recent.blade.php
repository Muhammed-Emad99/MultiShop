<!-- Products Start -->
<div class="container-fluid pt-5 pb-3">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Recent Products</span>
    </h2>
    <div class="row px-xl-5 pb-3">
        @foreach($products as $product)
            @if($product->recent == 1)
                <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                    <div class="product-item bg-light mb-4">
                        <div class="product-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="{{asset('uploads/products/'.$product->image)}}" alt="">
                            <div class="product-action">
                                <a class="btn btn-outline-dark btn-square" href=""><i
                                        class="fa fa-shopping-cart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                            </div>
                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate" href="">{{$product->name}}</a>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <h5>${{$product->price}}</h5>
                                <h6 class="text-muted ml-2">
                                    <del>$123.00</del>
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach

    </div>
</div>
<!-- Products End -->
<x-header title="Wish List"/>

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Wish List</h4>
                        <div class="breadcrumb__links">
                            <a href="{{url('/')}}">Home</a>
                            <a href="{{url('/shop')}}">Shop</a>
                            <span>Wish List</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shopping Cart Section Begin -->
    <section class="shopping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="shopping__cart__table">
                        @if (session()->has('status'))
                            <div class="alert alert-success">
                                <span>{{session()->get('status')}}</span>
                            </div>
                        @endif
                        <table class="table table-striped table-responsive">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $total = 0;
                                @endphp

                                @foreach ($wishlists as $item) 
                                    <tr>
                                    <td class="product__cart__item">
                                        <div class="product__cart__item__pic">
                                            <img src="{{url('uploads/products/'.$item->picture)}}" width="100px" alt="">
                                        </div>
                                        <div class="product__cart__item__text">
                                            <h6>{{$item->title}}</h6>
                                            <h5>${{$item->price}}</h5>
                                        </div>
                                    </td>
                                    <td class="cart__price">${{$item->price * $item->quantity}}</td>
                                    <td>
                                        <a class="btn btn-danger" href="{{url('deleteWishlistItem/'.$item->wId)}}">Remove</a>
                                        <a class="btn btn-dark" href="{{url('productview/'.$item->id)}}">View Product</a>
                                    </td>
                                    </tr>
                                    
                                    @php
                                        $total = $total + ($item->price * $item->quantity)
                                    @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn">
                                <a href="{{url('/')}}">Continue Shopping</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shopping Cart Section End -->

<x-footer/>
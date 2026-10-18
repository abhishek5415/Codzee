<x-header title="Shopping Cart"/>

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Shopping Cart</h4>
                        <div class="breadcrumb__links">
                            <a href="{{url('/')}}">Home</a>
                            <a href="{{url('/shop')}}">Shop</a>
                            <span>Shopping Cart</span>
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
                <div class="col-lg-8">
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
                                    <th>Quantity</th>
                                    <th>Total Price</th>
                                    <th>Action</th> 
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $total = 0;
                                @endphp

                                @foreach ($cartItem as $item)
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
                                    <td class="quantity__item">
                                        <form action="{{url('updateCartItem/'.$item->id)}}" method="POST">
                                        @csrf
                                            <div class="quantity">
                                                <input type="number" class="form-control" name="quantity" min="1" max="{{$item->pQuantity}}" value="{{$item->quantity}}">
                                                <input type="submit" class="btn btn-success btn-block" value="Update">
                                            </div>
                                        </form>
                                    </td>
                                    <td class="cart__price">${{$item->price * $item->quantity}}</td>
                                    <td><a class="btn btn-danger" href="{{url('deleteCartItem/'.$item->id)}}">Remove</a></td>
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

                @if ($cartItem->count() != 0)
                  <div class="col-lg-4">
                    <div class="cart__total">
                        <h6>Cart total</h6>
                        <ul>
                            <li>Subtotal <span>$ {{$total}}</span></li>
                            <li>Total <span>$ {{$total}}</span></li>
                        </ul>
                        <form action="{{url('/checkout')}}" method="POST">
                            @csrf
                            <label>Full Name*</label>
                            <input type="text" name="fullname" class="form-control mb-2" required>
                            <label>Phone*</label>
                            <input type="tel" name="phone" class="form-control mb-2" pattern="[0-9]{10}" required>
                            <label>Address*</label>
                            <input type="text" name="address" class="form-control mb-2" required>
                            <input type="hidden" name="bill" value="{{$total}}">                
                            <input type="submit" class="primary-btn mt-2 btn-block" value="Proceed to checkout">
                        </form>
                    </div>
                  </div> 
                @endif

            </div>
        </div>
    </section>
    <!-- Shopping Cart Section End -->

<x-footer/>
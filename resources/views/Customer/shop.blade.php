<x-header title="Shop"/>

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Shop</h4>
                        <div class="breadcrumb__links">
                            <a href="{{url('/')}}">Home</a>
                            <span>Shop</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shop Section Begin -->
    <section class="shop spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    @if (session()->has('status'))
                        <div class="alert alert-success">
                            <span>{{session()->get('status')}}</span>
                        </div>
                    @endif
                    
                    <div class="shop__product__option">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <form action="" method="GET">
                                    <div class="input-group w-75">
                                        <input type="search" name="search" class="form-control w-50" placeholder="Search By Name or Price">
                                        <button type="submit" class="btn btn-primary">Search</button>
                                    </div> 
                                </form>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="shop__product__option__right">
                                    <form action="" method="GET">
                                    <p>Sort by :</p>
                                    <select name="sort">
                                        <option value="">Popularity</option>
                                        <option value="lowestFirst">Low To High</option>
                                        <option value="highestFirst">High To Low</option>
                                    </select>
                                    <button type="submit" class="btn btn-success">Apply</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($products as $product)
                            <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="{{url('uploads/products/'.$product->picture)}}">
                                    @if ($product->type == 'new-arrivals')
                                        <span class="label">New</span>
                                    @elseif($product->type == 'hot-sales')
                                        <span class="label">Sale</span>
                                    @endif
                                    <ul class="product__hover">
                                        @if (in_array($product->id, $wishlist))
                                            <li><a href="{{url('deleteWishlistItem/'.$product->id)}}"><img src="img/icon/redheart.png" height="35px" alt=""></a></li>
                                        @else
                                            <li><a href="{{url('addToWishlist/'.$product->id)}}"><img src="img/icon/heart.png" alt=""></a></li>
                                        @endif
                                        <li><a href="{{url('productview/'.$product->id)}}"><img src="img/icon/search.png" alt=""></a></li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6>{{$product->title}}</h6>
                                    <a href="{{url('productview/'.$product->id)}}" class="add-cart">+ Add To Cart</a>
                                    
                                    <div class="rating">
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                    </div>
                                    <h5>${{$product->price}}</h5>
                                </div>
                            </div>
                            </div>  
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Section End -->

<x-footer/>
<x-header title="Orders"/>

    <!-- Contact Section Begin -->
    <section class="contact spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-md-10 mx-auto">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <h2 class="text-center">My Order History</h2>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Total Bill</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Order Date</th>
                                <th>View Products</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 0;
                            @endphp
                            @foreach ($orders as $order)
                                @php
                                    $i++;
                                @endphp
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$order->bill}}</td>
                                    <td>{{$order->fullname}}</td>
                                    <td>{{$order->address}}</td>
                                    <td>{{$order->phone}}</td>
                                    <td>{{$order->status}}</td>
                                    <td>{{$order->created_at}}</td>
                                    <td>
                                        <div class="container">
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal{{$i}}">
                                              View Products
                                            </button>
                                        </div>
                                          
                                          <!-- The Modal -->
                                        <div class="modal" id="myModal{{$i}}">
                                            <div class="modal-dialog">
                                              <div class="modal-content">
                                          
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                  <h4 class="modal-title">Products</h4>
                                                  <button type="button" class="fa fa-close" data-bs-dismiss="modal"></button>
                                                </div>
                                          
                                                <!-- Modal body -->
                                                <div class="modal-body">
                                                  <table class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Product</th>
                                                            <th>Quantity</th>
                                                            <th>Price</th>
                                                            <th>Sub Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($product as $item)
                                                        @if ($order->id == $item->orderId)
                                                            <tr>
                                                                <td><img src="{{url('uploads/products/'.$item->picture)}}" width="100px">{{$item->title}}</td>
                                                                <td>{{$item->quantity}}</td>
                                                                <td>{{$item->price}}</td>
                                                                <td>{{$item->price * $item->quantity}}</td>
                                                            </tr> 
                                                        @endif
                                                        @endforeach
                                                    </tbody>
                                                  </table>
                                                </div>
                                          
                                                <!-- Modal footer -->
                                                <div class="modal-footer">
                                                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                </div>
                                          
                                              </div>
                                            </div>
                                        </div>  
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section End -->

<x-footer/>
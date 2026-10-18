<x-adminheader title="Orders"/>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                    @if (session()->has('status'))
                        <div class="alert alert-success">
                             <span>{{session()->get('status')}}</span>
                        </div>
                    @endif
                    @if (session()->has('status2'))
                        <div class="alert alert-danger">
                            <span>{{session()->get('status2')}}</span>
                        </div>
                    @endif
                  <p class="card-title mb-2">Top Products</p>
                  <div class="table-responsive">
                    <table class="table table-striped table-borderless" id="myTable">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Customer Name</th>
                          <th>Bill</th>
                          <th>Phone</th>
                          <th>Address</th>
                          <th>Order Status</th>
                          <th>Order Date</th>
                          <th>Products</th>
                          <th>Action</th>
                        </tr>  
                      </thead>
                      <tbody>
                        @php
                            $i=0;
                        @endphp
                        @foreach ($orders as $order)
                        <tr>
                            @php
                                $i++;
                            @endphp
                            <td>{{$i}}</td>
                            <td>{{$order->fullname}}</td>
                            <td class="font-weight-bold">${{$order->bill}}</td>
                            <td>{{$order->phone}}</td>
                            <td>{{$order->address}}</td>
                            <td class="font-weight-medium"><div class="badge badge-info">{{$order->status}}</div></td>
                            <td class="font-weight-medium"><div class="badge badge-success">{{$order->created_at}}</div></td>
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
                                        <button type="button" class="fa fa-close" data-bs-dismiss="modal">X</button>
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
                                              @foreach ($products as $item)
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
                            <td>
                                @if ($order->status == 'pending')
                                    <a href="{{url('admin/changeOrderStatus/Accepted/'.$order->id)}}" class="btn btn-success">Accept</a>
                                    <a href="{{url('admin/changeOrderStatus/Rejected/'.$order->id)}}" class="btn btn-danger">Reject</a>
                                @elseif($order->status == 'Accepted')
                                    <a href="{{url('admin/changeOrderStatus/Delivered/'.$order->id)}}" class="btn btn-success">Delivered</a>
                                @elseif($order->status == 'Delivered')
                                    Already Completed
                                @elseif($order->status == 'Rejected')
                                    Order Rejected
                                @endif
                            </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <!-- content-wrapper ends -->
<x-adminfooter/>
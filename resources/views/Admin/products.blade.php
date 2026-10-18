<x-adminheader title="Products"/>
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
                  <p class="card-title mb-0">Top Products</p>

                  <!-- Button to Open the Modal -->
                    <button type="button" class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#myModal">
                    Add Products
                    </button>

                    <!-- The Modal -->
                    <div class="modal" id="myModal">
                    <div class="modal-dialog">
                        <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Add Products</h4>
                            <button type="button" class="fa fa-close" data-bs-dismiss="modal">X</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <form action="{{url('admin/addProduct')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                  <label class="form-label">Title</label>
                                  <input type="text" class="form-control" placeholder="Enter Title" name="title">
                                </div>
                                <div class="form-check mb-3">
                                    <label>Description</label>
                                    <textarea class="form-control" rows="3" name="description" placeholder="Enter Description"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Picture</label>
                                    <input type="file" class="form-control" name="picture">
                                  </div>
                                <div class="mb-3">
                                  <label class="form-label">Price</label>
                                  <input type="text" class="form-control" placeholder="Enter Price" name="price">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Quantity</label>
                                    <input type="number" class="form-control" name="quantity">
                                </div>
                                <div class="mb-3 mt-3">
                                    <label>Category</label>
                                    <select name="category" class="form-control">
                                        <option>select category</option>
                                        <option value="Shoes">Shoes</option>
                                        <option value="Accessories">Accessories</option>
                                        <option value="Clothes">Clothes</option>
                                    </select>
                                </div>
                                <div class="mb-3 mt-3">
                                    <label>Type</label>
                                    <select name="type" class="form-control">
                                        <option>select type</option>
                                        <option value="best-sellers">best-sellers</option>
                                        <option value="new-arrivals">new-arrivals</option>
                                        <option value="hot-sales">hot-sales</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Add Products</button>
                              </form>
                        </div>

                        </div>
                    </div>
                    </div>
                  <div class="table-responsive">
                    <table class="table table-striped table-borderless" id="myTable">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Title</th>
                          <th>Picture</th>
                          <th>Price</th>
                          <th>Quantity</th>
                          <th>Category</th>
                          <th>Type</th>
                          <th>Update</th>
                          <th>Delete</th>
                        </tr>  
                      </thead>
                      <tbody>
                        @php
                            $i=0;
                        @endphp
                        @foreach ($products as $product)
                        <tr>
                            @php
                                $i++;
                            @endphp
                            <td>{{$i}}</td>
                            <td>{{$product->title}}</td>
                            <td><img src="{{url('uploads/products/'.$product->picture)}}"></td>
                            <td class="font-weight-bold">${{$product->price}}</td>
                            <td>{{$product->quantity}}</td>
                            <td class="font-weight-medium"><div class="badge badge-info">{{$product->category}}</div></td>
                            <td class="font-weight-medium"><div class="badge badge-success">{{$product->type}}</div></td>
                            <td>
                                <button type="button" class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#updateModal{{$i}}">
                                    Update
                                </button>
                
                                    <!-- The Modal -->
                                    <div class="modal" id="updateModal{{$i}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                
                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Update Products</h4>
                                            <button type="button" class="fa fa-close" data-bs-dismiss="modal">X</button>
                                        </div>
                
                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <form action="{{url('admin/updateProduct')}}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="mb-3">
                                                  <label class="form-label">Title</label>
                                                  <input type="text" class="form-control" placeholder="Enter Title" name="title" value="{{$product->title}}">
                                                </div>
                                                <div class="form-check mb-3">
                                                    <label>Description</label>
                                                    <textarea class="form-control" rows="3" name="description" placeholder="Enter Description">{{$product->description}}</textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Picture</label>
                                                    <input type="file" class="form-control" name="picture">
                                                  </div>
                                                <div class="mb-3">
                                                  <label class="form-label">Price</label>
                                                  <input type="text" class="form-control" placeholder="Enter Price" name="price" value="{{$product->price}}">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Quantity</label>
                                                    <input type="number" class="form-control" name="quantity" value="{{$product->quantity}}">
                                                </div>
                                                <div class="mb-3 mt-3">
                                                    <label>Category</label>
                                                    <select name="category" class="form-control">
                                                        <option value="{{$product->category}}">{{$product->category}}</option>
                                                        <option value="Shoes">Shoes</option>
                                                        <option value="Accessories">Accessories</option>
                                                        <option value="Clothes">Clothes</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3 mt-3">
                                                    <label>Type</label>
                                                    <select name="type" class="form-control">
                                                        <option value="{{$product->type}}">{{$product->type}}</option>
                                                        <option value="best-sellers">best-sellers</option>
                                                        <option value="new-arrivals">new-arrivals</option>
                                                        <option value="hot-sales">hot-sales</option>
                                                    </select>
                                                </div>
                                                <input type="hidden" value="{{$product->id}}" name="id">    {{-- sending id to controller --}}
                                                <button type="submit" class="btn btn-primary">Update Product</button>
                                              </form>
                                        </div>
                                        
                                        </div>
                                    </div>
                                    </div>
                            </td>
                            <td><a href="{{url('admin/deleteProduct/'.$product->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this product?')">Delete</a></td>
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
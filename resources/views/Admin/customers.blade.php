<x-adminheader title="Customers"/>
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
                  <p class="card-title mb-0">Our Customers</p>

                  <!-- Button to Open the Modal -->
                    <button type="button" class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#myModal">
                    Add Users
                    </button>

                    <!-- The Modal -->
                    <div class="modal" id="myModal">
                    <div class="modal-dialog">
                        <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Add User</h4>
                            <button type="button" class="fa fa-close" data-bs-dismiss="modal">X</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <form action="{{url('admin/addCustomer')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                  <label class="form-label">Full Name</label>
                                  <input type="text" class="form-control" placeholder="Enter FullName" name="fullname">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email Address</label>
                                    <input type="email" class="form-control" placeholder="Enter Email Address" name="email">
                                  </div>
                                <div class="mb-3">
                                  <label class="form-label">Password</label>
                                  <input type="password" class="form-control" placeholder="Enter Password" name="password">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Picture</label>
                                    <input type="file" class="form-control" name="picture">
                                </div>
                                <div class="mb-3 mt-3">
                                    <label>Role</label>
                                    <select name="role" class="form-control">
                                        <option></option>
                                        <option value="Admin">Admin</option>
                                        <option value="Customer">Customer</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Add Customer</button>
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
                          <th>Full Name</th>
                          <th>Picture</th>
                          <th>Email Address</th>
                          <th>Role</th>
                          <th>Registration Date</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>  
                      </thead>
                      <tbody>
                        @php
                            $i=0;
                        @endphp
                        @foreach ($customers as $customer)
                        <tr>
                            @php
                                $i++;
                            @endphp
                            <td>{{$i}}</td>
                            <td>{{$customer->fullname}}</td>
                            <td><img src="{{url('uploads/profiles/'.$customer->picture)}}"></td>
                            <td>{{$customer->email}}</td>
                            <td class="font-weight-bold">{{$customer->role}}</td>
                            <td>{{$customer->created_at}}</td>
                            <td class="font-weight-medium"><div class="badge badge-info">{{$customer->status}}</div></td>
                            <th>
                                @if ($customer->status == 'Active')
                                    <a href="{{url('admin/changeUserStatus/Block/'.$customer->id)}}" class="btn btn-danger">Block</a>
                                @else
                                    <a href="{{url('admin/changeUserStatus/Active/'.$customer->id)}}" class="btn btn-success">Un-Block</a>
                                @endif
                            </th>
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
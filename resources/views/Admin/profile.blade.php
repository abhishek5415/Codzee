<x-adminheader title="My Profile"/>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-12 col-md-6 col-lg-4 mx-auto grid-margin stretch-card">
              <div class="card">
                @if(session()->has('status'))                <!-- Getting value from session --> 
                    <div class="alert alert-success my-2">
                        <span>{{session()->get('status')}}</span>
                    </div>
                @endif
                <div class="card-body">
                  <p class="card-title mb-2">My Profile</p>
                  <img src="{{url('uploads/profiles/'.$user->picture)}}" class="mx-auto d-block mb-2 rounded-circle" width="200px" alt="User">
                  <form action="{{url('admin/updateProfile')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <input type="text" class="form-control mb-2" name="fullname" placeholder="Name" value="{{$user->fullname}}" required>
                        </div>
                        <div class="col-lg-12">
                            <input type="email" class="form-control mb-2" name="email" placeholder="Email" value="{{$user->email}}" readonly required>
                        </div>
                        <div class="col-lg-12">
                            <input type="file" class="form-control mb-2" name="file">
                        </div>
                        <div class="col-lg-12">
                            <input type="password" class="form-control mb-2" name="password" placeholder="Password">
                        </div>
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-info">Save Changes</button>
                        </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
<x-adminfooter/>
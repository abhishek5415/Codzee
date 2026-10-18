<x-adminheader title="Admin Dashboard"/>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                  @auth
                    <h3 class="font-weight-bold">Welcome {{$user->fullname}}</h3>
                  @endauth
                  <h6 class="font-weight-normal mb-0">All systems are running smoothly!</h6>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card tale-bg">
                <div class="card-people mt-auto">
                  <img src="AdminDashboard/images/dashboard/people.svg" height="317px" alt="people">
                  <div class="weather-info">
                    <div class="d-flex">
                      <div>
                        <h2 class="mb-0 font-weight-normal"><i class="icon-sun mr-2"></i>35<sup>C</sup></h2>
                      </div>
                      <div class="ml-2">
                        <h4 class="location font-weight-normal">Ahmedabad</h4>
                        <h6 class="font-weight-normal">India</h6>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 grid-margin transparent">
              <div class="row">
                <div class="col-md-6 mb-4 stretch-card transparent">
                  <div class="card card-tale">
                    <div class="card-body">
                      <h4 class="mb-4">Total Products</h4>
                      <p class="fs-30 mb-4">{{$products->count()}}</p>
                      <p>5.20% (30 days)</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 mb-4 stretch-card transparent">
                  <div class="card card-dark-blue">
                    <div class="card-body">
                      <h4 class="mb-4">Number of Customers</h4>
                      <p class="fs-30 mb-4">{{$customers->count()}}</p>
                      <p>6.055% (30 days)</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                  <div class="card card-light-blue">
                    <div class="card-body">
                      <h4 class="mb-4">Number of Orders</h4>
                      <p class="fs-30 mb-4">{{$orders->count()}}</p>
                      <p>8.00% (30 days)</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 stretch-card transparent">
                  <div class="card card-light-danger">
                    <div class="card-body">
                      <h4 class="mb-4">Trusted Since</h4>
                      <p class="fs-30 mb-4">2010</p>
                      <p>2.22% (30 days)</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
<x-adminfooter/>


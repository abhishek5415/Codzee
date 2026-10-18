<x-header title="My Profile"/>

    <!-- Contact Section Begin -->
    <section class="contact spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 mx-auto">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <h2 class="text-center">My Profile</h2>
                        </div>
                    </div>
                    <div class="contact__form">
                        @if (session()->has('status'))
                            <div class="alert alert-success">
                                <span>{{session()->get('status')}}</span>
                            </div>
                        @endif
                        <img src="{{url('uploads/profiles/'.$user->picture)}}" class="mx-auto d-block mb-3 rounded-circle" width="200px">
                        <form action="{{url('/updateProfile')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <input type="text" placeholder="Fullname" name="fullname" value="{{$user->fullname}}">
                                </div>
                                <div class="col-12">
                                    <input type="email" placeholder="Email" name="email" value="{{$user->email}}" readonly>
                                </div>
                                <div class="col-12">
                                    <input type="file" name="picture">
                                </div>
                                <div class="col-12">
                                    <input type="password" placeholder="password" name="password">
                                </div>
                                <div class="col-12">      
                                    <button type="submit" name="submit" class="site-btn">Save Changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section End -->

<x-footer/>
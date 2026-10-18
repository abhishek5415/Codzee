<x-header title="Login Page"/>

    <!-- Contact Section Begin -->
    <section class="contact spad">
        <div class="container">
            <div class="row">
                <div class="col-12 mb-3">
                    <h2 class="text-center">Login to Continue</h2>
                </div>
                <div class="col-lg-6 col-md-6 mx-auto">
                    <div class="contact__form">
                        @if (session()->has('status'))
                            <div class="alert alert-success">
                                <span>{{session()->get('status')}}</span>
                            </div>
                        @endif
                        @if (session()->has('error'))
                            <div class="alert alert-danger">
                                <span>{{session()->get('error')}}</span>
                            </div>
                        @endif
                        <form action="{{url('/login')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <input type="email" placeholder="Email*" name="email" value="{{ old('email') }}" required>
                                </div>
                                <div class="col-12">
                                    <input type="password" placeholder="password*" name="password" required>
                                </div>
                                <div class="col-12">      
                                    <button type="submit" class="site-btn">Log In</button>
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
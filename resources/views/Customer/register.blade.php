<x-header title="Registration Page"/>

    <!-- Contact Section Begin -->
    <section class="contact spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 mx-auto">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <h2 class="text-center">Register YourSelf</h2>
                        </div>
                    </div>
                    <div class="contact__form">
                        <form action="{{url('/register')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <input type="text" placeholder="Fullname*" name="fullname" required>
                                </div>
                                <div class="col-12">
                                    <input type="email" placeholder="Email*" name="email" required>
                                </div>
                                <div class="col-12">
                                    <input type="file" name="picture" required>
                                </div>
                                <div class="col-12">
                                    <input type="password" placeholder="password*" name="password" required>
                                </div>
                                <div class="col-12">      
                                    <button type="submit" name="submit" class="site-btn">Sign In</button>
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
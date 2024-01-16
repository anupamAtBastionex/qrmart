
	<style>
        .social-link {
            padding: 10px 15px;
            border: 1px solid #fff;
            border-radius: 5px;
            margin-right:10px;
        }

        .social-link i{
            font-size: 20px;
            color: #fff;
        }
        .contact-icon
        {
            font-size: 20px;
            margin-right: 1px;
        }
        /* Add this CSS to style the WhatsApp icon */
        .whatsapp-icon {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
            cursor: pointer;
        }

    </style>

    <!-- Start Footer Area -->
	<footer class="footer">
		<!-- Footer Top -->
		<div class="footer-top section">
			<div class="container">
				<div class="row">
                    <div class="col-lg-4 col-md-4 col-12">
						<!-- Single Widget -->
						<div class="single-footer social">
							<h4>Get In Tuch</h4>
							<!-- Single Widget -->
                            @php
								$data=DB::table('settings')->first();
							@endphp
                            {{-- <p class="text"> {{ $data->short_des }} </p> --}}
							<div class="contact">
								<ul>

									<li><i class="contact-icon fa fa-home"></i> {{ $data->address }}</li>
									<li><i class="contact-icon fa fa-envelope"></i> {{ $data->email }}</li>
									<li><i class="contact-icon fa fa-instagram"></i> {{ $data->email }}</li>
                                    <li><i class="contact-icon fa fa-facebook"></i> {{ $data->email }}</li>
									<li><i class="contact-icon fa fa-whatsapp"></i> {{ $data->phone }}</li>

								</ul>
							</div>
							<!-- End Single Widget -->
							<div class="sharethis-inline-follow-buttons"></div>
						</div>
						<!-- End Single Widget -->
					</div>
					<div class="col-lg-4 col-md-4 col-12">
						<!-- Single Widget -->
						<div class="single-footer links">
							<h4>Quick Links</h4>
							<ul>
								<li><a href="{{route('about-us')}}">Why Us?</a></li>
								<li><a href="{{route('contact')}}">Contact Us</a></li>
								<li><a href="#">Help</a></li>
							</ul>
						</div>
						<!-- End Single Widget -->
					</div>
					<div class="col-lg-4 col-md-4 col-12">
						<!-- Single Widget -->
						<div class="single-footer social">
							<h4>Subscribe</h4>
							<!-- Single Widget -->
							<div class="subscribe">
								<div class="row">
									<div class="col-lg-8 col-md-12 col-8">
										<input type="email" class="form-control" style="padding:8px"/>
									</div>
									<div class="col-lg-4 col-md-12 col-12">
										<input type="button" name="submit_btn" class="btn btn-primary" value="Subscribe" />
									</div>
								</div>
							</div>
							<div class="subscribe">
							<p>	Follow us on social media</p>
								<div>
									<a href="#" class="btn btn-icon btn-outline-light social-link"><i class="fa fa-facebook-f"></i></a>
									<a href="#" class="btn btn-icon btn-outline-light social-link"><i class="fa fa-twitter"></i></a>
									<a href="#" class="btn btn-icon btn-outline-light social-link"><i class="fa fa-instagram"></i></a>
									<a href="#" class="btn btn-icon btn-outline-light social-link"><i class="fa fa-youtube"></i></a>
								</div>
							</div>
							<!-- End Single Widget -->
							<div class="sharethis-inline-follow-buttons"></div>
						</div>
						<!-- End Single Widget -->
					</div>
					{{-- <div class="col-lg-5 col-md-6 col-12">
						<!-- Single Widget -->
						<div class="single-footer about">
							<div class="logo">
								<a href="index.html"><img src="{{asset('backend/img/avatar.png')}}" alt="#"></a>
							</div>

							<p class="text">{{$data->short_des}} </p>
							<p class="call">Got Question? Call us 24/7<span><a href="tel:123456789">{{$data->phone}}</a></span></p>
						</div>
						<!-- End Single Widget -->
					</div> --}}
					{{-- <div class="col-lg-2 col-md-6 col-12">
						<!-- Single Widget -->
						<div class="single-footer links">
							<h4>Quick Links</h4>
							<ul>
								<li><a href="{{route('about-us')}}">About Us</a></li>
								<li><a href="#">Faq</a></li>
								<li><a href="#">Terms & Conditions</a></li>
								<li><a href="{{route('contact')}}">Contact Us</a></li>
								<li><a href="#">Help</a></li>
							</ul>
						</div>
						<!-- End Single Widget -->
					</div> --}}
					{{-- <div class="col-lg-2 col-md-6 col-12">
						<!-- Single Widget -->
						<div class="single-footer links">
							<h4>Customer Service</h4>
							<ul>
								<li><a href="#">Payment Methods</a></li>
								<li><a href="#">Money-back</a></li>
								<li><a href="#">Returns</a></li>
								<li><a href="#">Shipping</a></li>
								<li><a href="#">Privacy Policy</a></li>
							</ul>
						</div>
						<!-- End Single Widget -->
					</div> --}}
					{{-- <div class="col-lg-4 col-md-6 col-12">
						<!-- Single Widget -->
						<div class="single-footer social">
							<h4>Subscribe</h4>
							<!-- Single Widget -->
							<div class="contact">
								<ul>
									<li>{{$data->address}}</li>
									<li>{{$data->email}} </li>
									<li>{{$data->phone}} </li>
								</ul>
							</div>
							<!-- End Single Widget -->
							<div class="sharethis-inline-follow-buttons"></div>
						</div>
						<!-- End Single Widget -->
					</div> --}}
				</div>
			</div>
		</div>
		<!-- End Footer Top -->
		<div class="copyright">
			<div class="container">
				<div class="inner">
					<div class="row">
						<div class="col-lg-6 col-12">
							<div class="left">
								<p>© {{date('Y')}} Developed By <a href="https://bastionex.net/" target="_blank" style="text-decoration:none;">BastionEx</a> -  All Rights Reserved.</p>
							</div>
						</div>
						<div class="col-lg-6 col-12">
							<div class="right">
								<img src="{{asset('backend/img/payments.png')}}" alt="#">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<!-- /End Footer Area -->
<!-- Add this code where you want to display the WhatsApp icon -->
<a target="_blank" href="https://api.whatsapp.com/send?phone=971525891213&amp;text=" style="bottom: 20px; right: 15px; position: fixed; z-index: 99999999;"><img src="https://reliancezone.ae/uploads/lib/wtsapp.png" alt="WhatsApp chat" style="height: 65px;"></a>

	<!-- Jquery -->
    <script src="{{asset('frontend/js/jquery.min.js')}}"></script>
    <script src="{{asset('frontend/js/jquery-migrate-3.0.0.js')}}"></script>
	<script src="{{asset('frontend/js/jquery-ui.min.js')}}"></script>
	<!-- Popper JS -->
	<script src="{{asset('frontend/js/popper.min.js')}}"></script>
	<!-- Bootstrap JS -->
	<script src="{{asset('frontend/js/bootstrap.min.js')}}"></script>
	<!-- Color JS -->
	<script src="{{asset('frontend/js/colors.js')}}"></script>
	<!-- Slicknav JS -->
	<script src="{{asset('frontend/js/slicknav.min.js')}}"></script>
	<!-- Owl Carousel JS -->
	<script src="{{asset('frontend/js/owl-carousel.js')}}"></script>
	<!-- Magnific Popup JS -->
	<script src="{{asset('frontend/js/magnific-popup.js')}}"></script>
	<!-- Waypoints JS -->
	<script src="{{asset('frontend/js/waypoints.min.js')}}"></script>
	<!-- Countdown JS -->
	<script src="{{asset('frontend/js/finalcountdown.min.js')}}"></script>
	<!-- Nice Select JS -->
	<script src="{{asset('frontend/js/nicesellect.js')}}"></script>
	<!-- Flex Slider JS -->
	<script src="{{asset('frontend/js/flex-slider.js')}}"></script>
	<!-- ScrollUp JS -->
	<script src="{{asset('frontend/js/scrollup.js')}}"></script>
	<!-- Onepage Nav JS -->
	<script src="{{asset('frontend/js/onepage-nav.min.js')}}"></script>
	{{-- Isotope --}}
	<script src="{{asset('frontend/js/isotope/isotope.pkgd.min.js')}}"></script>
	<!-- Easing JS -->
	<script src="{{asset('frontend/js/easing.js')}}"></script>

	<!-- Active JS -->
	<script src="{{asset('frontend/js/active.js')}}"></script>


	@stack('scripts')
	<script>
		setTimeout(function(){
		  $('.alert').slideUp();
		},5000);
		$(function() {
		// ------------------------------------------------------- //
		// Multi Level dropdowns
		// ------------------------------------------------------ //
			$("ul.dropdown-menu [data-toggle='dropdown']").on("click", function(event) {
				event.preventDefault();
				event.stopPropagation();

				$(this).siblings().toggleClass("show");


				if (!$(this).next().hasClass('show')) {
				$(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
				}
				$(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
				$('.dropdown-submenu .show').removeClass("show");
				});

			});
		});
	  </script>

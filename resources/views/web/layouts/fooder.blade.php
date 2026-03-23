	@php
		$setting = App\Models\Setting::first();
	@endphp
	<footer id="footer">
			<!-- top footer -->
			<div class="section">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">{{ __('About Us') }}</h3>
								<p>{{ __('Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut.') }}</p>
								<ul class="footer-links">
									<li><a href="#"><i class="fa fa-map-marker"></i> {{ $setting->address[app()->getLocale()] }}</a></li>
									<li><a href="#"><i class="fa fa-phone"></i>{{ $setting->phone }}</a></li>
									<li><a href="#"><i class="fa fa-envelope-o"></i>email@email.com</a></li>
								</ul>
							</div>
						</div>

						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">{{ __('Categories') }}</h3>
								<ul class="footer-links">
									<li><a href="#">{{ __('Hot deals') }}</a></li>
									<li><a href="#">{{ __('Laptops') }}</a></li>
									<li><a href="#">{{ __('Smartphones') }}</a></li>
									<li><a href="#">{{ __('Cameras') }}</a></li>
									<li><a href="#">{{ __('Accessories') }}</a></li>
								</ul>
							</div>
						</div>

						<div class="clearfix visible-xs"></div>

						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">{{ __('Information') }}</h3>
								<ul class="footer-links">
									<li><a href="#">{{ __('About Us') }}</a></li>
									<li><a href="#">{{ __('Contact Us') }}</a></li>
									<li><a href="#">{{ __('Privacy Policy') }}</a></li>
									<li><a href="#">{{ __('Orders and Returns') }}</a></li>
									<li><a href="#">{{ __('Terms & Conditions') }}</a></li>
								</ul>
							</div>
						</div>

						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">{{ __('Service') }}</h3>
								<ul class="footer-links">
									<li><a href="#">{{ __('My Account') }}</a></li>
									<li><a href="{{ route('carts.index') }}">{{ __('View Cart') }}</a></li>
									<li><a href="#">{{ __('Wishlist') }}</a></li>
									<li><a href="#">{{ __('Track My Order') }}</a></li>
									<li><a href="#">{{ __('Help') }}</a></li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /row -->
				</div>
				<!-- /container -->
			</div>
			<!-- /top footer -->

			<!-- bottom footer -->
			<div id="bottom-footer" class="section">
				<div class="container">
					<!-- row -->
					<div class="row">
						<div class="col-md-12 text-center">
							<ul class="footer-payments">
								<li><a href="#"><i class="fa fa-cc-visa"></i></a></li>
								<li><a href="#"><i class="fa fa-credit-card"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-paypal"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-mastercard"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-discover"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-amex"></i></a></li>
							</ul>
							<span class="copyright">
								<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
								{{ __('Copyright') }} &copy;<script>document.write(new Date().getFullYear());</script> {{ __('All rights reserved') }} | {{ __('This template is made with') }} <i class="fa fa-heart-o" aria-hidden="true"></i> {{ __('by') }} <a href="https://colorlib.com" target="_blank">Colorlib</a>
							<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
							</span>
						</div>
					</div>
						<!-- /row -->
				</div>
				<!-- /container -->
			</div>
			<!-- /bottom footer -->
		</footer>

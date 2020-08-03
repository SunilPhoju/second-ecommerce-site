<?php 
require('top.php');
?>       
		<div class="ht__bradcaump__area">
            <div class="ht__bradcaump__wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="bradcaump__inner">
                                <nav class="bradcaump-inner">
                                  <a class="breadcrumb-item" href="index.php">Home</a>
                                  <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                                  <span class="breadcrumb-item active">Login/Register</span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		</div> 
        <!-- End Bradcaump area -->
        <!-- Start Contact Area -->
        <section class="htc__contact__area ptb--100 bg__white">
            <div class="container">
                <div class="row">
					<div class="col-md-6">
						<div class="contact-form-wrap mt--60">
							<div class="col-xs-12">
								<div class="contact-title">
									<h2 class="title__line--6">Login</h2>
								</div>
							</div>
							<div class="col-xs-12">
								<form id="loginForm" method="post">
									<div class="single-contact-form">
										<div class="contact-box name">
											<input type="text" name="loginEmail" id="loginEmail" placeholder="Your Email*" style="width:100%">
										</div>
										<span class="fieldError" id="loginEmailError" style="color:red;"></span>
									</div>
									<div class="single-contact-form">
										<div class="contact-box name">
											<input type="password" name="loginPassword" id="loginPassword" placeholder="Your Password*" style="width:100%">
										</div>
										<span class="fieldError" id="loginPasswordError" style="color:red;"></span>
									</div>
									
									<div class="contact-btn">
										<button type="button" class="fv-btn" onclick="userLogin()">Login</button>
									</div>
								</form>
								<div class="form-output loginMessage">
									<p class="form-messege fieldError" style="color:red;"></p>
								</div>
							</div>
						</div> 
                
				</div>
					<div class="col-md-6">
						<div class="contact-form-wrap mt--60">
							<div class="col-xs-12">
								<div class="contact-title">
									<h2 class="title__line--6">Register</h2>
								</div>
							</div>
							<div class="col-xs-12">
								<form id="registerForm" method="post">
									<div class="single-contact-form">
										<div class="contact-box name">
											<input type="text" name="name" id="name" placeholder="Your Name*" style="width:100%">
										</div>
										<span class="fieldError" id="nameError" style="color:red;"></span>
									</div>
									<div class="single-contact-form">
										<div class="contact-box name">
											<input type="text" name="email" id="email" placeholder="Your Email*" style="width:100%">
										</div>
										<span class="fieldError" id="emailError" style="color:red;"></span>
									</div>
									<div class="single-contact-form">
										<div class="contact-box name">
											<input type="text" name="mobile" id="mobile" placeholder="Your Mobile*" style="width:100%">
										</div>
										<span class="fieldError" id="mobileError" style="color:red;"></span>
									</div>
									<div class="single-contact-form">
										<div class="contact-box name">
											<input type="password" name="password" id="password" placeholder="Your Password*" style="width:100%">
										</div>
										<span class="fieldError" id="passwordError" style="color:red;"></span>
									</div>
									
									<div class="contact-btn">
										<button type="button" onclick="userRegister()" class="fv-btn">Register</button>
									</div>
								</form>
								<div class="form-output registerMessage">
									<p class="form-messege fieldError"></p>
								</div>
							</div>
						</div> 
                
				</div>
					
            </div>
        </section>
<?php require('footer.php')?>           
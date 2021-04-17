<?php 
/* Template Name: Login 
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Electoreftech
 */

get_header();

$banner_img = get_template_directory_uri(). '/img/page_banner.jpg';
$electroref_page_banner = get_post_meta(get_the_ID(), 'electroref_page_banner', true);

if(isset($electroref_page_banner) && !empty($electroref_page_banner)){
	$banner_img = $electroref_page_banner;
}
 ?>
 
 <?php 
 while ( have_posts() ) :
	the_post();
 ?>
<section id="breadcrumb-nf">
	<div class="container">
	<h1><?php echo get_the_title(); ?></h1>
		<?php
			if ( function_exists( 'electoreftech_breadcrumbs' ) ) {
				electoreftech_breadcrumbs();
			}
			?>
	</div>
</section>
<?php endwhile; // End of the loop. ?>    
    <div id="my-account">
            <div class="container">
                <div class="row loginright">
                    <div class="ortext-middle">OR</div>
                    <div class="col-md-12 col-lg-6 lr-1">
                        <div class="login-register-box">
                            <div class="lr-title">
                                <h4>Login<span></span></h4>
                            </div>
                            <p>Welcome back! Sign in to your account. </p>
                            <div class="form-box">
                                <form>
                                    <div class="form-group">
                                        <label for="">Username or email address<span>*</span></label>
                                        <input type="text" name="femail" class="form-control" placeholder="" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Password<span>*</span></label>
                                        <input type="password" name="femail" class="form-control" placeholder="" required>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                            <label class="form-check-label" for="exampleCheck1">Remember me</label>
                                        </div>
                                    </div>
                                    <div class="form-group login-reg-button">
                                        <button type="submit" class="eccomerce-button" name="login" value="Log in">Log in</button>
                                    </div>
                                    <p class="lost_password">
                                        <a href="#" data-toggle="modal" data-target="#forgotpasswordModal">Forgot Password?</a>
                                    </p>
                                    <div class="facebooklogin">
                                    	<a href="#"><i class="fa fa-facebook" aria-hidden="true"></i>Facebook Login</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Forgot Password -->
                    <div class="modal fade" id="forgotpasswordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-sm" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true"><img src="assets/images/video-close.png" class="close icons"></span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="forgot-password-box">
                                        <div class="passrest-info">
                                            <a href="#"><img src="assets/images/fclogo-v1.png" class="img-fluid" alt="Filili Connect Logo"></a>
                                            <div class="reset-info">
                                                <h3>Forgot Password?</h3>
                                                <p>Don't worry! Enter you email below and we'll email you with instruction on how to reset your password.</p>
                                            </div>
                                        </div>
                                        <div class="reset-form">
                                            <form action="/" method="get">
                                                <label for="">Email Address</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="forgot-password" placeholder="Enter Email Address">
                                                </div>
                                                <div class="form-group login-reg-button">
                                                    <button type="submit" class="eccomerce-button" name="reset-password" value="Reset Password">Reset Password</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6 lr-2">
                        <div class="login-register-box">
                            <div class="lr-title">
                                <h4>Register<span></span></h4>
                            </div>
                            <p>Create new account today to reap the benefits of a personalized shopping experience.</p>
                            <div class="form-box">
                                <form>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Full name<span>*</span></label>
                                                <input type="text" name="fname" class="form-control" placeholder="" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Email address<span>*</span></label>
                                                <input type="text" name="email" class="form-control" placeholder="" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Password<span>*</span></label>
                                                <input type="password" name="password" class="form-control" placeholder="" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Confirm Password<span>*</span></label>
                                                <input type="password" name="cpassword" class="form-control" placeholder="" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group privacy-policy">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                            <label class="form-check-label" for="exampleCheck1"><a href="#">Terms & Conditions</a></label>
                                        </div>
                                    </div>
                                    <div class="form-group login-reg-button">
                                        <button type="submit" class="eccomerce-button" name="login" value="Register">Register</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php 

get_footer();

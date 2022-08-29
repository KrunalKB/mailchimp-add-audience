<?php
/**
 * Template Name: Mailchimp
 */
get_header();
?>

<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="wrapper img"
                    style="background-image: url(<?php echo get_stylesheet_directory_uri().'/images/img.jpg'; ?>);">
                    <div class="row">
                        <div class="col-md-9 col-lg-7">
                            <div class="contact-wrap w-100 p-md-5 p-4">
                                <h3 class="mb-4"><?php _e('Get in touch with us'); ?></h3>
                                <div id="form-message-warning" class="mb-4"></div>
                                <div id="form-message-success" class="mb-4">
                                    Your message was sent, thank you!
                                </div>
                                <form method="POST" id="contactForm" name="contactForm" class="contactForm">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="label" for="fname"><?php _e('First Name'); ?></label>
                                                <input type="text" class="form-control" name="fname" id="fname"
                                                    placeholder="First Name">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="label" for="lname"><?php _e('Last Name'); ?></label>
                                                <input type="text" class="form-control" name="lname" id="lname"
                                                    placeholder="Last Name">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="label" for="email"><?php _e('Email Address'); ?></label>
                                                <input type="email" class="form-control" name="email" id="email"
                                                    placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="label" for="number"><?php _e('Phone number'); ?></label>
                                                <input type="text" class="form-control" name="number" id="number"
                                                    placeholder="Phone number">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="label" for=message#"><?php _e('Message')?></label>
                                                <textarea name="message" class="form-control" id="message" cols="30"
                                                    rows="4" placeholder="Message"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <button class="btn btn-primary"><?php _e('Send Message'); ?></button>
                                                <img src="<?php echo get_stylesheet_directory_uri().'/images/load.gif' ?>"
                                                    class="loader" alt="Loader" height=25 width=25
                                                    style="margin-left:10px;margin-bottom:15px">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php 
get_footer();
?>
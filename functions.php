<?php
/* Enqueue required files */
add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );

function enqueue_parent_styles(){
    wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );

    if(is_page('mailchimp')){
        wp_enqueue_style( 'main-css', get_stylesheet_directory_uri(). '/css/style.css', array(), '1.0.0' );
        wp_enqueue_style( 'bootstrap-cdn', "https://cdn.usebootstrap.com/bootstrap/4.3.1/css/bootstrap.min.css", '1.0.0' );
        wp_enqueue_script( 'jquery-main', get_stylesheet_directory_uri() .'/js/jquery.min.js',array(),'1.0.0', true );
        wp_enqueue_script( 'jquery-validate', get_stylesheet_directory_uri() .'/js/jquery.validate.min.js',array(),'1.0.0', true );
        wp_enqueue_script( 'main-js', get_stylesheet_directory_uri() .'/js/main.js',array(),'1.0.0', true );
        wp_localize_script(
            'main-js',
            'myLink',
            array(
                'ajax_link' => admin_url('admin-ajax.php'),
                'nonce'     => wp_create_nonce('user-registration-nonce')
            )
        );
    }
}

/* Ajax callback for getting user data and integrate mailchimp API. */
add_action('wp_ajax_user_hook','get_user_data');
add_action('wp_ajax_nopriv_user_hook','get_user_data');

function get_user_data(){
    if (isset($_POST['nonce']) && wp_verify_nonce($_POST['nonce'], 'user-registration-nonce')) {
        $fname   = $_POST['fname'];
        $lname   = $_POST['lname'];
        $email   = $_POST['email'];
        $number  = $_POST['number'];
        $message = $_POST['message'];

        // API credentials
        $list_id   = "48851390ca";
        $authtoken = "e325576866dfee97b6b1fca810550a31-us18";

        // The data to send to the API
        $userData = array(
            "email_address" => $email,
            "status"        => "subscribed",
            "merge_fields"  => array(
                "FNAME"   => $fname,
                "LNAME"   => $lname,
                "MESSAGE" => $message,
                "PHONE"   => $number
            )
        );
        $mch_api = curl_init(); // initialize cURL connection

        curl_setopt($mch_api, CURLOPT_URL, 'https://' . substr($authtoken,strpos($authtoken,'-')+1) . '.api.mailchimp.com/3.0/lists/' . $list_id . '/members/' . md5(strtolower($email)));
        curl_setopt($mch_api, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization: Basic '.base64_encode( 'user:'.$authtoken )));
        curl_setopt($mch_api, CURLOPT_USERAGENT, 'PHP-MCAPI/2.0');
        curl_setopt($mch_api, CURLOPT_RETURNTRANSFER, true); // return the API response
        curl_setopt($mch_api, CURLOPT_CUSTOMREQUEST, 'PUT'); // method PUT
        curl_setopt($mch_api, CURLOPT_TIMEOUT, 10);
        curl_setopt($mch_api, CURLOPT_POST, true);
        curl_setopt($mch_api, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($mch_api, CURLOPT_POSTFIELDS, json_encode($userData) ); // send data in json

        $result = curl_exec($mch_api);
    
    }
}
?>
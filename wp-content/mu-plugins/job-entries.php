<?php
/*
Plugin Name:  Job Entries
Description:  To view job applications.
Author:       Rahul S
Version:      1.0
License:      GPL v2 or later
License URI:  https://www.gnu.org/licenses/gpl-2.0.txt
*/



// disable direct file access
if ( ! defined( 'ABSPATH' ) ) {

	exit;

}


// display the plugin settings page
function myplugin_display_settings_page() {
	global $wpdb;
	// check if user is allowed access
	if ( ! current_user_can( 'manage_options' ) ) return;
	
	?>
	
    <html lang="en">
<!--    <head>-->
<!--        <!-- Required meta tags -->
<!--        <meta charset="utf-8">-->
<!--        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">-->
<!---->
<!--        <!-- Bootstrap CSS -->
<!--        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">-->
<!---->
<!--    </head>-->
    <body class="wp-admin wp-core-ui js theme-ultrapress acf-admin-5-3 acf-browser-chrome wc-wp-version-gte-53 wc-wp-version-gte-55 edit-php auto-fold admin-bar post-type-job_opening branch-5-5 version-5-5 admin-color-fresh locale-en-us customize-support svg">
    <div id="wpbody" role="main">
        <div id="wpbody-content">
            <div class="wrap">
            <h1>Applicants </h1>
            </br>
            <?php
            $basedir = wp_get_upload_dir();
            ?>
            <table class="widefat fixed" cellspacing="0">
                <thead>
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Contact</th>
                    <th scope="col">Job</th>
                    <th scope="col">Resumes</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $applications = $wpdb->get_results("SELECT * FROM wp_job_entries");
                foreach($applications as $application)
                {
                ?>
                    <tr class="alternate">
                        <th scope="row"><?php echo $application->id; ?></th>
                        <th scope="row"><?php echo $application->applicant_name; ?></th>
                        <td><?php echo $application->email; ?></td>
                        <td><?php echo $application->contact; ?></td>
                        <td><?php echo $application->job; ?></td>
                        <td>

                            <a href="<?php echo $basedir['baseurl'].$application->resume; ?>" target="_blank" download><span class="dashicons dashicons-media-default"></span></a>

                <?php
                }?>
                </tbody>
            </table>



                <!-- Optional JavaScript -->
                <!-- jQuery first, then Popper.js, then Bootstrap JS -->
                <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
                <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
            </div>
        </div>
    </div>
    </body>
    </html>
        
	<?php
	
}


// add top-level administrative menu
function job_entries_addMenu() {
	
	/* 
		add_menu_page(
			string   $page_title, 
			string   $menu_title, 
			string   $capability, 
			string   $menu_slug, 
			callable $function = '', 
			string   $icon_url = '', 
			int      $position = null 
		)
	*/
	
//	add_menu_page(
//		'Job Applications',
//		'Job Entries',
//		'manage_options',
//		'job-entries',
//		'myplugin_display_settings_page',
//		'dashicons-admin-generic',
//		null
//	);


    add_submenu_page(
        'edit.php?post_type=job_opening',
        'Applicants',
        'Job Entries',
        'manage_options',
        'job-entries',
        'myplugin_display_settings_page'
    );
}
add_action( 'admin_menu', 'job_entries_addMenu' );
?>
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



            </div>
        </div>
    </div>
    </body>
    </html>

    <?php

}


// add top-level administrative menu
function job_entries_addMenu() {

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
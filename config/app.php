<?php
include_once 'database.php';

$settings = $mysqli->query('select * from settings where id = 1')->fetch_assoc();
if(count($settings)){
    $app_name = $settings['app_name'];
    $admin_email = $settings['Admn_email'];

}else {
    $app_name = 'Service app';
    $app_name = 'Admin@email.com';
}
$config = [
    'app_name' => $app_name,
    'admin_email' => $admin_email,
    'lang' => 'en',
    'dir' => 'ltr',
    'app_url' => ' http://localhost:1234/phpcourses',
    'upload_dir' => 'uploads',
    'admin_assets' => '/phpcourses/Admin/template/assets'
];
<?php
/**
 * Template Name: Šefų klubas
 **/
// require WP_CONTENT_DIR . '/plugins/wp-all-import-pro/models/import/list.php';
require WP_CONTENT_DIR . '/plugins/wp-all-import-pro/wp-all-import-pro.php';

$list = new PMXI_Import_List();
$templates = new PMXI_Template_List();
$importtable_name = $list->getTable();
$templatettable_name = $templates->getTable();
$cron_job_key = PMXI_Plugin::getInstance()->getOption('cron_job_key');

$host = 'gardugardu.lt';
$password = 'BcnHHDTK56UEFHTY';
$username = 'atidavimas@gardugardu.lt';

try {
    $con = checkFtp($host, $username, $password);
} catch (Exception $e) {
    $result = $e->getMessage();
}

$file_list = ftp_nlist($con, "/export/");

$date = date('Ymd');
$filetyps = array('Products' => 'item', 'Prices' => 'item', 'ItemsBalance' => 'item', 'Invoice' => '', 'Stock_Purchase' => 'item');
$templates = array('Products' => 'Products v2', 'Prices' => 'Prices v2', 'ItemsBalance' => 'Items v2', 'Invoice' => 'Invoice', 'Stock_Purchase' => 'Stocks v2');
$upload_dir = wp_upload_dir();
foreach ($file_list as $k => $file) {

    if ($file != '/export/.' && $file != '/export/..') {
        // echo $file . '<br>';

        if (strpos($file, $date) !== false) {

            $type = '';

            foreach ($filetyps as $key => $tag) {
                if (strpos($file, $key) !== false) {$type = $key;
                }
            }

            if ($type && $templates[$type]) {

                $results = $wpdb->get_results("SELECT * FROM $templatettable_name where name='" . $templates[$type] . "'");

                echo $results;
                if (!empty($results)) {
                    echo $options;
                    $options = $results[0]->options;

                    $local_file = $upload_dir['basedir'] . '/wpallimport/files/' . basename($file);
                    if (ftp_get($con, $local_file, $file, FTP_BINARY)) {

                        //echo "Successfully written to $local_file\n";

                        $doc = new DOMDocument();
                        $doc->load($local_file, LIBXML_PARSEHUGE);
                        $xp = new DOMXPath($doc);
                        $count = $xp->evaluate('count(//' . $filetyps[$type] . ')');

                        $wpdb->insert($importtable_name, array(
                            'name' => basename($file),
                            'path' => '/wpallimport/files/' . basename($file),
                            'type' => 'file',
                            'xpath' => '/' . $filetyps[$type],
                            'options' => $options,
                            'root_element' => $filetyps[$type],
                            'count' => $count,
                            'registered_on' => date('Y-m-d H:i:s'),
                        ));

                        $lastid = $wpdb->insert_id;
                        $trigerurl = get_site_url() . "/wp-load.php?import_key=" . $cron_job_key . "&import_id=" . $lastid . "&action=trigger";
                        $lines = file($trigerurl);
                        print_r($lines);
                        /*$ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, $trigerurl);
                        curl_setopt($ch, CURLOPT_HEADER, 0);
                        $output=curl_exec($ch);
                        print_r($output);
                        curl_close($ch);*/
                        echo "<br>" . $trigerurl;

                    } else {

                        echo "<br>Download Failed " . $file;

                    }

                }
            }
        }
    }
}
?>



<!-- Content -->
<section class="pt-80 light-background">
    <div class="row max-width align-items-center">
        <div class="col col-12">
            <?php echo '<h1 class="mb-4">' . $page_title . '</h1>'; ?>
        </div>
        <div class="col col-12 position-relative">
            <div class="chef-background d-flex justify-content-center align-items-center"
                style="background:url(<?php echo wp_get_attachment_image_url(94); ?>);background-position: 50% 50%">
                <img class="position-absolute chef-logo" src="<?php echo wp_get_attachment_image_url(112); ?>" alt="">
            </div>
        </div>
    </div>
</section>

<section class="py-40 light-background">
    <div class="row max-width align-items-center">
        <div class="col col-12">
            <?php the_content();?>
        </div>
    </div>
    <div class="row max-width">
        <div class="col col-12">
            <?php echo do_shortcode('[contact-form-7 id="117" title="Šefų klubas"]') ?>
        </div>
    </div>
</section>

<?php
get_footer();
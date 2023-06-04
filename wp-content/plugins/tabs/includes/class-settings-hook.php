<?php
if ( ! defined('ABSPATH')) exit;  // if direct access

add_action('tabs_settings_content_general', 'tabs_settings_content_general');

function tabs_settings_content_general(){
    $settings_tabs_field = new settings_tabs_field();

    $tabs_settings = get_option('tabs_settings');

    $font_aw_version = isset($tabs_settings['font_aw_version']) ? $tabs_settings['font_aw_version'] : 'none';
    $tabs_preview = isset($tabs_settings['tabs_preview']) ? $tabs_settings['tabs_preview'] : 'yes';

    //echo '<pre>'.var_export($tabs_settings, true).'</pre>';

    ?>
    <div class="section">
        <div class="section-title"><?php echo __('General', 'tabs'); ?></div>
        <p class="description section-description"><?php echo __('Choose some general options.', 'tabs'); ?></p>

        <?php



        $args = array(
            'id'		=> 'font_aw_version',
            'parent'		=> 'tabs_settings',
            'title'		=> __('Font-awesome version','tabs'),
            'details'	=> __('Choose font awesome version you want to load.','tabs'),
            'type'		=> 'select',
            'value'		=> $font_aw_version,
            'default'		=> 'v_5',
            'args'		=> array('v_5'=>__('Version 5+','tabs'), 'v_4'=>__('Version 4+','tabs'), 'none'=>__('None','tabs')  ),
        );

        $settings_tabs_field->generate_field($args);

        $args = array(
            'id'		=> 'tabs_preview',
            'parent'		=> 'tabs_settings',
            'title'		=> __('Enable tabs preview','tabs'),
            'details'	=> __('You can enable preview tabs.','tabs'),
            'type'		=> 'select',
            'value'		=> $tabs_preview,
            'default'		=> 'yes',
            'args'		=> array('yes'=>__('Yes','tabs'), 'no'=>__('No','tabs')  ),
        );

        $settings_tabs_field->generate_field($args);






        ob_start();




        $meta_fields = array(
            'tabs_options',
        );


        $wp_query = new WP_Query( array (
            'post_type' => 'tabs',
            'post_status' => 'any',
            'posts_per_page' => -1,
        ));

        $post_data_exported = array();

        if ( $wp_query->have_posts() ) :
            while ( $wp_query->have_posts() ) : $wp_query->the_post();
                foreach($meta_fields as $field){
                    $fields_data[$field] = get_post_meta(get_the_ID(),$field, true);
                }

                $post_data_exported[get_the_ID()] = array(
                    'title'=>get_the_title(),
                    'meta_fields'=>$fields_data,
                );


            endwhile;
            wp_reset_query();
        else:

            // echo __('Not  found');

        endif;

        $post_data_exported_json = json_encode($post_data_exported);


        ?>

        <textarea id="text-val" rows="4"><?php echo esc_textarea($post_data_exported_json); ?></textarea><br/>
        <input type="button" class="button" id="dwn-btn" value="Download json"/>

        <style type="text/css">
            #text-val{
                width: 260px;
            }
        </style>

        <script>
            function download(filename, text) {
                var element = document.createElement('a');
                element.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(text));
                element.setAttribute('download', filename);

                element.style.display = 'none';
                document.body.appendChild(element);

                element.click();

                document.body.removeChild(element);
            }

            // Start file download.
            document.getElementById("dwn-btn").addEventListener("click", function(){
                // Generate download of hello.txt file with some content
                var text = document.getElementById("text-val").value;
                var filename = "<?php echo date('Y-m-d-h').'-'.time(); ?>.txt";

                download(filename, text);
            }, false);
        </script>


        <?php
        $html = ob_get_clean();
        $args = array(
            'id'		=> 'accordion_export',
            'title'		=> __('Export','tabs'),
            'details'	=> 'Please download this json first and upload somewhere, you can import by using the url of json file.',
            'type'		=> 'custom_html',
            'html'		=> $html,
        );
        $settings_tabs_field->generate_field($args);




        ob_start();


        ?>

        <input placeholder="json file url" type="text" class="json_file" name="json_file" value="">
        <div class="tabs-import-json button"><?php echo __('Import', 'tabs'); ?></div>
        <?php
        $html = ob_get_clean();
        $args = array(
            'id'		=> 'accordion_import',
            'title'		=> __('Import','tabs'),
            'details'	=> 'Please put the url of json file where you uploaded the file.',
            'type'		=> 'custom_html',
            'html'		=> $html,
        );
        $settings_tabs_field->generate_field($args);






        ?>

    </div>

    <?php





}


add_action('tabs_settings_content_help_support', 'tabs_settings_content_help_support');

if(!function_exists('tabs_settings_content_help_support')) {
    function tabs_settings_content_help_support($tab){

        $settings_tabs_field = new settings_tabs_field();

        ?>
        <div class="section">
            <div class="section-title"><?php echo __('Get support', 'tabs'); ?></div>
            <p class="description section-description"><?php echo __('Use following to get help and support from our expert team.', 'tabs'); ?></p>

            <?php


            ob_start();
            ?>

            <p><?php echo __('Ask question for free on our forum and get quick reply from our expert team members.', 'tabs'); ?></p>
            <a class="button" href="https://www.pickplugins.com/create-support-ticket/"><?php echo __('Create support ticket', 'tabs'); ?></a>

            <p><?php echo __('Read our documentation before asking your question.', 'tabs'); ?></p>
            <a class="button" href="https://www.pickplugins.com/documentation/tabs/"><?php echo __('Documentation', 'tabs'); ?></a>

            <p><?php echo __('Watch video tutorials.', 'tabs'); ?></p>
            <a class="button" href="https://www.youtube.com/playlist?list=PL0QP7T2SN94b-aTE0u3sm_7ay3P7-dIs7"><i class="fab fa-youtube"></i> <?php echo __('All tutorials', 'tabs'); ?></a>

            <ul>
<!--                <li><i class="far fa-dot-circle"></i> <a href="https://www.youtube.com/watch?v=4ZGMA6hOoxs">Tabs - data migration</a></li>-->


            </ul>



            <?php

            $html = ob_get_clean();

            $args = array(
                'id'		=> 'get_support',
                //'parent'		=> '',
                'title'		=> __('Ask question','tabs'),
                'details'	=> '',
                'type'		=> 'custom_html',
                'html'		=> $html,

            );

            $settings_tabs_field->generate_field($args);


            ob_start();
            ?>

            <p class="">We wish your 2 minutes to write your feedback about the <b>Tabs</b> plugin. give us <span style="color: #ffae19"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></span></p>

            <a target="_blank" href="https://wordpress.org/support/plugin/tabs/reviews/" class="button"><i class="fab fa-wordpress"></i> Write a review</a>


            <?php

            $html = ob_get_clean();

            $args = array(
                'id'		=> 'reviews',
                //'parent'		=> '',
                'title'		=> __('Submit reviews','tabs'),
                'details'	=> '',
                'type'		=> 'custom_html',
                'html'		=> $html,

            );

            $settings_tabs_field->generate_field($args);


            ob_start();
            $tabs_plugin_info = get_option('tabs_plugin_info');

            //delete_option('tabs_plugin_info');
            //var_dump($tabs_plugin_info);

            $migration_reset_stats = isset($tabs_plugin_info['migration_reset']) ? $tabs_plugin_info['migration_reset'] : '';


            $actionurl = admin_url().'edit.php?post_type=tabs&page=settings&tab=help_support';
            $actionurl = wp_nonce_url( $actionurl,  'tabs_reset_migration' );

            $nonce = isset($_REQUEST['_wpnonce']) ? sanitize_text_field($_REQUEST['_wpnonce']) : '';

            if ( wp_verify_nonce( $nonce, 'tabs_reset_migration' )  ){

                $tabs_plugin_info['migration_reset'] = 'processing';
                update_option('tabs_plugin_info', $tabs_plugin_info);

                wp_schedule_event(time(), '1minute', 'tabs_cron_reset_migrate');


                $migration_reset_stats = 'processing';
            }

            if($migration_reset_stats == 'processing'){

                $url = admin_url().'edit.php?post_type=tabs&page=settings&tab=help_support';

                ?>
                <p style="color: #f00;"><i class="fas fa-spin fa-spinner"></i> Migration reset on process, please wait until complete.</p>
                <p><a href="<?php echo esc_url_raw($url); ?>">Refresh</a> to check Migration reset stats</p>

                <script>
                    setTimeout(function(){
                        window.location.href = '<?php echo esc_url_raw($url); ?>';
                    }, 1000*20);

                </script>


                <?php
            }elseif($migration_reset_stats == 'done'){
                ?>
                <p style="color: #22631a;font-weight: bold;"><i class="fas fa-check"></i> Migration reset completed.</p>
                <?php
            }else{

            }



            ?>

            <p class="">Please click the button bellow to reset migration data, you can start over, Please use with caution, your new migrate data will deleted. you can use default <a href="<?php echo admin_url().'export.php'; ?>">export</a> menu to take your wcps, wcps layouts data saved.</p>
            <p>Please <a target="_blank" href="https://www.pickplugins.com/question/tabs-latest-version-data-migration-doesnt-work-here-is-the-solution/"><b>read this</b></a> if you have any issue on data migration</p>

            <p class="reset-migration"><a  class="button  button-primary" href="<?php echo esc_url_raw($actionurl); ?>">Reset migration</a> <span style="display: none; color: #f2433f; margin: 0 5px"> Click again to confirm!</span></p>

            <script>
                jQuery(document).ready(function($){
                    $(document).on('click','.reset-migration a',function(event){

                        event.preventDefault();

                        is_confirm = $(this).attr('confirm');
                        url = $(this).attr('href');

                        if(is_confirm == 'ok'){
                            window.location.href = url;
                        }else{
                            $(this).attr('confirm', 'ok');


                        }
                        $('.reset-migration span').fadeIn();

                    })
                })
            </script>

            <?php

            $html = ob_get_clean();

            $args = array(
                'id'		=> 'reset_migrate',
                //'parent'		=> '',
                'title'		=> __('Reset migration','tabs'),
                'details'	=> '',
                'type'		=> 'custom_html',
                'html'		=> $html,

            );

            //$settings_tabs_field->generate_field($args);



            ob_start();
            ?>

            <p class="">You can install older version by uninstalling current version, your data still on database, don't worry if you see content missing on frontend.</p>

            <a target="_blank" href="https://wordpress.org/plugins/tabs/advanced/#plugin-download-history-stats" class="button"><i class="fab fa-wordpress"></i> Download older version</a>


            <?php

            $html = ob_get_clean();

            $args = array(
                'id'		=> 'old_version',
                //'parent'		=> '',
                'title'		=> __('Older version','tabs'),
                'details'	=> '',
                'type'		=> 'custom_html',
                'html'		=> $html,

            );

            $settings_tabs_field->generate_field($args);



            ?>


        </div>
        <?php


    }
}




add_action('tabs_settings_content_3rd_party_import', 'tabs_settings_content_3rd_party_import');

if(!function_exists('tabs_settings_content_3rd_party_import')) {
    function tabs_settings_content_3rd_party_import($tab){

        $settings_tabs_field = new settings_tabs_field();


        ?>
        <div class="section">
            <div class="section-title"><?php echo __('3rd party plugin data import', 'tabs'); ?></div>
            <p class="description section-description"><?php echo __('Import from 3rd party plugin data for accordion and tabs.', 'tabs'); ?></p>

            <?php



            ob_start();
            $tabs_plugin_info = get_option('tabs_plugin_info');

            //delete_option('tabs_plugin_info');
            //var_dump($tabs_plugin_info);

            $_3rd_party_import_stats = isset($tabs_plugin_info['3rd_party_import']) ? $tabs_plugin_info['3rd_party_import'] : '';


            $actionurl = admin_url().'edit.php?post_type=tabs&page=settings&tab=3rd_party_import';
            $actionurl = wp_nonce_url( $actionurl,  '3rd_party_import' );

            $nonce = isset($_REQUEST['_wpnonce']) ? sanitize_text_field($_REQUEST['_wpnonce']) : '';

            if ( wp_verify_nonce( $nonce, '3rd_party_import' )  ){

                $source = isset($_REQUEST['source']) ? sanitize_text_field($_REQUEST['source']) : '';

                $tabs_plugin_info['3rd_party_import'] = 'processing';
                update_option('tabs_plugin_info', $tabs_plugin_info);

                if($source == 'arconix-faq'){
                    wp_schedule_event(time(), '1minute', 'tabs_import_cron_arconix_faq');
                }elseif($source == 'easy-accordion-free'){
                    wp_schedule_event(time(), '1minute', 'tabs_import_cron_easy_accordion_free');
                }elseif($source == 'responsive-accordion-and-collapse'){
                    wp_schedule_event(time(), '1minute', 'tabs_import_cron_responsive_accordion_collapse');
                }elseif($source == 'responsive-tabs'){
                    wp_schedule_event(time(), '1minute', 'tabs_import_cron_responsive_tabs');
                }elseif($source == 'tabs-responsive'){
                    wp_schedule_event(time(), '1minute', 'tabs_import_cron_tabs_responsive');
                }elseif($source == 'tabby-responsive-tabs'){
                    wp_schedule_event(time(), '1minute', 'tabs_import_cron_tabby_responsive_tabs');
                }elseif($source == 'easy-responsive-tabs'){
                    wp_schedule_event(time(), '1minute', 'tabs_import_cron_easy_responsive_tabs');
                }elseif($source == 'everest-tab-lite'){
                    wp_schedule_event(time(), '1minute', 'tabs_import_cron_everest_tab_lite');
                }elseif($source == 'quick-and-easy-faqs'){
                    wp_schedule_event(time(), '1minute', 'tabs_import_cron_quick_easy_faqs');
                }elseif($source == 'shortcodes-ultimate'){
                    wp_schedule_event(time(), '1minute', 'tabs_import_cron_shortcodes_ultimate');
                }elseif($source == 'sp-faq'){
                    wp_schedule_event(time(), '1minute', 'tabs_import_cron_sp_faq');
                }elseif($source == 'squelch-tabs-and-tabs-shortcodes'){
                    wp_schedule_event(time(), '1minute', 'tabs_import_cron_squelch_tabs_tabs');
                }elseif($source == 'ultimate-faqs'){
                    wp_schedule_event(time(), '1minute', 'tabs_import_cron_ultimate_faqs');
                }elseif($source == 'tabs-shortcode'){
                    wp_schedule_event(time(), '1minute', 'tabs_import_cron_tabs_shortcode');
                }elseif($source == 'wonderplugin-tabs-trial'){
                    wp_schedule_event(time(), '1minute', 'tabs_import_cron_wonderplugin_tabs_trial');
                }elseif($source == 'accordion-shortcodes'){
                    wp_schedule_event(time(), '1minute', 'tabs_import_cron_accordion_shortcodes');
                }elseif($source == 'wp-shortcode'){
                    wp_schedule_event(time(), '1minute', 'tabs_import_cron_wp_shortcode');
                }elseif($source == 'meks-flexible-shortcodes'){
                    wp_schedule_event(time(), '1minute', 'tabs_import_cron_meks_flexible_shortcodes');
                }






                $_3rd_party_import_stats = 'processing';
            }

            if($_3rd_party_import_stats == 'processing'){

                $url = admin_url().'edit.php?post_type=tabs&page=settings&tab=3rd_party_import';

                ?>
                <p style="color: #f00;"><i class="fas fa-spin fa-spinner"></i> Data import on process, please wait until complete.</p>
                <p><a href="<?php echo $url; ?>">Refresh</a> to check import stats</p>



                <?php
            }else{
                ?>
                <p style="color: #22631a;"><i class="fas fa-check"></i> Data import done.</p>



                <?php
            }



            ?>

            <div class="import-source">
                <div class="item">
                    <div class="">Easy Accordion</span></div>
                    <div class="">By ShapedPlugin</div>

                    <p class=""><a  class="button  button-primary" href="<?php echo esc_url_raw($actionurl).'&source=easy-accordion-free'; ?>">Import data</a></p>
                </div>
                <div class="item">
                    <div class="">Responsive Accordion And Collapse </div>
                    <div class="">By wpshopmart</div>

                    <p class=""><a  class="button  button-primary" href="<?php echo esc_url_raw($actionurl).'&source=responsive-accordion-and-collapse'; ?>">Import data</a></p>

                </div>

                <div class="item">
                    <div class="">Tabs Responsive  </div>
                    <div class="">By wpshopmart</div>

                    <p class=""><a  class="button  button-primary" href="<?php echo esc_url_raw($actionurl).'&source=tabs-responsive'; ?>">Import data</a></p>

                </div>

                <div class="item">
                    <div class="">Responsive Tabs</div>
                    <div class="">By WP Darko</div>

                    <p class=""><a  class="button  button-primary" href="<?php echo esc_url_raw($actionurl).'&source=responsive-tabs'; ?>">Import data</a></p>

                </div>

                <div class="item">
                    <div class="">Easy Responsive Tabs </div>
                    <div class="">By oscitas</div>

                    <p class=""><a  class="button  button-primary" href="<?php echo esc_url_raw($actionurl).'&source=easy-responsive-tabs'; ?>">Import data</a></p>

                </div>


                <div class="item">
                    <div class="">Everest Tab Lite</div>
                    <div class="">By AccessPress Themes</div>

                    <p class=""><a  class="button  button-primary" href="<?php echo esc_url_raw($actionurl).'&source=everest-tab-lite'; ?>">Import data</a></p>

                </div>

                <div class="item">
                    <div class="">Quick and Easy FAQs</div>
                    <div class="">By Inspiry Themes</div>

                    <p class=""><a  class="button  button-primary" href="<?php echo esc_url_raw($actionurl).'&source=quick-and-easy-faqs'; ?>">Import data</a></p>
                </div>

                <div class="item">
                    <div class="">Shortcodes Ultimate</div>
                    <div class="">By Vladimir Anokhin</div>

                    <p class=""><a  class="button  button-primary" href="<?php echo esc_url_raw($actionurl).'&source=shortcodes-ultimate'; ?>">Import data</a></p>
                </div>

                <div class="item">
                    <div class="">WP responsive FAQ with category plugin</div>
                    <div class="">By WP OnlineSupport</div>

                    <p class=""><a  class="button  button-primary" href="<?php echo esc_url_raw($actionurl).'&source=sp-faq'; ?>">Import data</a></p>
                </div>

                <div class="item">
                    <div class="">Squelch Tabs and Tabs Shortcodes</div>
                    <div class="">By Matt Lowe</div>

                    <p class=""><a  class="button  button-primary" href="<?php echo esc_url_raw($actionurl).'&source=squelch-tabs-and-tabs-shortcodes'; ?>">Import data</a></p>
                </div>

                <div class="item">
                    <div class="">Tabby Responsive Tabs</div>
                    <div class="">By cubecolour</div>

                    <p class=""><a  class="button  button-primary" href="<?php echo esc_url_raw($actionurl).'&source=tabby-responsive-tabs'; ?>">Import data</a></p>
                </div>

                <div class="item">
                    <div class="">Ultimate FAQ</div>
                    <div class="">By Etoile Web Design</div>

                    <p class=""><a  class="button  button-primary" href="<?php echo esc_url_raw($actionurl).'&source=ultimate-faqs'; ?>">Import data</a></p>
                </div>

<!--                <div class="item">-->
<!--                    <div class="">Tab</div>-->
<!--                    <div class="">By themepoints</div>-->
<!---->
<!--                    <p class=""><a  class="button  button-primary" href="--><?php //echo $actionurl.'&source=tabs-pro'; ?><!--">Import data</a></p>-->
<!--                </div>-->

                <div class="item">
                    <div class="">Accordion Shortcodes</div>
                    <div class="">By Phil Buchanan</div>

                    <p class=""><a  class="button  button-primary" href="<?php echo esc_url_raw($actionurl).'&source=accordion-shortcodes'; ?>">Import data</a></p>
                </div>


<!--                <div class="item">-->
<!--                    <div class="">Shortcodes by Angie Makes</div>-->
<!--                    <div class="">By Chris Baldelomar</div>-->
<!---->
<!--                    <p class=""><a  class="button  button-primary" href="--><?php //echo $actionurl.'&source=wc-shortcodes'; ?><!--">Import data</a></p>-->
<!--                </div>-->


                <div class="item">
                    <div class="">WP Shortcode</div>
                    <div class="">By MyThemeShop</div>

                    <p class=""><a  class="button  button-primary" href="<?php echo esc_url_raw($actionurl).'&source=wp-shortcode'; ?>">Import data</a></p>
                </div>

                <div class="item">
                    <div class="">Arconix FAQ</div>
                    <div class="">By Tyche Softwares</div>

                    <p class=""><a  class="button  button-primary" href="<?php echo esc_url_raw($actionurl).'&source=arconix-faq'; ?>">Import data</a></p>
                </div>

                <div class="item">
                    <div class="">Meks Flexible Shortcodes</div>
                    <div class="">By Meks</div>

                    <p class=""><a  class="button  button-primary" href="<?php echo esc_url_raw($actionurl).'&source=meks-flexible-shortcodes'; ?>">Import data</a></p>
                </div>


                <div class="item">
                    <div class="">Tabs Shortcode</div>
                    <div class="">By CTLT</div>

                    <p class=""><a  class="button  button-primary" href="<?php echo esc_url_raw($actionurl).'&source=tabs-shortcode'; ?>">Import data</a></p>
                </div>



                <div class="item">
                    <div class="">Wonder Tabs Trial</div>
                    <div class="">By Magic Hills Pty Ltd</div>

                    <p class=""><a  class="button  button-primary" href="<?php echo esc_url_raw($actionurl).'&source=wonderplugin-tabs-trial'; ?>">Import data</a></p>
                </div>






            </div>
            
<!--            <p class="">Arconix FAQ - <a  class="button  button-primary" href="--><?php //echo $actionurl.'&source=arconix-faq'; ?><!--">Import data</a> <span style="display: none; color: #f2433f; margin: 0 5px"> Click again to confirm!</span></p>-->
<!--            <p class="">Tabs By Biplob Adhikari - <a  class="button  button-primary" href="--><?php //echo $actionurl.'&source=vc-tabs'; ?><!--">Import data</a> <span style="display: none; color: #f2433f; margin: 0 5px"> Click again to confirm!</span></p>-->



            <style type="text/css">
                .import-source{}
                .import-source .item{
                    width: 255px;
                    overflow: hidden;
                    display: inline-block;
                    margin: 10px;
                    background: #306c9e;
                    padding: 10px;
                    color: #fff;
                }
                .import-source .item img{
                    width: 100%;
                }


            </style>

            <?php

            $html = ob_get_clean();

            $args = array(
                'id'		=> 'reset_migrate',
                //'parent'		=> '',
                'title'		=> __('Import data','tabs'),
                'details'	=> __('Please contact our support form to add new 3rd party plugin source.','tabs'),
                'type'		=> 'custom_html',
                'html'		=> $html,

            );

            $settings_tabs_field->generate_field($args);




            ?>


        </div>

        <?php


    }
}

add_action('tabs_settings_content_migration', 'tabs_settings_content_migration');

if(!function_exists('tabs_settings_content_migration')) {
    function tabs_settings_content_migration($tab){

        $settings_tabs_field = new settings_tabs_field();

        //delete_option('tabs_plugin_info');

        $tabs_plugin_info = get_option('tabs_plugin_info');
        $tabs_upgrade = isset($tabs_plugin_info['tabs_upgrade']) ? $tabs_plugin_info['tabs_upgrade'] : '';


        $nonce = isset($_REQUEST['_wpnonce']) ? sanitize_text_field($_REQUEST['_wpnonce']) : '';
        $start_migration = isset($_REQUEST['start_migration']) ? sanitize_text_field($_REQUEST['start_migration']) : '';

        if ( wp_verify_nonce( $nonce, 'tabs_upgrade' )  ){



            wp_schedule_event(time(), '1minute', 'tabs_cron_upgrade_settings');
            wp_schedule_event(time(), '1minute', 'tabs_cron_upgrade_tabs');

            //return;
        }

        ?>
        <div class="section">
            <div class="section-title"><?php echo __('Data migration', 'tabs'); ?></div>
            <p class="description section-description"><?php echo __('Data migration will automatically completed.', 'tabs'); ?></p>

            <div class="setting-field   ">
                <?php


                //echo '<pre>'.var_export(_get_cron_array(), true).'</pre>';
                //echo '<pre>'.var_export(wp_get_scheduled_event('tabs_cron_upgrade_settings'), true).'</pre>';
                //echo '<pre>'.var_export(wp_get_scheduled_event('tabs_cron_upgrade_tabs'), true).'</pre>';

                //echo '<pre>'.var_export(wp_next_scheduled('tabs_cron_upgrade_tabs'), true).'</pre>';


                if($tabs_upgrade != 'done') {


                    ?>
                    <p>Settings migration: <strong><?php if(wp_get_scheduled_event('tabs_cron_upgrade_settings') == false) echo 'Completed'; ?></strong></p>
                    <p>Tabs Data migration: <strong><?php if(wp_get_scheduled_event('tabs_cron_upgrade_tabs') == false) echo 'Completed'; else echo 'Processing'; ?></strong>, Next schedule: <?php echo date('m-d-Y H:i:s', wp_next_scheduled('tabs_cron_upgrade_tabs')); ?> </p>

                    <?php

                }

                ?>
            </div>


        </div>
        <?php







    }
}



add_action('tabs_settings_content_buy_pro', 'tabs_settings_content_buy_pro');

if(!function_exists('tabs_settings_content_buy_pro')) {
    function tabs_settings_content_buy_pro($tab){

        $settings_tabs_field = new settings_tabs_field();


        ?>
        <div class="section">
            <div class="section-title"><?php echo __('Get Premium', 'tabs'); ?></div>
            <p class="description section-description"><?php echo __('Thanks for using our plugin, if you looking for some advance feature please buy premium version.', 'tabs'); ?></p>

            <?php


            ob_start();
            ?>

            <p><?php echo __('If you love our plugin and want more feature please consider to buy pro version.', 'tabs'); ?></p>
            <a class="button" href="https://pickplugins.com/item/tabs-html-css3-responsive-tabs-for-wordpress/?ref=dashobard"><?php echo __('Buy premium', 'tabs'); ?></a>
            <a class="button" href="http://www.pickplugins.com/demo/tabs/?ref=dashobard"><?php echo __('See all demo', 'tabs'); ?></a>

            <h2><?php echo __('See the differences','tabs'); ?></h2>

            <table class="pro-features">
                <thead>
                <tr>
                    <th class="col-features"><?php echo __('Features','tabs'); ?></th>
                    <th class="col-free"><?php echo __('Free','tabs'); ?></th>
                    <th class="col-pro"><?php echo __('Premium','tabs'); ?></th>
                </tr>
                </thead>

                <tr>
                    <td class="col-features"><?php echo __('Nested/multi level accordion','tabs'); ?> </td>
                    <td><i class="fas fa-times"></i></td>
                    <td><i class="fas fa-check"></i></td>
                </tr>
                <tr>
                    <td class="col-features"><?php echo __('Click header to scroll top','tabs'); ?> </td>
                    <td><i class="fas fa-times"></i></td>
                    <td><i class="fas fa-check"></i></td>
                </tr>

                <tr>
                    <td class="col-features"><?php echo __('Header text toggle','tabs'); ?> </td>
                    <td><i class="fas fa-times"></i></td>
                    <td><i class="fas fa-check"></i></td>
                </tr>
                <tr>
                    <td class="col-features"><?php echo __('Display expand/collapse all button','tabs'); ?> </td>
                    <td><i class="fas fa-times"></i></td>
                    <td><i class="fas fa-check"></i></td>
                </tr>
                <tr>
                    <td class="col-features"><?php echo __('Expand/collapse all text','tabs'); ?> </td>
                    <td><i class="fas fa-times"></i></td>
                    <td><i class="fas fa-check"></i></td>
                </tr>
                <tr>
                    <td class="col-features"><?php echo __('Expand/collapse all button background color','tabs'); ?> </td>
                    <td><i class="fas fa-times"></i></td>
                    <td><i class="fas fa-check"></i></td>
                </tr>
                <tr>
                    <td class="col-features"><?php echo __('Header click track & stats','tabs'); ?> </td>
                    <td><i class="fas fa-times"></i></td>
                    <td><i class="fas fa-check"></i></td>
                </tr>

                <tr>
                    <td class="col-features"><?php echo __('Header background image','tabs'); ?> </td>
                    <td><i class="fas fa-times"></i></td>
                    <td><i class="fas fa-check"></i></td>
                </tr>

                <tr>
                    <td class="col-features"><?php echo __('Custom background color','tabs'); ?> </td>
                    <td><i class="fas fa-times"></i></td>
                    <td><i class="fas fa-check"></i></td>
                </tr>

                <tr>
                    <td class="col-features"><?php echo __('Active accordion on page load','tabs'); ?> </td>
                    <td><i class="fas fa-times"></i></td>
                    <td><i class="fas fa-check"></i></td>
                </tr>

                <tr>
                    <td class="col-features"><?php echo __('Icon position to right','tabs'); ?> </td>
                    <td><i class="fas fa-times"></i></td>
                    <td><i class="fas fa-check"></i></td>
                </tr>

                <tr>
                    <td class="col-features"><?php echo __('Enable search','tabs'); ?> </td>
                    <td><i class="fas fa-times"></i></td>
                    <td><i class="fas fa-check"></i></td>
                </tr>
                <tr>
                    <td class="col-features"><?php echo __('Search placeholder text','tabs'); ?> </td>
                    <td><i class="fas fa-times"></i></td>
                    <td><i class="fas fa-check"></i></td>
                </tr>


                <tr>
                    <td class="col-features"><?php echo __('Enable lazy load','tabs'); ?> </td>
                    <td><i class="fas fa-check"></i></td>
                    <td><i class="fas fa-check"></i></td>
                </tr>

                <tr>
                    <td class="col-features"><?php echo __('Lazy load image','tabs'); ?> </td>
                    <td><i class="fas fa-check"></i></td>
                    <td><i class="fas fa-check"></i></td>
                </tr>
                <tr>
                    <td class="col-features"><?php echo __('Enable autoembed','tabs'); ?> </td>
                    <td><i class="fas fa-check"></i></td>
                    <td><i class="fas fa-check"></i></td>
                </tr>
                <tr>
                    <td class="col-features"><?php echo __('3rd party shortcode on content','tabs'); ?> </td>
                    <td><i class="fas fa-check"></i></td>
                    <td><i class="fas fa-check"></i></td>
                </tr>
                <tr>
                    <td class="col-features"><?php echo __('Enable wpautop','tabs'); ?> </td>
                    <td><i class="fas fa-check"></i></td>
                    <td><i class="fas fa-check"></i></td>
                </tr>
                <tr>
                    <td class="col-features"><?php echo __('Schema for FAQ page','tabs'); ?> </td>
                    <td><i class="fas fa-check"></i></td>
                    <td><i class="fas fa-check"></i></td>
                </tr>

                <tr>
                    <td class="col-features"><?php echo __('Accordion feature collapsible','tabs'); ?> </td>
                    <td><i class="fas fa-check"></i></td>
                    <td><i class="fas fa-check"></i></td>
                </tr>
                <tr>
                    <td class="col-features"><?php echo __('Accordion feature keep expanded others','tabs'); ?> </td>
                    <td><i class="fas fa-check"></i></td>
                    <td><i class="fas fa-check"></i></td>
                </tr>
                <tr>
                    <td class="col-features"><?php echo __('Accordion feature content height style','tabs'); ?> </td>
                    <td><i class="fas fa-check"></i></td>
                    <td><i class="fas fa-check"></i></td>
                </tr>
                <tr>
                    <td class="col-features"><?php echo __('Accordion feature activate event','tabs'); ?> </td>
                    <td><i class="fas fa-check"></i></td>
                    <td><i class="fas fa-check"></i></td>
                </tr>
                <tr>
                    <td class="col-features"><?php echo __('Accordion custom active icon','tabs'); ?> </td>
                    <td><i class="fas fa-check"></i></td>
                    <td><i class="fas fa-check"></i></td>
                </tr>
                <tr>
                    <td class="col-features"><?php echo __('Accordion custom inactive icon','tabs'); ?> </td>
                    <td><i class="fas fa-check"></i></td>
                    <td><i class="fas fa-check"></i></td>
                </tr>

                <tr>
                    <td class="col-features"><?php echo __('Accordion icons text color','tabs'); ?> </td>
                    <td><i class="fas fa-check"></i></td>
                    <td><i class="fas fa-check"></i></td>
                </tr>
                <tr>
                    <td class="col-features"><?php echo __('Accordion icons hover color','tabs'); ?> </td>
                    <td><i class="fas fa-check"></i></td>
                    <td><i class="fas fa-check"></i></td>
                </tr>
                <tr>
                    <td class="col-features"><?php echo __('Accordion icons background color','tabs'); ?> </td>
                    <td><i class="fas fa-check"></i></td>
                    <td><i class="fas fa-check"></i></td>
                </tr>
                <tr>
                    <td class="col-features"><?php echo __('Accordion icons font size','tabs'); ?> </td>
                    <td><i class="fas fa-check"></i></td>
                    <td><i class="fas fa-check"></i></td>
                </tr>
                <tr>
                    <td class="col-features"><?php echo __('Accordion icons padding','tabs'); ?> </td>
                    <td><i class="fas fa-check"></i></td>
                    <td><i class="fas fa-check"></i></td>
                </tr>
                <tr>
                    <td class="col-features"><?php echo __('Accordion icons margin','tabs'); ?> </td>
                    <td><i class="fas fa-check"></i></td>
                    <td><i class="fas fa-check"></i></td>
                </tr>

                <tr>
                    <td class="col-features"><?php echo __('Accordion header custom class','tabs'); ?> </td>
                    <td><i class="fas fa-check"></i></td>
                    <td><i class="fas fa-check"></i></td>
                </tr>

                <tr>
                    <td class="col-features"><?php echo __('Accordion header background color','tabs'); ?> </td>
                    <td><i class="fas fa-check"></i></td>
                    <td><i class="fas fa-check"></i></td>
                </tr>

                <tr>
                    <td class="col-features"><?php echo __('Accordion header Active background color','tabs'); ?> </td>
                    <td><i class="fas fa-check"></i></td>
                    <td><i class="fas fa-check"></i></td>
                </tr>
                <tr>
                    <td class="col-features"><?php echo __('Accordion header text color','tabs'); ?> </td>
                    <td><i class="fas fa-check"></i></td>
                    <td><i class="fas fa-check"></i></td>
                </tr>

                <tr>
                    <td class="col-features"><?php echo __('Accordion header hover text color','tabs'); ?> </td>
                    <td><i class="fas fa-check"></i></td>
                    <td><i class="fas fa-check"></i></td>
                </tr>

                <tr>
                    <td class="col-features"><?php echo __('Accordion header font size','tabs'); ?> </td>
                    <td><i class="fas fa-check"></i></td>
                    <td><i class="fas fa-check"></i></td>
                </tr>
                <tr>
                    <td class="col-features"><?php echo __('Accordion header padding','tabs'); ?> </td>
                    <td><i class="fas fa-check"></i></td>
                    <td><i class="fas fa-check"></i></td>
                </tr>
                <tr>
                    <td class="col-features"><?php echo __('Accordion header margin','tabs'); ?> </td>
                    <td><i class="fas fa-check"></i></td>
                    <td><i class="fas fa-check"></i></td>
                </tr>
                <tr>
                    <td class="col-features"><?php echo __('Accordion header font family','tabs'); ?> </td>
                    <td><i class="fas fa-check"></i></td>
                    <td><i class="fas fa-check"></i></td>
                </tr>



                <tr>
                    <td class="col-features"><?php echo __('Accordion content custom class','tabs'); ?> </td>
                    <td><i class="fas fa-check"></i></td>
                    <td><i class="fas fa-check"></i></td>
                </tr>

                <tr>
                    <td class="col-features"><?php echo __('Accordion content background color','tabs'); ?> </td>
                    <td><i class="fas fa-check"></i></td>
                    <td><i class="fas fa-check"></i></td>
                </tr>

                <tr>
                    <td class="col-features"><?php echo __('Accordion content text color','tabs'); ?> </td>
                    <td><i class="fas fa-check"></i></td>
                    <td><i class="fas fa-check"></i></td>
                </tr>


                <tr>
                    <td class="col-features"><?php echo __('Accordion content font size','tabs'); ?> </td>
                    <td><i class="fas fa-check"></i></td>
                    <td><i class="fas fa-check"></i></td>
                </tr>
                <tr>
                    <td class="col-features"><?php echo __('Accordion content padding','tabs'); ?> </td>
                    <td><i class="fas fa-check"></i></td>
                    <td><i class="fas fa-check"></i></td>
                </tr>
                <tr>
                    <td class="col-features"><?php echo __('Accordion content margin','tabs'); ?> </td>
                    <td><i class="fas fa-check"></i></td>
                    <td><i class="fas fa-check"></i></td>
                </tr>
                <tr>
                    <td class="col-features"><?php echo __('Accordion content font family','tabs'); ?> </td>
                    <td><i class="fas fa-check"></i></td>
                    <td><i class="fas fa-check"></i></td>
                </tr>



                <tr>
                    <td class="col-features"><?php echo __('Accordion container padding','tabs'); ?> </td>
                    <td><i class="fas fa-check"></i></td>
                    <td><i class="fas fa-check"></i></td>
                </tr>
                <tr>
                    <td class="col-features"><?php echo __('Accordion container background color','tabs'); ?> </td>
                    <td><i class="fas fa-check"></i></td>
                    <td><i class="fas fa-check"></i></td>
                </tr>
                <tr>
                    <td class="col-features"><?php echo __('Accordion container background image','tabs'); ?> </td>
                    <td><i class="fas fa-check"></i></td>
                    <td><i class="fas fa-check"></i></td>
                </tr>
                <tr>
                    <td class="col-features"><?php echo __('Accordion container text align','tabs'); ?> </td>
                    <td><i class="fas fa-check"></i></td>
                    <td><i class="fas fa-check"></i></td>
                </tr>
                <tr>
                    <td class="col-features"><?php echo __('Sort accordion content','tabs'); ?> </td>
                    <td><i class="fas fa-check"></i></td>
                    <td><i class="fas fa-check"></i></td>
                </tr>

                <tr>
                    <td class="col-features"><?php echo __('Hide accordion content','tabs'); ?> </td>
                    <td><i class="fas fa-check"></i></td>
                    <td><i class="fas fa-check"></i></td>
                </tr>

                <tr>
                    <td class="col-features"><?php echo __('WP editor for accordion content','tabs'); ?> </td>
                    <td><i class="fas fa-check"></i></td>
                    <td><i class="fas fa-check"></i></td>
                </tr>

                <tr>
                    <td class="col-features"><?php echo __('Font-awesome version selection','tabs'); ?> </td>
                    <td><i class="fas fa-check"></i></td>
                    <td><i class="fas fa-check"></i></td>
                </tr>

                <tr>
                    <td class="col-features"><?php echo __('Tabs preview on frontend','tabs'); ?> </td>
                    <td><i class="fas fa-check"></i></td>
                    <td><i class="fas fa-check"></i></td>
                </tr>

                <tr>
                    <td class="col-features"><?php echo __('Export accordion','tabs'); ?> </td>
                    <td><i class="fas fa-check"></i></td>
                    <td><i class="fas fa-check"></i></td>
                </tr>

                <tr>
                    <td class="col-features"><?php echo __('Import accordion','tabs'); ?> </td>
                    <td><i class="fas fa-check"></i></td>
                    <td><i class="fas fa-check"></i></td>
                </tr>



                <tr>
                    <th class="col-features"><?php echo __('Features','tabs'); ?></th>
                    <th class="col-free"><?php echo __('Free','tabs'); ?></th>
                    <th class="col-pro"><?php echo __('Premium','tabs'); ?></th>
                </tr>
                <tr>
                    <td class="col-features"><?php echo __('Buy now','tabs'); ?></td>
                    <td> </td>
                    <td><a class="button" href="https://pickplugins.com/item/tabs-html-css3-responsive-tabs-for-wordpress/?ref=dashobard"><?php echo __('Buy premium', 'tabs'); ?></a></td>
                </tr>

            </table>



            <?php

            $html = ob_get_clean();

            $args = array(
                'id'		=> 'get_pro',
                'title'		=> __('Get pro version','tabs'),
                'details'	=> '',
                'type'		=> 'custom_html',
                'html'		=> $html,

            );

            $settings_tabs_field->generate_field($args);


            ?>


        </div>

        <style type="text/css">
            .pro-features{
                margin: 30px 0;
                border-collapse: collapse;
                border: 1px solid #ddd;
            }
            .pro-features th{
                width: 120px;
                background: #ddd;
                padding: 10px;
            }
            .pro-features tr{
            }
            .pro-features td{
                border-bottom: 1px solid #ddd;
                padding: 10px 10px;
                text-align: center;
            }
            .pro-features .col-features{
                width: 230px;
                text-align: left;
            }

            .pro-features .col-free{
            }
            .pro-features .col-pro{
            }

            .pro-features i.fas.fa-check {
                color: #139e3e;
                font-size: 16px;
            }
            .pro-features i.fas.fa-times {
                color: #f00;
                font-size: 17px;
            }
        </style>
        <?php


    }
}









add_action('tabs_settings_save', 'tabs_settings_save');

function tabs_settings_save(){

    $tabs_settings = isset($_POST['tabs_settings']) ?  tabs_recursive_sanitize_arr($_POST['tabs_settings']) : array();
    update_option('tabs_settings', $tabs_settings);
}

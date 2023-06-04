<?php
if ( ! defined('ABSPATH')) exit;  // if direct access

//add_action('tabs_main', 'tabs_main_top');

function tabs_main_top($atts){

    $post_id = isset($atts['id']) ? $atts['id'] : '';
    $tabs_options = get_post_meta($post_id,'tabs_options', true);
    $tabs_options = !empty($tabs_options) ? $tabs_options : tabs_old_options($post_id);


    $lazy_load = isset($tabs_options['lazy_load']) ? $tabs_options['lazy_load'] : 'yes';
    $lazy_load_src = isset($tabs_options['lazy_load_src']) ? $tabs_options['lazy_load_src'] : '';

    if($lazy_load=='yes'):
        ?>
        <div id="tabs-lazy-<?php echo esc_attr($post_id); ?>" class="tabs-lazy">
            <?php if(!empty($lazy_load_src)):?>
                <img src="<?php echo esc_url_raw($lazy_load_src); ?>" />
            <?php endif; ?>
        </div>
        <script>
            jQuery(window).load(function(){
                jQuery('#tabs-lazy-<?php echo esc_attr($post_id); ?>').fadeOut();
                jQuery('#tabs-<?php echo esc_attr($post_id); ?> .items').fadeIn();
            });
        </script>
    <?php
    endif;
}







add_action('tabs_main', 'tabs_main_style');

function tabs_main_style($atts){

    $post_id = isset($atts['id']) ? $atts['id'] : '';

    $tabs_options = get_post_meta($post_id,'tabs_options', true);
    $tabs_options = !empty($tabs_options) ? $tabs_options : tabs_old_options($post_id);


    $tabs_content = isset($tabs_options['content']) ? $tabs_options['content'] : array();

    $lazy_load = isset($tabs_options['lazy_load']) ? $tabs_options['lazy_load'] : 'yes';

    $icon = isset($tabs_options['icon']) ? $tabs_options['icon'] : array();
    $icon_active = isset($icon['active']) ? $icon['active'] : '';
    $icon_inactive = isset($icon['inactive']) ? $icon['inactive'] : '';
    $icon_color = isset($icon['color']) ? $icon['color'] : '';
    $icon_color_hover = isset($icon['color_hover']) ? $icon['color_hover'] : '';
    $icon_font_size = isset($icon['font_size']) ? $icon['font_size'] : '';
    $icon_background_color = isset($icon['background_color']) ? $icon['background_color'] : '';
    $icon_padding = isset($icon['padding']) ? $icon['padding'] : '0px';
    $icon_margin = isset($icon['margin']) ? $icon['margin'] : '0px';


    $header = isset($tabs_options['header']) ? $tabs_options['header'] : array();
    $header_style_class = isset($header['style_class']) ? $header['style_class'] : '';

    $header_background_color = !empty($header['background_color']) ? $header['background_color'] : '#1e73be';
    $header_active_background_color = !empty($header['active_background_color']) ? $header['active_background_color'] : '#174e7f';
    $header_color = !empty($header['color']) ? $header['color'] : '#ffffff';
    $header_color_hover = !empty($header['color_hover']) ? $header['color_hover'] : '#ffffff';
    $header_font_size = !empty($header['font_size']) ? $header['font_size'] : '';
    $header_padding = !empty($header['padding']) ? $header['padding'] : '8px 15px';
    $header_margin = !empty($header['margin']) ? $header['margin'] : '0px';


    $body = isset($tabs_options['body']) ? $tabs_options['body'] : array();
    $body_background_color = isset($body['background_color']) ? $body['background_color'] : '';
    $body_active_background_color = isset($body['active_background_color']) ? $body['active_background_color'] : '';
    $body_color = isset($body['color']) ? $body['color'] : '';
    $body_color_hover = isset($body['color_hover']) ? $body['color_hover'] : '';
    $body_font_size = isset($body['font_size']) ? $body['font_size'] : '';
    $body_padding = isset($body['padding']) ? $body['padding'] : '';
    $body_margin = isset($body['margin']) ? $body['margin'] : '';

    $container = isset($tabs_options['container']) ? $tabs_options['container'] : array();
    $container_padding = isset($container['padding']) ? $container['padding'] : '';
    $container_background_color = isset($container['background_color']) ? $container['background_color'] : '';
    $container_text_align = isset($container['text_align']) ? $container['text_align'] : '';
    $container_background_img = isset($container['background_img']) ? $container['background_img'] : '';
    $width_large = isset($container['width_large']) ? $container['width_large'] : '';
    $width_medium = isset($container['width_medium']) ? $container['width_medium'] : '';
    $width_small = isset($container['width_small']) ? $container['width_small'] : '';

    $custom_scripts = isset($tabs_options['custom_scripts']) ? $tabs_options['custom_scripts'] : array();
    $custom_js = isset($custom_scripts['custom_js']) ? $custom_scripts['custom_js'] : '';
    $custom_css = isset($custom_scripts['custom_css']) ? $custom_scripts['custom_css'] : '';


    $tabs = isset($tabs_options['tabs']) ? $tabs_options['tabs'] : '';


    $tabs_is_vertical = isset($tabs['is_vertical']) ? $tabs['is_vertical'] : '';
    $navs_width_ratio = isset($tabs['navs_width_ratio']) ? $tabs['navs_width_ratio'] : '';
    $tabs_icon_toggle = isset($tabs['tabs_icon_toggle']) ? $tabs['tabs_icon_toggle'] : '';
    $navs_alignment = isset($tabs['navs_alignment']) ? $tabs['navs_alignment'] : 'left';

    $tabs_settings = get_option('tabs_settings');
    $font_aw_version = isset($tabs_settings['font_aw_version']) ? $tabs_settings['font_aw_version'] : 'none';



    wp_enqueue_style('tabs-style');
    wp_enqueue_style('style-tabs');
    wp_enqueue_style('tabs-style');
    wp_enqueue_style('jquery-ui');

    if($font_aw_version =='v_5'){
        wp_enqueue_style('fontawesome-5');
    }elseif($font_aw_version =='v_4'){
        wp_enqueue_style('fontawesome-4');
    }else{

    }

    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'jquery-ui-core' );
    wp_enqueue_script('jquery-ui-tabs');
    wp_enqueue_script('jquery-effects-core');



    ?>
    <style type='text/css'>
        @media only screen and (min-width: 1024px ){
            #tabs-<?php echo esc_attr($post_id); ?> {
            <?php if(!empty($width_large)):?>
                width: <?php echo esc_attr($width_large); ?>;
            <?php endif; ?>
            }
        }
        @media only screen and ( min-width: 768px ) and ( max-width: 1023px ) {
            #tabs-<?php echo esc_attr($post_id); ?> {
            <?php if(!empty($width_medium)):?>
                width: <?php echo esc_attr($width_medium); ?>;
            <?php endif; ?>
            }
        }
        @media only screen and ( min-width: 0px ) and ( max-width: 767px ){
            #tabs-<?php echo esc_attr($post_id); ?> {
            <?php if(!empty($width_small)):?>
                width: <?php echo esc_attr($width_small); ?>;
            <?php endif; ?>
            }
        }
        #tabs-<?php echo esc_attr($post_id); ?>{
        <?php if(!empty($container_text_align)):?>
            text-align: <?php echo esc_attr($container_text_align); ?>;
        <?php endif; ?>
        }
        #tabs-<?php echo esc_attr($post_id); ?>{
        <?php if(!empty($container_background_color)):?>
            background-color:<?php echo esc_attr($container_background_color); ?>;
        <?php endif; ?>
        <?php if(!empty($container_background_img)):?>
            background-image: url(<?php echo esc_attr($container_background_img); ?>);
        <?php endif; ?>

        <?php if(!empty($container_padding)):?>
            padding: <?php echo esc_attr($container_padding); ?>;
        <?php endif; ?>
        }
        #tabs-<?php echo esc_attr($post_id); ?> .tabs-nav{
        <?php if(!empty($header_background_color)):?>
            background-color:<?php echo esc_attr($header_background_color); ?>;
        <?php endif; ?>
        <?php if(!empty($header_margin)):?>
            margin:<?php echo esc_attr($header_margin); ?> !important;
        <?php endif; ?>
        <?php if(!empty($header_padding)):?>
            padding:<?php echo esc_attr($header_padding); ?> !important;
        <?php endif; ?>
        <?php if(!empty($navs_alignment)):?>
            float:<?php echo esc_attr($navs_alignment); ?> !important;
        <?php endif; ?>
            border: none;
        }
        #tabs-<?php echo esc_attr($post_id); ?> .tabs-nav:hover{
        <?php if(!empty($header_active_background_color)):?>
            background-color: <?php echo esc_attr($header_active_background_color); ?>;
        <?php else:?>
            background-color: rgba(0,0,0,0);
        <?php endif; ?>
        }
        #tabs-<?php echo esc_attr($post_id); ?> .ui-tabs-anchor{
        <?php if(!empty($header_color)):?>
            color:<?php echo esc_attr($header_color); ?>;
        <?php endif; ?>
        <?php if(!empty($header_font_size)):?>
            font-size:<?php echo esc_attr($header_font_size); ?>;
        <?php endif; ?>
            margin:0px !important;
            padding:0px !important;
        }
        #tabs-<?php echo esc_attr($post_id); ?> .tabs-head-title{
        <?php if(!empty($header_color)):?>
            color:<?php echo esc_attr($header_color); ?>;
        <?php endif; ?>
        }
        #tabs-<?php echo esc_attr($post_id); ?> .ui-tabs-active{
        <?php if(!empty($header_active_background_color)):?>
            background-color: <?php echo esc_attr($header_active_background_color); ?>;
        <?php else:?>
            background-color: rgba(0,0,0,0);
        <?php endif; ?>
        }
        #tabs-<?php echo esc_attr($post_id); ?> .accordion-icons{
        <?php if(!empty($icon_color)):?>
            color:<?php echo esc_attr($icon_color); ?>;
        <?php endif; ?>
        <?php if(!empty($icon_font_size)):?>
            font-size:<?php echo esc_attr($icon_font_size); ?>;
        <?php endif; ?>
        <?php if(!empty($icon_background_color)):?>
            background:<?php echo esc_attr($icon_background_color); ?> none repeat scroll 0 0;
        <?php endif; ?>
        <?php if(!empty($icon_padding)):?>
            padding:<?php echo esc_attr($icon_padding); ?>;
        <?php endif; ?>
        <?php if(!empty($icon_margin)):?>
            margin:<?php echo esc_attr($icon_margin); ?>;
        <?php endif; ?>
        }
        #tabs-<?php echo esc_attr($post_id); ?> .tabs-nav:hover .accordion-icons span{
        <?php if(!empty($icon_color_hover)):?>
            color:<?php echo esc_attr($icon_color_hover); ?>;
        <?php endif; ?>
        }
        #tabs-<?php echo esc_attr($post_id); ?> .tabs-content{
        <?php if(!empty($body_background_color)):?>
            background-color:<?php echo esc_attr($body_background_color); ?>;
            <?php endif; ?>
        <?php if(!empty($body_color)):?>
            color:<?php echo esc_attr($body_color); ?>;
        <?php endif; ?>
        <?php if(!empty($body_font_size)):?>
            font-size:<?php echo esc_attr($body_font_size); ?>;
            <?php endif; ?>
        <?php if(!empty($body_margin)):?>
            margin:<?php echo esc_attr($body_margin); ?>;
            <?php endif; ?>
        <?php if(!empty($body_padding)):?>
            padding:<?php echo esc_attr($body_padding); ?>;
        <?php endif; ?>
        }
        #tabs-<?php echo esc_attr($post_id); ?> .accordion-icons span{
        <?php if(!empty($icon_color)):?>
            color:<?php echo esc_attr($icon_color); ?>;
        <?php endif; ?>
        <?php if(!empty($icon_font_size)):?>
            font-size:<?php echo esc_attr($icon_font_size); ?>;
        <?php endif; ?>
        }
        <?php
        if(!empty($tabs_custom_css)){
            echo esc_attr($tabs_custom_css);
        }
        if($tabs_icon_toggle=='yes'){
            ?>
        .tabs .ui-tabs-active .tabs-tab-plus {
            display: none;
        }
        .tabs .ui-tabs-active .tabs-tab-minus {
            display: inline;
        }
        <?php
    }
    if($tabs_is_vertical=='yes'){

        $nav_width_ratio = ($navs_width_ratio + 5);
        $panel_width_ratio = (100 - $nav_width_ratio);


        ?>
        .ui-tabs-vertical .ui-tabs-nav { float: left; width: <?php echo esc_attr($navs_width_ratio); ?>%;overflow: hidden; }
        .ui-tabs-vertical .ui-tabs-nav li { clear: left; width: 100%; }
        .ui-tabs-vertical .ui-tabs-panel { padding: 1em; float: left; width: <?php echo esc_attr($panel_width_ratio); ?>%;}
        <?php
    }
     ?>
    </style>
    <?php
}







add_action('tabs_main', 'tabs_main_items');

function tabs_main_items($atts){

    $post_id = isset($atts['id']) ? $atts['id'] : '';
    $tabs_options = get_post_meta($post_id,'tabs_options', true);
    $tabs_options = !empty($tabs_options) ? $tabs_options : tabs_old_options($post_id);


    $tabs_content = isset($tabs_options['content']) ? $tabs_options['content'] : array();
    $enable_shortcode = isset($tabs_options['enable_shortcode']) ? $tabs_options['enable_shortcode'] : 'yes';
    $enable_wpautop = isset($tabs_options['enable_wpautop']) ? $tabs_options['enable_wpautop'] : 'yes';
    $enable_autoembed = isset($tabs_options['enable_autoembed']) ? $tabs_options['enable_autoembed'] : 'yes';

    $header = isset($tabs_options['header']) ? $tabs_options['header'] : array();
    $header_class = isset($header['class']) ? $header['class'] : '';

    $body = isset($tabs_options['body']) ? $tabs_options['body'] : array();
    $body_class = isset($body['class']) ? $body['class'] : '';


    $icon = isset($tabs_options['icon']) ? $tabs_options['icon'] : array();
    $icon_active = !empty($icon['active']) ? $icon['active'] : '<i class="fas fa-chevron-up"></i>';
    $icon_inactive = !empty($icon['inactive']) ? $icon['inactive'] : '<i class="fas fa-chevron-right"></i>';
    $icon_position = !empty($icon['position']) ? $icon['position'] : 'left';

    $active_plugins = get_option('active_plugins');

    //var_dump($icon_position);



    if(empty($tabs_content)){

        $tabs_content = tabs_old_content($post_id);
        //var_dump($tabs_content);

    }

    $nav_html = '';
    $nav_content_html = '';
    $active_index = array();

        if(!empty($tabs_content)):

            $item_count = 0;

            foreach ($tabs_content as $index => $accordion){

                $accordion_hide = isset($accordion['hide']) ? $accordion['hide'] : '';

                if($accordion_hide == 'true') continue;


                $accordion_header = isset($accordion['header']) ? $accordion['header'] : '';
                $accordion_body = isset($accordion['body']) ? $accordion['body'] : '';

                $accordion_is_active = isset($accordion['is_active']) ? $accordion['is_active'] : '';
                $toggled_text = isset($accordion['toggled_text']) ? $accordion['toggled_text'] : '';
                $active_icon = !empty($accordion['active_icon']) ? $accordion['active_icon'] : $icon_active;
                $inactive_icon = !empty($accordion['inactive_icon']) ? $accordion['inactive_icon'] : $icon_inactive;


                $accordion_header = apply_filters( 'tabs_item_header', $accordion_header, $post_id );

                if(($accordion_is_active =='yes')){
                    $active_index[$index] = $item_count;
                }



                if(!in_array( 'tabs-pro/tabs-pro.php', (array) $active_plugins )){
                    if(has_shortcode($accordion_body, 'tabs_tabs') ||  has_shortcode($accordion_body, 'tabs_tabs_pplugins') ){
                        $accordion_body = str_replace('[tabs_tabs','**<a target="_blank" href="https://www.pickplugins.com/item/tabs-html-css3-responsive-accordion-grid-for-wordpress/?ref=wordpress.org"> <strong>Please buy pro to create nested tabs</strong></a>**', $accordion_body);
                        $accordion_body = str_replace('[tabs_tabs_pplugins','**<a target="_blank" href="https://www.pickplugins.com/item/tabs-html-css3-responsive-accordion-grid-for-wordpress/?ref=wordpress.org"> <strong>Please buy pro to create nested tabs</strong></a>**', $accordion_body);
                    }
                }



                $accordion_body = apply_filters( 'tabs_item_body', $accordion_body, $post_id );


                if($enable_autoembed =='yes'){
                    $WP_Embed = new WP_Embed();
                    $accordion_body = $WP_Embed->autoembed( $accordion_body);
                }

                if($enable_wpautop =='yes'){
                    $accordion_body = wpautop($accordion_body);
                }

                if($enable_shortcode =='yes'){
                    $accordion_body = do_shortcode($accordion_body);
                }


                ob_start();
                ?>
                <li post_id="<?php echo $post_id; ?>" header_id="header-<?php echo $index; ?>" id="header-<?php echo $index; ?>" style="" class="tabs-nav head<?php echo $index; ?> <?php echo $header_class; ?>" toggle-text="<?php echo do_shortcode(esc_attr($toggled_text)); ?>" main-text="<?php echo do_shortcode(esc_attr($accordion_header)); ?>">

                    <?php
                    if($icon_position == 'left'):
                        ?>

                    <a style="" class="tabs-tab-head" href="#tabs-<?php echo $index; ?>">
                        <span id="accordion-icons-<?php echo $index; ?>" class="accordion-icons">
                            <span class="accordion-icon-active accordion-plus"><?php echo $active_icon; ?></span>
                            <span class="accordion-icon-inactive accordion-minus"><?php echo $inactive_icon; ?></span>
                        </span>
                        <span id="header-text-<?php echo $index; ?>" class="tabs-head-title"><?php echo do_shortcode($accordion_header); ?></span>
                    </a>
                        <?php
                    elseif ($icon_position == 'right'):
                        ?>
                        <a style="" class="tabs-tab-head" href="#tabs-<?php echo $index; ?>">
                            <span id="header-text-<?php echo $index; ?>" class="tabs-head-title"><?php echo do_shortcode($accordion_header); ?></span>
                            <span id="accordion-icons-<?php echo $index; ?>" class="accordion-icons">
                                <span class="accordion-icon-active accordion-plus"><?php echo $active_icon; ?></span>
                                <span class="accordion-icon-inactive accordion-minus"><?php echo $inactive_icon; ?></span>
                            </span>
                        </a>

                    <?php
                    endif;
                    ?>


                </li>

                <?php
                $nav_html .= ob_get_clean();

                ob_start();
                ?>


                <div class="tabs-content tabs-content<?php echo $index; ?> <?php echo $body_class; ?>" id="tabs-<?php echo $index;?>">
                    <?php echo $accordion_body; ?>
                </div>

                <?php
                $nav_content_html .= ob_get_clean();

                $item_count++;
            }
        else:

            do_action('tabs_main_no_content', $post_id);
        endif;

        ?>

    <ul>
        <?php echo $nav_html; ?>
    </ul>
    <?php echo $nav_content_html; ?>
    <script>
        jQuery(document).ready(function($){
            <?php
            if(isset($_GET['active_index'])):
                $accordion_index = isset($_GET['active_index']) ? esc_attr($_GET['active_index']) : '';
                $accordion_index = explode('-', $accordion_index);
                foreach ($accordion_index as $args){
                    $args_arr = explode('|', $args);
                    $accordion_id = isset($args_arr[0]) ? $args_arr[0] : '';
                    $accordion_indexes = isset($args_arr[1]) ? $args_arr[1] : '';
                    ?>
                    tabs_tabs_active_index_<?php echo $accordion_id; ?> = <?php echo $accordion_indexes; ?>;
                    <?php
                }
                else:
                    ?>
                    tabs_tabs_active_index_<?php echo $post_id; ?> = <?php echo json_encode($active_index); ?>;
                    <?php
            endif;
            ?>
        })
    </script>
    <?php

}


add_action('tabs_main', 'tabs_main_edit_link');

function tabs_main_edit_link($atts){

    $post_id = isset($atts['id']) ? $atts['id'] : '';

    $tabs_options = get_post_meta($post_id, 'tabs_options', true);
    $tabs_options = !empty($tabs_options) ? $tabs_options : tabs_old_options($post_id);


    $hide_edit = isset($tabs_options['hide_edit']) ? $tabs_options['hide_edit'] : 'yes';




    if(current_user_can('administrator') && $hide_edit == 'no'){
        $admin_url = admin_url();
        $accordion_edit_url = apply_filters('tabs_edit_url', ''.$admin_url.'post.php?post='.$post_id.'&action=edit' );

        ?>
        <div class="accordion-edit"><a href="<?php echo $accordion_edit_url; ?>"><?php echo __('Edit this accordion','tabs'); ?></a>, <?php echo __("Only admin can see this.",'tabs')?></div>
        <?php

    }

}







add_action('tabs_main', 'tabs_main_scripts');

function tabs_main_scripts($atts){

    $post_id = isset($atts['id']) ? $atts['id'] : '';

    $tabs_options = get_post_meta($post_id,'tabs_options', true);
    $tabs_options = !empty($tabs_options) ? $tabs_options : tabs_old_options($post_id);

    $custom_scripts = isset($tabs_options['custom_scripts']) ? $tabs_options['custom_scripts'] : array();
    $custom_js = isset($custom_scripts['custom_js']) ? $custom_scripts['custom_js'] : '';

    $active_tab = isset($_GET['id']) ? (int)$_GET['id'] : 1;

    $tabs = isset($tabs_options['tabs']) ? $tabs_options['tabs'] : array();
    $collapsible = !empty($tabs['collapsible']) ? $tabs['collapsible'] : 'true';
    $active_event = !empty($tabs['active_event']) ? $tabs['active_event'] : 'click';
    $tabs_is_vertical = !empty($tabs['is_vertical']) ? $tabs['is_vertical'] : '';
    ?>
    <script>
        jQuery(document).ready(function($){
            <?php
            if($tabs_is_vertical=='yes'){
                 ?>
                $( "#tabs-<?php echo $post_id; ?>" ).addClass( "ui-tabs-vertical ui-helper-clearfix" );
                $( "#tabs-<?php echo $post_id; ?> li" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );
                <?php
            }
            ?>
            $("#tabs-<?php echo $post_id; ?>" ).tabs({
                collapsible: <?php echo $collapsible; ?>,
                event: "<?php echo $active_event; ?>",
                active: <?php echo $active_tab; ?>,
            });
            if(typeof tabs_tabs_active_index_<?php echo $post_id; ?> != 'undefined'){
                $("#tabs-<?php echo $post_id; ?>").tabs("option", "active", tabs_tabs_active_index_<?php echo $post_id; ?>);
            }
        })
    </script>
    <?php
    if(!empty($custom_js)):
        ?>
        <script>
            jQuery(document).ready(function($){
                <?php echo $custom_js; ?>
            })
        </script>
    <?php
    endif;
}


add_action('tabs_main_no_content', 'tabs_main_no_content');
function tabs_main_no_content(){

    ?>
    <p><?php echo __('Content missing',''); ?></p>
    <?php

}


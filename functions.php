<?php
add_filter( "mts_copyright_content", function($copyright_text){
    
    $copyright_text = 'Copyright &copy; ' .'<a style="color:rgba(255, 255, 255, 0.5);" href=" ' . esc_url( trailingslashit( home_url() ) ). '" title=" ' . get_bloginfo('description') . '">' . get_bloginfo('name') . ' </a> ' .' &nbsp'.  date("Y") . '.';

    return $copyright_text;
} );

//chèn bootstrap vào header để sử dụng
// get_stylesheet_directory_uri() trả về themes đang kích hoạt tức mts_video_child.
//  get_template_directory_uri() trả về template, tức theme mẹ mts_video
add_action( 'wp_head', function(){ 
    wp_register_style( 'bootstrap4', get_stylesheet_directory_uri() . '/css/bootstrap.css', 'all' );
    wp_enqueue_style( 'bootstrap4' );
  
} );


//thêm google font
add_action( 'wp_head', function(){ 
    wp_register_style( 'google_font_pacifico', 'https://fonts.googleapis.com/css?family=Pacifico', 'all' );
    wp_enqueue_style( 'google_font_pacifico' );
  
} );


//tùy chỉnh hiển thị chuyên mục Sự Kiện
if ( ! function_exists( 'mts_archive_post' ) ) {
    /**
     * Display a post of specific layout.
     * 
     * @param string $layout
     */
    function mts_archive_post( $layout = '' ) {
        $mts_options = get_option(MTS_THEME_NAME);
        $mts_youtube_select = get_post_meta( get_the_ID(), 'youtube-select', true );
        $mts_video_service = get_post_meta( get_the_ID(), 'video-service', true );
        ?>

        <header>
            <div class="home-thumb">
                <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" class="featured-thumbnail">
                   <?php the_post_thumbnail('video-featured',array('title' => ''));
                   if ( has_post_format('video') ) mts_watch_later_button();
                   if ( has_post_format('video') && $mts_youtube_select == 'video-id' && !in_array( $mts_video_service, array( 'vimeo', 'dailymotion', 'facebook' ) ) ) { ?>
                        <!-- <span class="duration"><?php //mts_video_duration(); ?></span> -->
                   <?php } ?>
                </a>
            </div>
            <h2 class="home-post-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
        </header>
        <div class="home-content">       
          
            <?php 
            // nếu trong chuyên mục việc làm thì không hiện nội dung ngắn của bài viết...
            if(in_category('viec-lam')){ ?>
	<?php  if( get_field('vieclam_congty')) { ?>
    <div class="row category_vieclam">
    <div class="col-sm-6" style="background-color:lavender;">
    <div><span class='fa fa-trophy'> <span class="category_vieclam_congty"> <?php the_field('vieclam_congty') ?> </span></span></div>
    <div><span class='fa fa-money'> <span class="category_vieclam_luong"> <?php the_field('vieclam_luong') ?> </span></span></div>
               
    </div>
    <div class="col-sm-6" style="background-color:lavender;">
    <div><span class='fa fa-map-marker'> <span class="category_vieclam_khuvuc"> <?php the_field('vieclam_khuvuc');  ?> </span></span></div>
    <div><span class='fa fa-clock-o'> <span class="category_vieclam_hannophoso"> <?php the_field('vieclam_hannophoso');  ?> </span></span></div>
     

    </div>
                        
    </div> <?php } ?>
               
             <?php
             } else{ if ( $mts_options['mts_home_sidebar'] != 'sidebar') {
                echo mts_excerpt(20);
            } else { 
                if(in_category('su-kien')){
                    echo mts_excerpt(15);
                }
                else{
                    echo mts_excerpt(30);
                }
               
            } } ?>
         
         <?php 
         //nếu trong chuyên mục sự kiện ...
         if(in_category('su-kien')){?>
         <?php if (get_field('sukien_thoigian')) {?>
            <div class="category_sukien">
                <span class='fa fa-clock-o'> <span class="category_sukien_thoigian"> <?php the_field('sukien_thoigian') ?> </span> &nbsp &nbsp &nbsp &nbsp &nbsp </span>
                <span class='fa fa-map-marker'> <span class="category_sukien_diadiem"> <?php the_field('sukien_diadiem') ?> </span></span>
       
            </div>     
            <?php } }?>   

            <?php 
         //nếu trong chuyên mục khóa học ...
         if(in_category('khoa-hoc')){?>
            <div class="category_khoahoc">
            <span class="khoahoc_hocmienphi"><a href="<?php the_permalink() ?>"> &nbsp Học miễn phí &nbsp </a></span>
     
       
            </div>     
            <?php }?>


            <?php 
         //nếu trong chuyên mục sản phẩm ...
         if(in_category('san-pham')){?>
            <div class="category_khoahoc">
            <span class="khoahoc_hocmienphi"><a href="<?php the_permalink() ?>"> &nbsp Xem sản phẩm &nbsp </a></span>
     
       
            </div>     
            <?php }?>

            <div class="views"><?php mts_video_views(); ?></div>
         
        </div>
    <?php
    }
}





function mts_single_post_popup() {

    global $mts_options;

    if ( is_singular( 'post' ) && isset( $mts_options['mts_show_share_popup'] ) ) {

        global $post;

        if ( '1' === $mts_options['mts_show_share_popup'] ) {

            echo '<div id="mts_video_share_popup">';

                echo '<div id="mts_video_share_popup_logo">';
                if ( !empty( $mts_options['mts_logo'] ) ) {
                    echo '<img src="'.esc_url( $mts_options['mts_logo'] ).'" />';
                } else {
                    echo get_bloginfo( 'name' );
                }
                echo '</div>';

                echo '<div id="mts_video_share_popup_title">';
                    _e('Video hữu ích thì chia sẻ ủng hộ Cộng đồng nhé?', 'video' );
                echo '</div>';

                if ( has_post_thumbnail( $post->ID ) ) {
                    echo '<div id="mts_video_share_popup_image">';
                        echo get_the_post_thumbnail( $post->ID , 'full' );
                    echo '</div>';
                    $img = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
                } else {
                    echo '<div id="mts_video_share_popup_image">';
                    $mts_video_service = get_post_meta( get_the_ID(), 'video-service', true );
                    switch ($mts_video_service) {
                        case 'vimeo':
                            $mts_vimeo_id = get_post_meta( get_the_ID(), 'vimeo-video-id', true );
                            if ( !empty($mts_vimeo_id) && mts_vimeo_video_thumb($mts_vimeo_id) ) {
                                echo '<img src="'.mts_vimeo_video_thumb($mts_vimeo_id).'" />';
                            }
                        break;
                        case 'dailymotion':
                            $mts_dm_id = get_post_meta( get_the_ID(), 'dm-video-id', true );
                            if ( !empty($mts_dm_id) && mts_dm_video_thumb($mts_dm_id) ) {
                                echo '<img src="'.mts_dm_video_thumb($mts_dm_id).'" />';
                            }
                        break;
                        case 'facebook':
                            $mts_facebook_id = get_post_meta( get_the_ID(), 'facebook-video-id', true );
                            if ( !empty($mts_facebook_id) && mts_facebook_video_thumb($mts_facebook_id) ) {
                                echo '<img src="'.mts_facebook_video_thumb($mts_facebook_id).'" />';
                            }
                        break;
                        default:
                            $mts_youtube_select = get_post_meta( get_the_ID(), 'youtube-select', true );
                            $mts_playlist_id = get_post_meta( get_the_ID(), 'playlist-id', true );
                            if ( $mts_youtube_select == 'video-id' && !empty($mts_playlist_id) ) {
                                echo '<img src="http://i.ytimg.com/vi/'.$mts_playlist_id.'/hqdefault.jpg" />';
                            }
                        break;
                    }
                    echo '</div>';
                }

                echo '<div id="mts_video_share_popup_buttons">';

                    echo '<div class="mts-video-share-button-wrap">';
                        echo '<a id="mts_video_share_popup_facebook_button" href="https://www.facebook.com/sharer.php?u='.urlencode( get_the_permalink( $post->ID ) ).'" target="_blank" title="'.__('Share on Facebook', 'video' ).'"><i class="fa fa-facebook"></i>'.__('Share', 'video' ).'</a>';
                    echo '</div>';

                    $via = '';
                    if( $mts_options['mts_twitter_username'] ) {
                        $via = '&via='. $mts_options['mts_twitter_username'];
                    }
                    echo '<div class="mts-video-share-button-wrap">';
                        echo '<a id="mts_video_share_popup_twitter_button" href="https://twitter.com/intent/tweet?original_referer='.urlencode(get_permalink()).'&text='.get_the_title().'&url='.urlencode(get_permalink()) . $via.'" target="_blank" title="'.__('Share on Twitter', 'video' ).'"><i class="fa fa-twitter"></i>'.__('Tweet', 'video' ).'</a>';
                    echo '</div>';

                echo '</div>';

                echo '<a href="#" class="b-close">'.__('Không, cám ơn.', 'video' ).'</a>';

            echo '</div>';
        }
    }
}
add_action( 'wp_footer', 'mts_single_post_popup' );

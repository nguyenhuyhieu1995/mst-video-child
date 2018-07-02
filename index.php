<?php
/**
 * The main template file.
 *
 * Used to display the homepage when home.php doesn't exist.
 */
?>
<?php $mts_options = get_option(MTS_THEME_NAME); ?>
<?php get_header(); ?>




<div id="page">
<!-- HIỆN THỊ KHÓA HỌC -->
<?php
 $mocgin = new WP_Query(array(
 'post_type'=>'post',
 'post_status'=>'publish',
 'cat' => 7, //7 là ID của chuyên mục khóa học
 'order' => 'DESC',
 'posts_per_page'=> 8
 ));
?>

<div class="row">
        <div class="khoa_hoc_tieu_de col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <b class="fa fa-briefcase"></b> <span>Khóa học</span>
        <!-- <a href="<?php  // echo get_category_link(7); ?>" title="Khóa Học">(Xem tất cả)</a> -->
        </div>       

<?php $i=1; while ($mocgin->have_posts()) : $mocgin->the_post(); ?>
        <div class="khoa_hoc col-md-3 col-centered">          
            <div class="thumbnail_khoa_hoc text-center">
                 <?php the_post_thumbnail("video-slider-small",array("alt" => get_the_title() )); ?>
                 <div class="thumbnail_khoa_hoc_nen"> </div>
           </div>            
           
            <div class="khoa_hoc_mo_ta">
              <a href="<?php the_permalink();?>"> <?php 
                if (strlen(get_the_title()) > 80){
                    echo substr(get_the_title(),0,80) . "...";
                }
                else{
                    echo get_the_title();
                }
              ?> 
              </a>                 
             <div class="khoa_hoc_hoc_mien_phi"><a href="<?php the_permalink();?>">Học miễn phí</a></div>
            </div>

        </div>
        <?php if ( $i % 4 === 0 ) { echo '</div><div class="row">'; } ?>
    <?php $i++; endwhile; wp_reset_query(); ?>
   
</div>
</div>




<div id="page">
<!-- HIỆN THỊ BÀI VIẾT -->
<?php
 $mocgin = new WP_Query(array(
 'post_type'=>'post',
 'post_status'=>'publish',
 'cat' => 1, //1 là ID của chuyên mục Bài viết
 'order' => 'DESC',
 'posts_per_page'=> 5
 ));
?>

        
<div class="bai_viet home-posts-wrap">
        <div class="khoa_hoc_tieu_de col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <b class="fa fa-pencil-square-o"></b> <span>Bài viết</span>
        </div>
        
        <div class="home-posts home-left <?php echo ($mts_options['mts_home_sidebar'] == 'sidebar') ? 'home-sidebar' : ''; ?>">
            <!-- <h2 class="home-title"><?php // _e('New Videos','video'); ?></h2> -->
            <?php $j = 0; while ($mocgin->have_posts()) : $mocgin->the_post();  ?>
                <article class="latestPost excerpt" id="post-<?php the_ID(); ?>">
                    <?php mts_archive_post(); ?>
                </article>
            <?php endwhile; ?>

           
        </div><!--.home-posts-left-->
        <?php if ( $mts_options['mts_home_sidebar'] != 'sidebar' ) { ?>
            <div class="home-posts home-right">
                <h2 class="home-title">
                    <?php if ($mts_options['mts_home_sidebar'] == 'popular') {
                        _e('Most Popular','video'); 
                        $query_params = array(
                            'meta_key' => '_mts_view_count',
                            'orderby' => 'meta_value_num',
                            'order' => 'DESC',
                            'ignore_sticky_posts' => '1'
                        );
                        if (!empty($mts_options['mts_popular_days'])) {
                            $popular_days = (int) $mts_options['mts_popular_days'];
                            $query_params['date_query'] = array(
                                array(
                                    'after'     => "$popular_days days ago",
                                    'inclusive' => true,
                                ),
                            ); 
                        }
                        $my_query = new WP_Query($query_params);
                    } elseif ($mts_options['mts_home_sidebar'] == 'random') {
                        _e('Random Posts','video');
                        $my_query = new WP_Query('orderby=rand&ignore_sticky_posts=1');
                    } ?>
                </h2>
                <?php while ($my_query->have_posts()) : $my_query->the_post(); 
                $mts_youtube_select = get_post_meta( get_the_ID(), 'youtube-select', true ); ?>
                    <article class="latestPost excerpt">
                        <div class="home-thumb">
                            <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" class="featured-thumbnail">
                               <?php the_post_thumbnail('video-featured',array('title' => ''));
                               if ( has_post_format('video') ) mts_watch_later_button();
                               if ( has_post_format('video') && $mts_youtube_select == 'video-id' ) { ?>
                                    <!-- <span class="duration"><?php // mts_video_duration(); ?></span> -->
                               <?php } ?>
                            </a>
                        </div>
                        <h2 class="home-post-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
                        <div class="home-content">
                            <?php echo mts_excerpt(14); ?>
                            <div class="views"><?php mts_video_views(); ?></div>
                        </div>
                    </article><!--.post excerpt-->
                    
                <?php endwhile; wp_reset_query(); ?>
            </div><!--.home-posts-right-->
        <?php } else { get_sidebar(); } ?>     
    </div><!--.home-posts-wrap-->
</div>    

<div id="page">
<!-- HIỆN THỊ SẢN PHẨM -->
<?php
 $mocgin = new WP_Query(array(
 'post_type'=>'post',
 'post_status'=>'publish',
 'cat' => 7, //7 là ID của chuyên mục sản phẩm
 'order' => 'DESC',
 'posts_per_page'=> 3
 ));
?>

<div class="row">
        
        <div class="khoa_hoc_tieu_de col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <b class="fa fa-shopping-cart"></b> <span>Sản phẩm</span>
        <!-- <a href="<?php // echo get_category_link(7); ?>" title="Khóa Học">(Xem tất cả)</a> -->
        </div>
        

<?php $i=1; while ($mocgin->have_posts()) : $mocgin->the_post(); ?>
        <div class="khoa_hoc col-md-4 col-centered">          
            <div class="thumbnail_khoa_hoc text-center">
                 <?php the_post_thumbnail("video-slider-small",array("alt" => get_the_title() )); ?>
                 <div class="thumbnail_khoa_hoc_nen"> </div>
           </div>            
           
            <div class="khoa_hoc_mo_ta">
              <a href="<?php the_permalink();?>">  <?php 
                        if (strlen(get_the_title()) > 80){
                            echo substr(get_the_title(),0,80) . "...";
                        }
                        else{
                            echo get_the_title();
                        }   ?> 
              </a>                 
             <div class="khoa_hoc_hoc_mien_phi"><a href="<?php the_permalink();?>">Xem sản phẩm</a></div>
            </div>

        </div>
        <?php if ( $i % 3 === 0 ) { echo '</div><div class="row">'; } ?>
    <?php $i++; endwhile; wp_reset_query(); ?>
   
</div>
</div>



<div id="page">
<!-- HIỆN THỊ SỰ KIỆN -->
<?php
 $mocgin = new WP_Query(array(
 'post_type'=>'post',
 'post_status'=>'publish',
 'cat' => 19, //21 là ID của chuyên mục Việc làm
 'order' => 'DESC',
 'posts_per_page'=> 2
 ));
?>


<div class="home-posts-wrap">
        <div class="khoa_hoc_tieu_de col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <b class="fa fa-calendar-o"></b> <span>Sự kiện</span>
        <!-- <a href="<?php // echo get_category_link(7); ?>" title="Khóa Học">(Xem tất cả)</a> -->
        </div>
        <div class="su_kien_posts home-posts home-left <?php echo ($mts_options['mts_home_sidebar'] == 'sidebar') ? 'home-sidebar' : ''; ?>">
            <!-- <h2 class="home-title"><?php // _e('New Videos','video'); ?></h2> -->
            <?php $j = 0; while ($mocgin->have_posts()) : $mocgin->the_post();  ?>
                <article class="latestPost excerpt" id="post-<?php the_ID(); ?>">
                    <?php mts_archive_post(); ?>
                </article>
            <?php endwhile; ?>

           
        </div><!--.home-posts-left-->
        <?php if ( $mts_options['mts_home_sidebar'] != 'sidebar' ) { ?>
            <div class="home-posts home-right">
                <h2 class="home-title">
                    <?php if ($mts_options['mts_home_sidebar'] == 'popular') {
                        _e('Most Popular','video'); 
                        $query_params = array(
                            'meta_key' => '_mts_view_count',
                            'orderby' => 'meta_value_num',
                            'order' => 'DESC',
                            'ignore_sticky_posts' => '1'
                        );
                        if (!empty($mts_options['mts_popular_days'])) {
                            $popular_days = (int) $mts_options['mts_popular_days'];
                            $query_params['date_query'] = array(
                                array(
                                    'after'     => "$popular_days days ago",
                                    'inclusive' => true,
                                ),
                            ); 
                        }
                        $my_query = new WP_Query($query_params);
                    } elseif ($mts_options['mts_home_sidebar'] == 'random') {
                        _e('Random Posts','video');
                        $my_query = new WP_Query('orderby=rand&ignore_sticky_posts=1');
                    } ?>
                </h2>
                <?php while ($my_query->have_posts()) : $my_query->the_post(); 
                $mts_youtube_select = get_post_meta( get_the_ID(), 'youtube-select', true ); ?>
                    <article class="latestPost excerpt">
                        <div class="home-thumb">
                            <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" class="featured-thumbnail">
                               <?php the_post_thumbnail('video-featured',array('title' => ''));
                               if ( has_post_format('video') ) mts_watch_later_button();
                               if ( has_post_format('video') && $mts_youtube_select == 'video-id' ) { ?>
                                    <!-- <span class="duration"><?php // mts_video_duration(); ?></span> -->
                               <?php } ?>
                            </a>
                        </div>
                        <h2 class="home-post-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
                        <div class="home-content">
                            <?php echo mts_excerpt(14); ?>
                            <div class="views"><?php mts_video_views(); ?></div>
                        </div>
                    </article><!--.post excerpt-->
                    
                <?php endwhile; wp_reset_query(); ?>
            </div><!--.home-posts-right-->
        <?php } else {  //get_sidebar();
            echo "<div class='su_kien_quang_cao'> <img src='http://localhost/reactnative/wp-content/themes/mts_video/images/300x250.png'/> </div>";
         } ?>
    </div><!--.home-posts-wrap-->
</div>





<div id="page">
<!-- HIỆN THỊ VIỆC LÀM -->
<?php
 $mocgin = new WP_Query(array(
 'post_type'=>'post',
 'post_status'=>'publish',
 'cat' => 21, //21 là ID của chuyên mục Việc làm
 'order' => 'DESC',
 'posts_per_page'=> 2
 ));
?>


<div class="home-posts-wrap">
        <div class="khoa_hoc_tieu_de col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <b class="fa fa-users"></b> <span>Việc làm</span>
        <!-- <a href="<?php // echo get_category_link(7); ?>" title="Khóa Học">(Xem tất cả)</a> -->
        </div>
        <div class="viec_lam_posts home-posts home-left <?php echo ($mts_options['mts_home_sidebar'] == 'sidebar') ? 'home-sidebar' : ''; ?>">
            <!-- <h2 class="home-title"><?php // _e('New Videos','video'); ?></h2> -->
            <?php $j = 0; while ($mocgin->have_posts()) : $mocgin->the_post();  ?>
                <article class="latestPost excerpt" id="post-<?php the_ID(); ?>">
                    <?php mts_archive_post(); ?>
                </article>
            <?php endwhile; ?>

           
        </div><!--.home-posts-left-->
        <?php if ( $mts_options['mts_home_sidebar'] != 'sidebar' ) { ?>
            <div class="home-posts home-right">
                <h2 class="home-title">
                    <?php if ($mts_options['mts_home_sidebar'] == 'popular') {
                        _e('Most Popular','video'); 
                        $query_params = array(
                            'meta_key' => '_mts_view_count',
                            'orderby' => 'meta_value_num',
                            'order' => 'DESC',
                            'ignore_sticky_posts' => '1'
                        );
                        if (!empty($mts_options['mts_popular_days'])) {
                            $popular_days = (int) $mts_options['mts_popular_days'];
                            $query_params['date_query'] = array(
                                array(
                                    'after'     => "$popular_days days ago",
                                    'inclusive' => true,
                                ),
                            ); 
                        }
                        $my_query = new WP_Query($query_params);
                    } elseif ($mts_options['mts_home_sidebar'] == 'random') {
                        _e('Random Posts','video');
                        $my_query = new WP_Query('orderby=rand&ignore_sticky_posts=1');
                    } ?>
                </h2>
                <?php while ($my_query->have_posts()) : $my_query->the_post(); 
                $mts_youtube_select = get_post_meta( get_the_ID(), 'youtube-select', true ); ?>
                    <article class="latestPost excerpt">
                        <div class="home-thumb">
                            <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" class="featured-thumbnail">
                               <?php the_post_thumbnail('video-featured',array('title' => ''));
                               if ( has_post_format('video') ) mts_watch_later_button();
                               if ( has_post_format('video') && $mts_youtube_select == 'video-id' ) { ?>
                                    <!-- <span class="duration"><?php // mts_video_duration(); ?></span> -->
                               <?php } ?>
                            </a>
                        </div>
                        <h2 class="home-post-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
                        <div class="home-content">
                            <?php echo mts_excerpt(14); ?>
                            <div class="views"><?php mts_video_views(); ?></div>
                        </div>
                    </article><!--.post excerpt-->
                    
                <?php endwhile; wp_reset_query(); ?>
            </div><!--.home-posts-right-->
        <?php } else { //get_sidebar();
                        echo "<div class='su_kien_quang_cao'> <img src='http://localhost/reactnative/wp-content/themes/mts_video/images/300x250.png'/> </div>";
        } ?>
    </div><!--.home-posts-wrap-->
</div>




<?php get_footer(); ?>
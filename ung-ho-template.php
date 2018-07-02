<?php
/**
 * Template Name: Ung_Ho_Template
 * The template for displaying the page with a slug of `contact`.
 */
?>
<?php $mts_options = get_option(MTS_THEME_NAME); ?>
<?php get_header(); ?>
<div id="page" class="<?php mts_single_page_class(); ?>">
	<?php if ($mts_options['mts_breadcrumb'] == '1') { ?>
		<div class="breadcrumb" xmlns:v="http://rdf.data-vocabulary.org/#"><?php mts_the_breadcrumb(); ?></div>
	<?php } ?>
	<article class="<?php mts_article_class(); ?>">
		<div id="content_box" >
			<div class="single_page">
				<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
					<div id="post-<?php the_ID(); ?>" <?php post_class('g post'); ?>>
						<header>
							<h1 class="title entry-title"><?php the_title(); ?></h1>
						</header>
						<div class="post-content box mark-links entry-content">
                            <!-- hiện nội dung của trang -->
                            <p>Hỗ trợ mình - Hiệu, tiền cà phê giúp mình có thêm động lực, kinh 
phí để duy trì webiste và xây dựng thêm nhiều khóa học miễn phí hơn nữa. </p>
                                            <p> P/s: Mình hay ra quán cà phê làm việc ^__^ </p>
											<p> Bạn ủng hộ xong nhớ <a href="<?php echo get_bloginfo('url').'/lien-he';?>">liên hệ</a> mình, để mình cám ơn nhé :D </p>
											<p> Xin chân thành cám ơn. </p>
                            <div class="row">                               
                               
                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                            <h2>Chuyển khoản ngân hàng</h2>                                      
                                           
                                            <img style="width: 75%" height="75%" src="<?php echo get_stylesheet_directory_uri().'/images/tai_khoan_ngan_hang_acb.png'; ?>" alt="chuyển khoản qua ngân hàng acb"/>
                                            </br> 
											</br>
                                            <img style="width: 75%" height="75%" src="<?php echo get_stylesheet_directory_uri().'/images/tai_khoan_ngan_hang_vcb.png'; ?>" alt="chuyển khoản qua ngân hàng acb"/>
                                            </br>

                                </div>

                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                <?php the_content(); ?>
                                </div>
                                
                            </div> <!-- đóng nội dung của trang -->                          
                                              		
							<?php wp_link_pages(array('before' => '<div class="pagination">', 'after' => '</div>', 'link_before'  => '<span class="current"><span class="currenttext">', 'link_after' => '</span></span>', 'next_or_number' => 'next_and_number', 'nextpagelink' => __('Next', 'video' ), 'previouspagelink' => __('Previous', 'video' ), 'pagelink' => '%','echo' => 1 )); ?>
						</div><!--.post-content box mark-links-->
					</div>
					<?php comments_template( '', true ); ?>
				<?php endwhile; ?>
			</div>
			<?php get_sidebar(); ?>
		</div>
	</article>
<?php get_footer(); ?>
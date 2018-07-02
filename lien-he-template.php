<?php
/**
 * Template Name: Lien_He_Template
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
                            <div class="row">
                                
                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                <?php the_content(); ?>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                            <p> Nếu bạn có bất cứ thông tin cần liên hệ cần được hỗ trợ, xin vui lòng email địa chỉ: <b>contact@nguyenhuyhieu.com</b> hoặc gửi nhanh ở form bên trái. </p>
                                            <p> Bạn cũng có thể liên hệ qua Facebook hoặc Skype: </p>  
                                            <div class="row">
                                                
                                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                                <p class="fa fa-facebook-official" style="font-size: 35px"></p>        
                                                <a href="https://www.facebook.com/nguyenhuyhieu1995">nguyenhuyhieu1995</a>
                                                </div>
                                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                                <p class="fa fa-skype" style="font-size: 35px"></p> 
                                                <a href="skype:hieumediavn?chat">hieumediavn</a>
                                                </div>
                                                
                                            </div>
                                            <p>Xin chân thành cám ơn. </p>
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
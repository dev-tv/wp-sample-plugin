<?php
/*
*sample code to take product list by category
* sample code to take single product deatils
*   URL: http://example.com/webservices/product.php?action=catproduct&catid=15
*   URL: http://example.com/webservices/product.php?action=product&productid=110
*
*
*/
require_once(dirname(__FILE__) .'/../wp-load.php');
global $wpdb, $product;
$arr = array();
if(isset($_REQUEST['action'])){
	if(strlen($_REQUEST['action']) != 0 ){
		$action = $_REQUEST['action'];
                if($action == 'catproduct'){
			  if(isset($_REQUEST['catid'])){
				  if(strlen($_REQUEST['catid']) == 0){
					  $arr['result'] = 0;
					  $arr['msg']= 'Category ID is Empty';
				  } else {		  
					  $args = array(
						  'post_type'   => 'product',
						  'posts_per_page'   => -1,
						  'tax_query' => array(
								array(
									'taxonomy' => 'product_cat',
									'field' => 'term_id',
									'terms' => $_REQUEST['catid']
								)
							)
						);
						query_posts($args);
				  }
			  }
		} else if($action == 'product'){
                     if(isset($_REQUEST['productid'])){
                          if(strlen($_REQUEST['productid']) == 0){
					  $arr['result'] = 0;
					  $arr['msg']= 'Product ID is Empty';
				  } else {		  
					  $args = array(
						  'post_type'   => 'product',
						  'posts_per_page'   => -1,
                                                  'p' => $_REQUEST['productid']
					  );
					  query_posts($args);
				  }
                     }   
                }

                 


		if(have_posts()){		
		$arr['result'] = 1;
		$i = 0;
		while(have_posts()): the_post();
			$product_cat_name = array();
			$product_gallery_img = array();
			
			// Featured image
			$feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
			
			// Category
			$terms = get_the_terms( $post->ID, 'product_cat' );
			foreach ($terms  as $term  ) {
				array_push($product_cat_name,$term->name);
			}
			$product_cat_name = implode(", ",$product_cat_name);	
			
			// Gallery
			$attachment_ids = $product->get_gallery_attachment_ids();
                         foreach( $attachment_ids as $attachment_id ){
				array_push($product_gallery_img, wp_get_attachment_url( $attachment_id ));
                         } 
			//$product_gallery_img = implode(", ",$product_gallery_img);

			$arr['data'][$i]['product_id'] = $post->ID;
			$arr['data'][$i]['title'] = get_the_title();
			$arr['data'][$i]['content'] = get_the_content();
			$arr['data'][$i]['img'] = $feat_image;
			$arr['data'][$i]['reg_price'] = get_post_meta( $post->ID, '_regular_price', true);
			$arr['data'][$i]['sale_price'] = get_post_meta( $post->ID, '_sale_price', true);
			$arr['data'][$i]['category'] = $product_cat_name;
			$arr['data'][$i]['Gallery'] = $product_gallery_img;
			$arr['data'][$i]['stock'] = get_post_meta( $post->ID, '_stock', true);			
			$i++;
        endwhile; wp_reset_query();
                } else {
			$arr['result'] = 0;
			$arr['msg'] = 'Product Not Found';
		}
	} else {
	   	$arr['result'] = 0;
		$arr['msg'] = 'Active invalid';
	}
	
} else {
   	$arr['result'] = 0;
	$arr['msg'] = 'Key Invalid';
}
echo json_encode($arr);
?>
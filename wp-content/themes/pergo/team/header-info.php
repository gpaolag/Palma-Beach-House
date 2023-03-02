   
<?php
$member_info = get_post_meta( get_the_ID(), 'member_info', true );
if( !empty($member_info) ):
  ?>
  <ul class="contact-info blog-category-list clearfix m-bottom-20">
    <?php 
    foreach ($member_info as $key => $value) {
      $linkable = isset($value['linkable'])? $value['linkable'] : 'on';
      $link = isset($value['link'])? esc_attr($value['link']) : '#';
      if( $linkable == 'on' ){
         echo '<li><a href="'.$link.'" target="_blank" title="'.esc_attr($value['title']).'"><i class="fa '.esc_attr($value['icon_desc']['icon']).'"></i><span>'.esc_attr($value['icon_desc']['input']).'</span></a></li>';
       }else{
          echo '<li><i class="fa '.esc_attr($value['icon_desc']['icon']).'"></i><span>'.esc_attr($value['icon_desc']['input']).'</span></li>';
       }
     
    }
    ?>
    </li>
  </ul>
<?php endif; ?>
<?php
$social_links = get_post_meta( get_the_ID(), 'social_links', true );
$social_links_display = get_post_meta( get_the_ID(), 'member_social_links_display', true );
if( !empty($social_links) && ($social_links_display != 'off') ):
  ?>
  <div class="tm-social m-bottom-50">
  <ul class="clearfix">
    <?php 
    foreach ($social_links as $key => $value) {      
      echo '<li class="p-right-5"><a class="ico-'.esc_attr(strtolower($value['title'])).' text-center" target="_blank" href="'.esc_url($value['icon_link']['input']).'" title="'.esc_attr($value['title']).'"><i class="fab '.esc_attr($value['icon_link']['icon']).'"></i></a></li>';
    }
    ?>
  </ul></div>
<?php endif; ?>
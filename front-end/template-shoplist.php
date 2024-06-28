<?php
/*
 * Template Name: Shoplist
**/
get_header();?>

<style type="text/css">
    
    #shoplist .entry{
        justify-content: space-between;
    }

    #shoplist .det-area .maplink{
        padding: 0px !important;
    }

    #shoplist .map-area{
        width: 200px;
        height: 150px;
    }

    #shoplist .map-area iframe{
        width: 100%;
        height: 100%;
    }

    @media (max-width: 767px){
    
        #shoplist .map-area{
            width: 100%;
            height: 200px;
        }

        #shoplist .map-area iframe{
            width: 100%;
            height: 100%;
        }
    }

</style>

<main id="shoplist" class="parts pages">
     <?php get_template_part('template-parts/static-header'); ?>
     <div class="hero hero-white" id="page-hero">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/mv/shoplist.PNG" class="centerized">
            <div class="txt-hldr centerized">
                <h3 class="heading-2">SHOP LIST</h3>
                <p>商品取扱い店舗一覧<br>※店舗によって取扱い開始時期が異なります。ご了承の程、宜しくお願い致します。</p>
            </div>
        </div>
        <section class="s1 bg-white">
            <div class="inner-fullsize">
                <div class="content-box">
                    <ul class="flex regional-list">
                        <li><a href="javascript:void(0);" onClick="updateRegion(this); return false;" data-pref="1">北海道・東北</a></li>
                        <li><a href="javascript:void(0);" onClick="updateRegion(this); return false;" data-pref="2">関東</a></li>
                        <li><a href="javascript:void(0);" onClick="updateRegion(this); return false;" data-pref="3">中部</a></li>
                        <li><a href="javascript:void(0);" onClick="updateRegion(this); return false;" data-pref="4">近畿</a></li>
                        <li><a href="javascript:void(0);" onClick="updateRegion(this); return false;" data-pref="5">中国・四国</a></li>
                        <li><a href="javascript:void(0);" onClick="updateRegion(this); return false;" data-pref="6">九州・沖縄</a></li>
                        <li><a href="javascript:void(0);" onClick="updateRegion(this); return false;" data-pref="7">ONLINE SHOP</a></li>
                    </ul>
                    <div class="prefectures">
                        <div id="pref1" class="prefecture-hldr current">
                            <ul class="prefectural-list flex">
                                <li><a href="javascript:void(0);"  onClick="getPrefecturalList(this); return false;" data-pref="北海道">北海道</a></li>
                                <li><a href="javascript:void(0);"  onClick="getPrefecturalList(this); return false;" data-pref="青森県">青森県</a></li>
                                <li><a href="javascript:void(0);"  onClick="getPrefecturalList(this); return false;" data-pref="岩手県">岩手県</a></li>
                                <li><a href="javascript:void(0);"  onClick="getPrefecturalList(this); return false;" data-pref="宮城県">宮城県</a></li>
                                <li><a href="javascript:void(0);"  onClick="getPrefecturalList(this); return false;" data-pref="秋田県">秋田県</a></li>
                                <li><a href="javascript:void(0);"  onClick="getPrefecturalList(this); return false;" data-pref="山形県">山形県</a></li>
                                <li><a href="javascript:void(0);"  onClick="getPrefecturalList(this); return false;" data-pref="福島県">福島県</a></li>
                            </ul>
                        </div>
                        <div id="pref2" class="prefecture-hldr">
                            <ul class="prefectural-list flex">
                                <li><a href="javascript:void(0);"  onClick="getPrefecturalList(this); return false;" data-pref="茨城県">茨城県</a></li>
                                <li><a href="javascript:void(0);"  onClick="getPrefecturalList(this); return false;" data-pref="栃木県">栃木県</a></li>
                                <li><a href="javascript:void(0);"  onClick="getPrefecturalList(this); return false;" data-pref="群馬県">群馬県</a></li>
                                <li><a href="javascript:void(0);"  onClick="getPrefecturalList(this); return false;" data-pref="埼玉県">埼玉県</a></li>
                                <li><a href="javascript:void(0);"  onClick="getPrefecturalList(this); return false;" data-pref="千葉県">千葉県</a></li>
                                <li><a href="javascript:void(0);"  onClick="getPrefecturalList(this); return false;" data-pref="東京都">東京都</a></li>
                                <li><a href="javascript:void(0);"  onClick="getPrefecturalList(this); return false;" data-pref="神奈川県">神奈川県</a></li>
                            </ul>
                        </div>
                        <div id="pref3" class="prefecture-hldr">
                            <ul class="prefectural-list flex">
                                <li><a href="javascript:void(0);"  onClick="getPrefecturalList(this); return false;" data-pref="新潟県">新潟県</a></li>
                                <li><a href="javascript:void(0);"  onClick="getPrefecturalList(this); return false;" data-pref="富山県">富山県</a></li>
                                <li><a href="javascript:void(0);"  onClick="getPrefecturalList(this); return false;" data-pref="石川県">石川県</a></li>
                                <li><a href="javascript:void(0);"  onClick="getPrefecturalList(this); return false;" data-pref="福井県">福井県</a></li>
                                <li><a href="javascript:void(0);"  onClick="getPrefecturalList(this); return false;" data-pref="山梨県">山梨県</a></li>
                                <li><a href="javascript:void(0);"  onClick="getPrefecturalList(this); return false;" data-pref="長野県">長野県</a></li>
                                <li><a href="javascript:void(0);"  onClick="getPrefecturalList(this); return false;" data-pref="岐阜県">岐阜県</a></li>
                                <li><a href="javascript:void(0);"  onClick="getPrefecturalList(this); return false;" data-pref="愛知県">愛知県</a></li>
                                <li><a href="javascript:void(0);"  onClick="getPrefecturalList(this); return false;" data-pref="静岡県">静岡県</a></li>
                            </ul>
                        </div>
                        <div id="pref4" class="prefecture-hldr">
                            <ul class="prefectural-list flex">
                                <li><a href="javascript:void(0);"  onClick="getPrefecturalList(this); return false;" data-pref="三重県">三重県</a></li>
                                <li><a href="javascript:void(0);"  onClick="getPrefecturalList(this); return false;" data-pref="滋賀県">滋賀県</a></li>
                                <li><a href="javascript:void(0);"  onClick="getPrefecturalList(this); return false;" data-pref="京都府">京都府</a></li>
                                <li><a href="javascript:void(0);"  onClick="getPrefecturalList(this); return false;" data-pref="大阪府">大阪府</a></li>
                                <li><a href="javascript:void(0);"  onClick="getPrefecturalList(this); return false;" data-pref="兵庫県">兵庫県</a></li>
                                <li><a href="javascript:void(0);"  onClick="getPrefecturalList(this); return false;" data-pref="奈良県">奈良県</a></li>
                                <li><a href="javascript:void(0);"  onClick="getPrefecturalList(this); return false;" data-pref="和歌山県">和歌山県</a></li>
                            </ul>
                        </div>
                        <div id="pref5" class="prefecture-hldr">
                            <ul class="prefectural-list flex">
                                <li><a href="javascript:void(0);"  onClick="getPrefecturalList(this); return false;" data-pref="鳥取県">鳥取県</a></li>
                                <li><a href="javascript:void(0);"  onClick="getPrefecturalList(this); return false;" data-pref="島根県">島根県</a></li>
                                <li><a href="javascript:void(0);"  onClick="getPrefecturalList(this); return false;" data-pref="岡山県">岡山県</a></li>
                                <li><a href="javascript:void(0);"  onClick="getPrefecturalList(this); return false;" data-pref="広島県">広島県</a></li>
                                <li><a href="javascript:void(0);"  onClick="getPrefecturalList(this); return false;" data-pref="山口県">山口県</a></li>
                                <li><a href="javascript:void(0);"  onClick="getPrefecturalList(this); return false;" data-pref="徳島県">徳島県</a></li>
                                <li><a href="javascript:void(0);"  onClick="getPrefecturalList(this); return false;" data-pref="香川県">香川県</a></li>
                                <li><a href="javascript:void(0);"  onClick="getPrefecturalList(this); return false;" data-pref="愛媛県">愛媛県</a></li>
                                <li><a href="javascript:void(0);"  onClick="getPrefecturalList(this); return false;" data-pref="高知県">高知県</a></li>
                            </ul>
                        </div>
                        <div id="pref6" class="prefecture-hldr">
                            <ul class="prefectural-list flex">
                                <li><a href="javascript:void(0);"  onClick="getPrefecturalList(this); return false;" data-pref="福岡県">福岡県</a></li>
                                <li><a href="javascript:void(0);"  onClick="getPrefecturalList(this); return false;" data-pref="佐賀県">佐賀県</a></li>
                                <li><a href="javascript:void(0);"  onClick="getPrefecturalList(this); return false;" data-pref="長崎県">長崎県</a></li>
                                <li><a href="javascript:void(0);"  onClick="getPrefecturalList(this); return false;" data-pref="熊本県">熊本県</a></li>
                                <li><a href="javascript:void(0);"  onClick="getPrefecturalList(this); return false;" data-pref="大分県">大分県</a></li>
                                <li><a href="javascript:void(0);"  onClick="getPrefecturalList(this); return false;" data-pref="宮崎県">宮崎県</a></li>
                                <li><a href="javascript:void(0);"  onClick="getPrefecturalList(this); return false;" data-pref="鹿児島県">鹿児島県</a></li>
                                <li><a href="javascript:void(0);"  onClick="getPrefecturalList(this); return false;" data-pref="沖縄">沖縄</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="result-box">
                        <?php for($i = 1; $i < 8; $i++){ ?>
                        <div class="shop-list" data-id="pref<?php echo $i; ?>">
                            <?php 

                              $args = array(

                                'post_type' => 'shops_post',
                                'orderby' => 'modifieddate',
                                'order' => 'DESC',
                                'posts_per_page' => -1,
                                'meta_key'      => 'region',
                                'meta_value'    => 'pref'.$i,
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'shops_category',
                                        'field'    => 'slug',
                                        'terms'    => 'kasco-shop',
                                    ),
                                ),
                              );

                              $catquery = new WP_Query( $args ); 

                              $temp_query = $wp_query;
                              $wp_query   = NULL;
                              $wp_query   = $catquery;

                              if ( $catquery->have_posts()) : 

                              ?>
                            <div class="chapter">
                                  <?php while($catquery->have_posts()) : $catquery->the_post(); ?>

                                    <div class="entry firstChild flex">
                                        <div class="det-area">
                                            <?php if(get_field('shop-url') != ""){ ?>
                                            <a target="_blank" href="<?php echo get_field('shop-url'); ?>" style="padding-left:0px; color:#c30000;"><p class="name firstChild"><?php echo get_the_title(); ?></p></a>
                                            <?php }else{ ?>
                                                <p class="name firstChild"><?php echo get_the_title(); ?></p>
                                            <?php } ?>
                                            <?php if($i < 7){ ?>
                                            <?php 

                                            //for address param
                                            $url = urlencode_deep(get_field('store-address'));
                                            $param = $url;

                                            ?>
                                            <a class="maplink" target="_blank" href="http://maps.google.com/maps?q=<?php echo $param; ?>&output=classic"><i class="fas fa-map-marker-alt"></i> <?php echo get_field('store-address'); ?></a>
                                            <?php }else{ ?>
                                            <a class="maplink" target="_blank" href="<?php echo get_field('store-address'); ?>"><?php echo get_field('store-address'); ?></a>
                                            <?php } ?>
                                            <p><?php echo get_field('store-tel'); ?></p>
                                                <?php
                                                $products = get_field('store-products');
                                                if( !empty($products) ): ?>
                                                <dl class="item lastChild"><dt class="firstChild">■取り扱い商品</dt>
                                                <?php foreach( $products as $product ): ?>
                                                    <dd class="<?php echo $product; ?>">
                                                        <?php 

                                                        switch ($product) {
                                                            case 'club':
                                                                echo 'クラブ';
                                                                break;
                                                            case 'ball':
                                                                echo 'ボール';
                                                                break;
                                                            case 'glove':
                                                                echo 'グローブ';
                                                                break;
                                                            default:
                                                                // code...
                                                                break;
                                                        }

                                                        ?>
                                                    </dd>
                                                <?php endforeach; ?>
                                            </dl>
                                            <?php endif; ?>
                                        </div>
                                        <?php if(get_field('shop-map') != ''){ ?>
                                        <div class="map-area">
                                            <?php echo get_field('shop-map'); ?>
                                        </div>
                                        <?php } ?>
                                    </div>

                                 <?php endwhile; ?>
                            </div>
                             <?php endif; ?>
                        </div>
                         <?php } ?>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script type="text/javascript">


        function getRegionList(prefid){
            $('.shop-list').each(function(){
                $(this).removeClass('.current')
                $(this).hide();
            });
            $('.shop-list[data-id='+prefid+']').addClass('current');
            $('.shop-list[data-id='+prefid+']').fadeIn('slow');
            $('.shop-list[data-id='+prefid+'] .entry').each(function(){
                $(this).show();
            });
            console.log($('.shop-list[data-id='+prefid+']'));
        }


        //triggered when prefecture is clicked
        function getPrefecturalList(elem){

            $('.prefectural-list li a').each(function(){
                $(this).removeClass('current');
            });

            $(elem).addClass('current');

            var pref = $(elem).data('pref');


            $('.shop-list.current .entry').each(function(){
                if($(this).find('a:contains("'+pref+'")').length > 0)
                {
                    $(this).show();
                }
                else
                {
                    $(this).hide();
                }
            });
        }



        //triggered when region is clicked
        function updateRegion(elem){

            var prefid = 'pref'+$(elem).data('pref');

            $('.regional-list li a').each(function(){
                $(this).removeClass('current');
            });

            $(elem).addClass('current');

            $('.prefectural-list li a').each(function(){
                $(this).removeClass('current');
            });

            showPrefectures(prefid);
            getRegionList(prefid);
        }

        function showPrefectures(prefid){

            $('.prefecture-hldr').each(function(){
                $(this).hide();
            });

            $('#'+prefid).addClass('current');
            
            $('#'+prefid).show();
            
        }
    </script>


<?php
get_footer();
?>
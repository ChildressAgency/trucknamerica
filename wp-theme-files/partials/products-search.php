<section id="product-search">
  <div class="container">
    <form role="search" method="get" class="form-inline woocommerce-product-search" action="<?php echo esc_url(home_url('/')); ?>">
      <label for="search-products" class="search-bar-label"><span>FIND</span>A PRODUCT</label>
      <div class="input-group">
        <input type="hidden" name="post_type" value="product" />
        <input type="search" name="s" id="search-products" class="search-field" placeholder="Search for..." />
        <div class="input-group-append">
          <button type="submit" id="button-search" class="btn-search" aria-label="Search">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon-search.png" class="" alt="" />
          </button>
        </div>
      </div>
    </form>
  </div>
</section>
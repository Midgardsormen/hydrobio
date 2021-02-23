{**
 * Copyright since 2007 PrestaShop SA and Contributors
 * PrestaShop is an International Registered Trademark & Property of PrestaShop SA
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License 3.0 (AFL-3.0)
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to https://devdocs.prestashop.com/ for more information.
 *
 * @author    PrestaShop SA and Contributors <contact@prestashop.com>
 * @copyright Since 2007 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License 3.0 (AFL-3.0)
 *}
{block name='product_miniature_item'}
<div class="product-miniature-item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
  {if isset($position)}<meta itemprop="position" content="{$position}" />{/if}
  <article class="product-miniature js-product-miniature" data-id-product="{$product.id_product}" data-id-product-attribute="{$product.id_product_attribute}" itemprop="item" itemscope itemtype="http://schema.org/Product">
    <div class="thumbnail-container">
      {block name='product_thumbnail'}
        {if $product.cover}
          <a href="{$product.url}" class="thumbnail product-thumbnail">
            <img
              src="{$product.cover.bySize.home_default.url}"
              alt="{if !empty($product.cover.legend)}{$product.cover.legend}{else}{$product.name|truncate:30:'...'}{/if}"
              data-full-size-image-url="{$product.cover.large.url}"
              />
          </a>
        {else}
          <a href="{$product.url}" class="thumbnail product-thumbnail">
            <img src="{$urls.no_picture_image.bySize.home_default.url}" />
          </a>
        {/if}
      {/block}

      <div class="product-description">
        {block name='product_name'}
          {if $page.page_name == 'index'}
            <h3 class="h3 product-title" itemprop="name"><a href="{$product.url}" itemprop="url" content="{$product.url}">{$product.name|truncate:30:'...'}</a></h3>
          {else}
            <h2 class="h3 product-title" itemprop="name"><a href="{$product.url}" itemprop="url" content="{$product.url}">{$product.name|truncate:30:'...'}</a></h2>
          {/if}
        {/block}


        {/block}

        {block name='product_reviews'}
          {hook h='displayProductListReviews' product=$product}
        {/block}
      </div>


      {if $product.main_variants}
        <div class="highlighted-informations{if !$product.main_variants} no-variants{/if} hidden-sm-down">
          {* {block name='quick_view'}
            <a class="quick-view" href="#" data-link-action="quickview">
              <i class="material-icons search">&#xE8B6;</i> {l s='Quick view' d='Shop.Theme.Actions'}
            </a>
          {/block} *}

          {block name='product_variants'}
          
              {include file='catalog/_partials/variant-links.tpl' variants=$product.main_variants}

          {/block}
        </div> 
      {/if}
      <div class="price_section">
          {block name='product_price_and_shipping'}
          {if $product.show_price}
            <div class="product-price-and-shipping {if $product.has_discount}product-price-and-shipping--discount {/if}">
              {hook h='displayProductPriceBlock' product=$product type="before_price"}

              {assign var="splittedPrice" value=","|explode:$product.price}
              {assign var="priceBeforeComa" value=$splittedPrice[0]}
              {assign var="splittedPriceafterComa" value=$splittedPrice[1]|substr:0:2}
              {assign var="priceAfterComa" value=$splittedPriceafterComa}

              <span class="price" aria-label="{l s='Price' d='Shop.Theme.Catalog'}">{$priceBeforeComa}<span class="afterComaPrice"><span class="euro">€</span>{$priceAfterComa}</span></span>
              <div itemprop="offers" itemscope itemtype="http://schema.org/Offer" class="invisible">
                <meta itemprop="priceCurrency" content="{$currency.iso_code}" />
                <meta itemprop="price" content="{$product.price_amount}" />
              </div>

              {hook h='displayProductPriceBlock' product=$product type='unit_price'}

              {hook h='displayProductPriceBlock' product=$product type='weight'}
            </div>
          {/if}

          <div class="product_discountOrFlag">
              {if $product.has_discount}
                {hook h='displayProductPriceBlock' product=$product type="old_price"}

                <span class="regular-price" aria-label="{l s='Regular price' d='Shop.Theme.Catalog'}">{$product.regular_price}</span>
                {if $product.discount_type === 'percentage'}
                  <span class="discount-percentage discount-product">{$product.discount_percentage}</span>
                {elseif $product.discount_type === 'amount'}
                  <span class="discount-amount discount-product">{$product.discount_amount_to_display}</span>
                {/if}
              {else}

              {block name='product_flags'}
                  <div class="product-flags">
                      
                      {if $product.grouped_features && array_key_exists ("Premier prix", $product.grouped_features)}
                        {foreach from=$product.grouped_features item=feature}
                          {if  $feature.name == "Premier prix" && $feature.value == "oui"}
                            <span class="product-flag firstPrice"> 1er prix</span>
                          {/if}
                        {/foreach}
                      {else}
                        {foreach from=$product.flags item=flag name=productFlags}
                          {if $smarty.foreach.productFlags.index == 0 && $flag.type == "online-only"}
                            <span class="product-flag {$flag.type}">{$flag.label}</span>
                          {elseif $smarty.foreach.productFlags.index == 0 && $flag.type == "pack"}
                            <span class="product-flag {$flag.type}">{$flag.label}</span>
                          {elseif $smarty.foreach.productFlags.index == 1 && $flag.type == "pack"}
                            <span class="product-flag {$flag.type}">{$flag.label}</span>
                          {elseif $smarty.foreach.productFlags.index == 0 && $flag.type == "new"}
                            <span class="product-flag {$flag.type}">{$flag.label}</span>
                          {/if}
                        {/foreach}
                      {/if}
                  </div>
              {/block}              
              {/if}
          </div>
        </div>
    </div>
  </article>
</div>
{/block}

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

{block name='header_banner'}
  <div class="header-banner">
    {hook h='displayBanner'}
  </div>
{/block}

{block name='header_nav'}
  <nav class="header-nav">
    <div class="container">
      <div class="row">
        <div class="hidden-sm-down">
          <div class="col-md-5 col-xs-12">

          </div>
          <div class="col-md-7 right-nav">
              {hook h='displayNav2'}
          </div>
        </div>
        <div class="hidden-md-up text-sm-center mobile header-nav-mobile">
          <div class="float-xs-left" id="menu-icon">
            <svg viewBox="0 0 500 500" y="0" x="0">
                <path d="m412.5 173h-325c-6.6 0-12-5.4-12-12v-24c0-6.6 5.4-12 12-12h325c6.6 0 12 5.4 12 12v24c0 6.6-5.4 12-12 12z"></path>
                <path d="m412.5 275h-325c-6.6 0-12-5.4-12-12v-24c0-6.6 5.4-12 12-12h325c6.6 0 12 5.4 12 12v24c0 6.6-5.4 12-12 12z" data-tracker-optimeeze-index="0"></path>
                <path d="m412.5 375h-325c-6.6 0-12-5.4-12-12v-24c0-6.6 5.4-12 12-12h325c6.6 0 12 5.4 12 12v24c0 6.6-5.4 12-12 12z"></path>
            </svg>
          </div>
          <div class="top-logo" id="_mobile_logo"></div>
          <div class="float-xs-right" id="_mobile_cart"></div>
          <div class="float-xs-right" id="_mobile_user_info"></div>
          <div class="clearfix"></div>
        </div>
      </div>
    </div>
  </nav>
{/block}

{block name='header_top'}
  <div class="header-top">
    <div class="container">
       <div class="row headerRow">
        <div class="col-md-3 col-lg-2 hidden-sm-down" id="_desktop_logo">
            {if $page.page_name == 'index'}
              <h1>
                <a href="{$urls.base_url}">
                  <img class="logo img-responsive" src="{$shop.logo}" alt="{$shop.name}">
                </a>
              </h1>
            {else}
                <a href="{$urls.base_url}">
                  <img class="logo img-responsive" src="{$shop.logo}" alt="{$shop.name}">
                </a>
            {/if}
        </div>
        <div id="displayTopHook" class="col-md-9 col-lg-10 col-sm-12 position-static">
          <div class="row headerRow">
            {hook h='displayTop'} {hook h='displayNav1'} 
          </div>
          <div class="clearfix"></div>
        </div>
      </div>
      <div id="mobile_top_menu_wrapper" class="row hidden-md-up" style="display:none;">
        <div class="js-top-menu mobile" id="_mobile_top_menu"></div>
        <div class="js-top-menu-bottom">
          <div id="_mobile_currency_selector"></div>
          <div id="_mobile_language_selector"></div>
          <div id="_mobile_contact_link"></div>
        </div>
      </div>
    </div>
  </div>
  {hook h='displayNavFullWidth'}
{/block}

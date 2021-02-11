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
<div id="_desktop_user_info" class="col-md-3 col-lg-3 col-xl-2">
  <div class="user-info">
    {if $logged}
      <a
        class="account accountLink"
        href="{$my_account_url}"
        title="{l s='View my customer account' d='Shop.Theme.Customeraccount'}"
        rel="nofollow"
      >
         <span class="userInfoIcon logged">
          <i class="material-icons logged">person</i>
        </span>
        <span class="hidden-sm-down userInfoLabel">{$customerName}</span>
      </a>
    {else}
      <a
        class="accountLink"
        href="{$my_account_url}"
        title="{l s='Log in to your customer account' d='Shop.Theme.Customeraccount'}"
        rel="nofollow"
      >
        <span class="userInfoIcon">
        <i class="material-icons">person</i>
        </span>
        <span class="hidden-sm-down userInfoLabel">{l s='Sign in' d='Shop.Theme.Actions'}</span>
      </a>
    {/if}
  </div>
</div>

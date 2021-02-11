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
<div id="_desktop_contact_link" class="col-md-3 col-lg-3 col-xl-2">
  <div id="contact-link">
    <a href="{$urls.pages.contact}" class="accountLink">
        <span class="contactInfoIcon">
          <i class="material-icons">smartphone</i>
        </span>
        <span class="contactLinkLabel">
          {if $contact_infos.phone}
            {* [1][/1] is for a HTML tag. *}
            {l
              s='Call us: [1]%phone%[/1]'
              sprintf=[
                '[1]' => '<span class="phoneNumber">',
                '[/1]' => '</span>',
                '%phone%' => $contact_infos.phone
              ]
              d='Shop.Theme.Global'
            }
          {else}
            <span class="contactLink">{l s='Contact us' d='Shop.Theme.Global'}</span>
          {/if}
      </span>
    </a>
  </div>
</div>

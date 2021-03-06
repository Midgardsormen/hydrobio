<?php

/**
 * PrestaShop module created by VEKIA, a guy from official PrestaShop community ;-)
 *
 * @author    VEKIA https://www.prestashop.com/forums/user/132608-vekia/
 * @copyright 2010-2019 VEKIA
 * @license   This program is not free software and you can't resell and redistribute it
 *
 * CONTACT WITH DEVELOPER
 * support@mypresta.eu
 */
class cmsproducts extends Module
{
    function __construct()
    {
        $this->name = 'cmsproducts';
        $this->tab = 'front_office_features';
        $this->author = 'MyPresta.eu';
        $this->version = '1.6.1';
        $this->bootstrap = 1;
        $this->mypresta_link = 'https://mypresta.eu/modules/front-office-features/products-on-cms-pages.html';
        parent::__construct();
        $this->displayName = $this->getTranslator()->trans('Products on CMS pages', array(), 'Modules.CmsProducts.Admin');
        $this->description = $this->getTranslator()->trans('Module allows to display lists of products on your shop CMS pages', array(), 'Modules.CmsProducts.Admin');
        $this->checkforupdates();
    }

    public function checkforupdates($display_msg = 0, $form = 0)
    {
        // ---------- //
        // ---------- //
        // VERSION 16 //
        // ---------- //
        // ---------- //
        $this->mkey = "nlc";
        if (@file_exists('../modules/' . $this->name . '/key.php')) {
            @require_once('../modules/' . $this->name . '/key.php');
        } else {
            if (@file_exists(dirname(__FILE__) . $this->name . '/key.php')) {
                @require_once(dirname(__FILE__) . $this->name . '/key.php');
            } else {
                if (@file_exists('modules/' . $this->name . '/key.php')) {
                    @require_once('modules/' . $this->name . '/key.php');
                }
            }
        }
        if ($form == 1) {
            return '
            <div class="panel" id="fieldset_myprestaupdates" style="margin-top:20px;">
            ' . ($this->psversion() == 6 || $this->psversion() == 7 ? '<div class="panel-heading"><i class="icon-wrench"></i> ' . $this->l('MyPresta updates') . '</div>' : '') . '
			<div class="form-wrapper" style="padding:0px!important;">
            <div id="module_block_settings">
                    <fieldset id="fieldset_module_block_settings">
                         ' . ($this->psversion() == 5 ? '<legend style="">' . $this->l('MyPresta updates') . '</legend>' : '') . '
                        <form action="' . $_SERVER['REQUEST_URI'] . '" method="post">
                            <label>' . $this->l('Check updates') . '</label>
                            <div class="margin-form">' . (Tools::isSubmit('submit_settings_updates_now') ? ($this->inconsistency(0) ? '' : '') . $this->checkforupdates(1) : '') . '
                                <button style="margin: 0px; top: -3px; position: relative;" type="submit" name="submit_settings_updates_now" class="button btn btn-default" />
                                <i class="process-icon-update"></i>
                                ' . $this->l('Check now') . '
                                </button>
                            </div>
                            <label>' . $this->l('Updates notifications') . '</label>
                            <div class="margin-form">
                                <select name="mypresta_updates">
                                    <option value="-">' . $this->l('-- select --') . '</option>
                                    <option value="1" ' . ((int)(Configuration::get('mypresta_updates') == 1) ? 'selected="selected"' : '') . '>' . $this->l('Enable') . '</option>
                                    <option value="0" ' . ((int)(Configuration::get('mypresta_updates') == 0) ? 'selected="selected"' : '') . '>' . $this->l('Disable') . '</option>
                                </select>
                                <p class="clear">' . $this->l('Turn this option on if you want to check MyPresta.eu for module updates automatically. This option will display notification about new versions of this addon.') . '</p>
                            </div>
                            <label>' . $this->l('Module page') . '</label>
                            <div class="margin-form">
                                <a style="font-size:14px;" href="' . $this->mypresta_link . '" target="_blank">' . $this->displayName . '</a>
                                <p class="clear">' . $this->l('This is direct link to official addon page, where you can read about changes in the module (changelog)') . '</p>
                            </div>
                            <div class="panel-footer">
                                <button type="submit" name="submit_settings_updates"class="button btn btn-default pull-right" />
                                <i class="process-icon-save"></i>
                                ' . $this->l('Save') . '
                                </button>
                            </div>
                        </form>
                    </fieldset>
                    <style>
                    #fieldset_myprestaupdates {
                        display:block;clear:both;
                        float:inherit!important;
                    }
                    </style>
                </div>
            </div>
            </div>';
        } else {
            if (defined('_PS_ADMIN_DIR_')) {
                if (Tools::isSubmit('submit_settings_updates')) {
                    Configuration::updateValue('mypresta_updates', Tools::getValue('mypresta_updates'));
                }
                if (Configuration::get('mypresta_updates') != 0 || (bool)Configuration::get('mypresta_updates') != false) {
                    if (Configuration::get('update_' . $this->name) < (date("U") - 259200)) {
                        $actual_version = cmsproductsUpdate::verify($this->name, (isset($this->mkey) ? $this->mkey : 'nokey'), $this->version);
                    }
                    if (cmsproductsUpdate::version($this->version) < cmsproductsUpdate::version(Configuration::get('updatev_' . $this->name)) && Tools::getValue('ajax','false') == 'false') {
                        $this->context->controller->warnings[] = '<strong>' . $this->displayName . '</strong>: ' . $this->l('New version available, check http://MyPresta.eu for more informations') . ' <a href="' . $this->mypresta_link . '">' . $this->l('More details in changelog') . '</a>';
                        $this->warning                         = $this->context->controller->warnings[0];
                    }
                } else {
                    if (Configuration::get('update_' . $this->name) < (date("U") - 259200)) {
                        $actual_version = cmsproductsUpdate::verify($this->name, (isset($this->mkey) ? $this->mkey : 'nokey'), $this->version);
                    }
                }
                if ($display_msg == 1) {
                    if (cmsproductsUpdate::version($this->version) < cmsproductsUpdate::version(cmsproductsUpdate::verify($this->name, (isset($this->mkey) ? $this->mkey : 'nokey'), $this->version))) {
                        return "<span style='color:red; font-weight:bold; font-size:16px; margin-right:10px;'>" . $this->l('New version available!') . "</span>";
                    } else {
                        return "<span style='color:green; font-weight:bold; font-size:16px; margin-right:10px;'>" . $this->l('Module is up to date!') . "</span>";
                    }
                }
            }
        }
    }

    public function install()
    {
        if (parent::install())
        {
            Configuration::updateValue('mypresta_updates', 1);
            return true;
        }
    }

    public function getContent()
    {
        if (Tools::isSubmit('selecttab'))
        {
            Configuration::updateValue('cmsp_last_tab', Tools::getValue('selecttab'));
        }

        if (Tools::isSubmit('cmsproducts_hide'))
        {
            Configuration::updateValue('cmsproducts_hide', Tools::getValue('cmsproducts_hide'));
        }

        $output = "";
        return $output . "<div class='clearfix'>".$this->displayForm()."</div>";
    }

    public function psversion($part = 1)
    {
        $version = _PS_VERSION_;
        $exp = $explode = explode(".", $version);
        if ($part == 1)
        {
            return $exp[1];
        }
        if ($part == 2)
        {
            return $exp[2];
        }
        if ($part == 3)
        {
            return $exp[3];
        }
    }

    public function displayForm()
    {
        $form = '';
        if (Configuration::get('cmsp_last_tab') == 3)
        {
            $form .= '
                <div id="module_block_settings" class="clearfix">
                    <fieldset id="fieldset_module_block_settings">
                        <legend style="display:inline-block;"><img src="' . $this->_path . 'logo.gif" alt="" title="" />' . $this->l('MyPresta updates') . '</legend>
                        <form action="' . $_SERVER['REQUEST_URI'] . '" method="post">
                            <label>' . $this->l('Check updates') . '</label>
                            <div class="margin-form">' . (Tools::isSubmit('submit_settings_updates_now') ? $this->checkforupdates(1) : '') . '
                                <input style="margin: 0px; top: -3px; position: relative;" type="submit" name="submit_settings_updates_now" value="' . $this->l('Check now') . '" class="button" />
                            </div>
                            <label>' . $this->l('Updates notifications') . '</label>
                            <div class="margin-form">
                                <select name="mypresta_updates">
                                    <option value="-">' . $this->l('-- select --') . '</option>
                                    <option value="1" ' . ((int)(Configuration::get('mypresta_updates') == 1) ? 'selected="selected"' : '') . '>' . $this->l('Enable') . '</option>
                                    <option value="0" ' . ((int)(Configuration::get('mypresta_updates') == 0) ? 'selected="selected"' : '') . '>' . $this->l('Disable') . '</option>
                                </select>
                                <p class="clear">' . $this->l('Turn this option on if you want to check MyPresta.eu for module updates automatically. This option will display notification about new versions of this addon.') . '</p>
                            </div>
                            <label>' . $this->l('Module page') . '</label>
                            <div class="margin-form">
                                <a style="font-size:14px;" href="' . $this->mypresta_link . '" target="_blank">' . $this->displayName . '</a>
                                <p class="clear">' . $this->l('This is direct link to official addon page, where you can read about changes in the module (changelog)') . '</p>
                            </div>
                            
                            <center><input type="submit" name="submit_settings_updates" value="' . $this->l('Save Settings') . '" class="button" /></center>
                        </form>
                    </fieldset>
                </div>';
        }
        elseif (Configuration::get('cmsp_last_tab') == 2)
        {
            $form = '
                <div style="display:block; overflow:hidden; margin:auto;">
                <form action="' . $_SERVER['REQUEST_URI'] . '" method="post">
                <fieldset style="display:block; ertical-align:top;">
                <legend><img src="' . $this->_path . 'logo.gif" alt="" title="" />' . $this->l('Appearance settings') . '</legend>

                <div style="display:block; clear:both;">
                  <label>' . $this->l('Hide products and shortcodes') . ':</label>
                  <div class="margin-form">
                   <select name="cmsproducts_hide">
                    <option value="0" ' . (Configuration::get('cmsproducts_hide') != "1" ? 'selected' : '') . '>' . $this->l('No') . '</option>
                    <option value="1" ' . (Configuration::get('cmsproducts_hide') != "1" ? '' : 'selected') . '>' . $this->l('Yes') . '</option>
                   </select>
                  </div>
	             </div>


                <div style="display:block; clear:both;">
                <center><input type="submit" name="submit_colors" value="' . $this->l('Save') . '" class="button" /></center>
                </div>
                </fieldset>
                </form>
                </div>';
        }
        elseif (Configuration::get('cmsp_last_tab') == 4)
        {
            $form = '
                <div style="display:block; overflow:hidden; margin:auto;">
                    <form action="' . $_SERVER['REQUEST_URI'] . '" method="post">
                        <fieldset style="display:block; vertical-align:top;">
                            <legend><img src="' . $this->_path . 'logo.gif" alt="" title="" />' . $this->l('How to use this module?') . '</legend>
                            ' . $this->l('read instructions about module usage:') . ' <a target="_blank" href="https://mypresta.eu/en/art/videos/shortcodes-products-on-cms-page.html">' . $this->l('How to use cms products module') . '</a>
                        </fieldset>
                    </form>
                </div>';
        }
        else
        {
            $form = '
                <div style="display:block; overflow:hidden; margin:auto;">
                    <form action="' . $_SERVER['REQUEST_URI'] . '" method="post">
                        <fieldset style="display:block; vertical-align:top;">
                            <legend><img src="' . $this->_path . 'logo.gif" alt="" title="" />' . $this->l('') . '</legend>
                            ' . $this->l('Select configuration menu item from the left hand side column') . '
                        </fieldset>
                    </form>
                </div>';
        }

        return '
        <div class="clearfix">
        <form name="selectform2" id="selectform2" action="' . $_SERVER['REQUEST_URI'] . '" method="post"><input type="hidden" name="selecttab" value="2"></form>
        <form name="selectform3" id="selectform3" action="' . $_SERVER['REQUEST_URI'] . '" method="post"><input type="hidden" name="selecttab" value="3"></form>
        <form name="selectform4" id="selectform4" action="' . $_SERVER['REQUEST_URI'] . '" method="post"><input type="hidden" name="selecttab" value="4"></form>
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">' . "<script>/*<![CDATA[*/window.zEmbed||function(e,t){var n,o,d,i,s,a=[],r=document.createElement(\"iframe\");window.zEmbed=function(){a.push(arguments)},window.zE=window.zE||window.zEmbed,r.src=\"javascript:false\",r.title=\"\",r.role=\"presentation\",(r.frameElement||r).style.cssText=\"display: none\",d=document.getElementsByTagName(\"script\"),d=d[d.length-1],d.parentNode.insertBefore(r,d),i=r.contentWindow,s=i.document;try{o=s}catch(c){n=document.domain,r.src='javascript:var d=document.open();d.domain=\"'+n+'\";void(0);',o=s}o.open()._l=function(){var o=this.createElement(\"script\");n&&(this.domain=n),o.id=\"js-iframe-async\",o.src=e,this.t=+new Date,this.zendeskHost=t,this.zEQueue=a,this.body.appendChild(o)},o.write('<body onload=\"document._l();\">'),o.close()}(\"//assets.zendesk.com/embeddable_framework/main.js\",\"prestasupport.zendesk.com\");/*]]>*/</script>" . '
        <link href="../modules/cmsproducts/css.css" rel="stylesheet" type="text/css" />
        <div id="cssmenu" class="col-lg-3 col-md-3 col-xs-12 col-sm-12" style="z-index:9;">
            <ul class="form">
                <li class="' . (Configuration::get('cmsp_last_tab') == 2 ? 'selected' : '') . '" onclick="selectform2.submit();"><a><span><i class="fa fa-paint-brush"></i>' . $this->l('Appearance settings') . '</span></a></li>
                <li class="' . (Configuration::get('cmsp_last_tab') == 4 ? 'selected' : '') . '" onclick="selectform4.submit();"><a><span><i class="fa fa-info-circle" aria-hidden="true"></i>' . $this->l('How to use?') . '</span></a></li>
                <li class="' . (Configuration::get('cmsp_last_tab') == 3 ? 'selected' : '') . '" onclick="selectform3.submit();"><a><span><i class="fa fa-refresh" aria-hidden="true"></i>' . $this->l('Updates') . '</span></a></li>
                <li class="mega"><a href="https://mypresta.eu/modules/front-office-features/display-products-on-cms-pages-pro.html"><span><i class="fa fa-puzzle-piece" aria-hidden="true"></i>' . $this->l('Get Pro Version') . '</span></a></li>
            </ul>
            <iframe src="//apps.facepages.eu/somestuff/cmsproducts.html" width="100%" height="450" border="0" style="border:none;"></iframe>
        </div>
        <div class="col-lg-9 col-md-9 col-xs-12 col-sm-12" style="z-index: 9;"><div class="' . ($this->psversion() == 6 || $this->psversion() == 7 ? 'nobootstrap' : '') . '" style="' . ($this->psversion() == 6 || $this->psversion() == 7 ? 'padding-top:0px!important; background:none!important;  min-width:100%!important; max-width:100px!important; z-index:9;' : 'z-index:9;') . '">' . $form . '</div></div></div>';
    }
}

class cmsproductsUpdate extends cmsproducts
{
    public static function version($version)
    {
        $version = (int)str_replace(".", "", $version);
        if (strlen($version) == 3)
        {
            $version = (int)$version . "0";
        }
        if (strlen($version) == 2)
        {
            $version = (int)$version . "00";
        }
        if (strlen($version) == 1)
        {
            $version = (int)$version . "000";
        }
        if (strlen($version) == 0)
        {
            $version = (int)$version . "0000";
        }
        return (int)$version;
    }

    public static function encrypt($string)
    {
        return base64_encode($string);
    }

    public static function verify($module, $key, $version)
    {
        if (ini_get("allow_url_fopen"))
        {
            if (function_exists("file_get_contents"))
            {
                $actual_version = @file_get_contents('http://dev.mypresta.eu/update/get.php?module=' . $module . "&version=" . self::encrypt($version) . "&lic=$key&u=" . self::encrypt(_PS_BASE_URL_ . __PS_BASE_URI__));
            }
        }
        Configuration::updateValue("update_" . $module, date("U"));
        Configuration::updateValue("updatev_" . $module, $actual_version);
        return $actual_version;
    }
}

?>
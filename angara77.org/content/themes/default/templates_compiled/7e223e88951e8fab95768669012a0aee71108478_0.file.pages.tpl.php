<?php
/* Smarty version 3.1.31, created on 2018-07-17 06:53:33
  from "/home/manhee/angara77.org/content/themes/default/templates/pages.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_5b4d926ddaa471_24402710',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7e223e88951e8fab95768669012a0aee71108478' => 
    array (
      0 => '/home/manhee/angara77.org/content/themes/default/templates/pages.tpl',
      1 => 1531751103,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:_head.tpl' => 1,
    'file:_header.tpl' => 1,
    'file:_sidebar.tpl' => 1,
    'file:__feeds_page.tpl' => 1,
    'file:_footer.tpl' => 1,
  ),
),false)) {
function content_5b4d926ddaa471_24402710 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender('file:_head.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php $_smarty_tpl->_subTemplateRender('file:_header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>


<!-- page content -->
<div class="container mt20 offcanvas">
    <div class="row">

        <!-- left panel -->
        <div class="col-sm-4 col-md-2 offcanvas-sidebar">
            <?php $_smarty_tpl->_subTemplateRender('file:_sidebar.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

        </div>
        <!-- left panel -->

        <!-- right panel -->
        <div class="col-sm-8 col-md-10 offcanvas-mainbar">

            <!-- tabs -->
            <div class="box-tabs-wrapper clearfix">
                <ul class="nav pull-left flip">
                    <li <?php if ($_smarty_tpl->tpl_vars['view']->value == '') {?>class="active"<?php }?>>
                        <a href="<?php echo $_smarty_tpl->tpl_vars['system']->value['system_url'];?>
/pages"><?php echo __("Discover");?>
</a>
                    </li>
                    <li <?php if ($_smarty_tpl->tpl_vars['view']->value == "liked") {?>class="active"<?php }?>>
                        <a href="<?php echo $_smarty_tpl->tpl_vars['system']->value['system_url'];?>
/pages/liked"><?php echo __("Liked Pages");?>
</a>
                    </li>
                    <li <?php if ($_smarty_tpl->tpl_vars['view']->value == "manage") {?>class="active"<?php }?>>
                        <a href="<?php echo $_smarty_tpl->tpl_vars['system']->value['system_url'];?>
/pages/manage"><?php echo __("My Pages");?>
</a>
                    </li>
                </ul>
                <?php if ($_smarty_tpl->tpl_vars['user']->value->_data['user_group'] < 3 || $_smarty_tpl->tpl_vars['system']->value['pages_enabled']) {?>
                    <div class="mt10 pull-right flip">
                        <button class="btn btn-success btn-sm" data-toggle="modal" data-url="#create-page">
                            <i class="fa fa-plus-circle fa-fw"></i><span class="hidden-xs"><?php echo __("Create Page");?>
</span>
                        </button>
                    </div>
                <?php }?>
            </div>
            <!-- tabs -->
            
            <!-- content -->
            <div>
                <?php if (count($_smarty_tpl->tpl_vars['pages']->value) > 0) {?>
                    <ul class="row">
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['pages']->value, '_page');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['_page']->value) {
?>
                            <?php $_smarty_tpl->_subTemplateRender('file:__feeds_page.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>

                    </ul>

                    <!-- see-more -->
                    <?php if (count($_smarty_tpl->tpl_vars['pages']->value) >= $_smarty_tpl->tpl_vars['system']->value['max_results_even']) {?>
                        <div class="alert alert-post see-more js_see-more" data-get="<?php echo $_smarty_tpl->tpl_vars['get']->value;?>
" data-uid="<?php echo $_smarty_tpl->tpl_vars['user']->value->_data['user_id'];?>
">
                            <span><?php echo __("See More");?>
</span>
                            <div class="loader loader_small x-hidden"></div>
                        </div>
                    <?php }?>
                    <!-- see-more -->
                <?php } else { ?>
                    <p class="text-center text-muted">
                        <?php echo __("No pages to show");?>

                    </p>
                <?php }?>
            </div>
            <!-- content -->

        </div>
        <!-- right panel -->

    </div>
</div>
<!-- page content -->

<?php $_smarty_tpl->_subTemplateRender('file:_footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}

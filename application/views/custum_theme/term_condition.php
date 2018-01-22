   <style>
    .galary_hader_tnc
        {
            border: 1px solid #73C873;
            font-size: 22px;
            border-radius: 5px;
            height: auto;
            font-weight: 600;
            text-align: center;
            margin-top: 50px;
            margin-bottom:  50px;
            vertical-align: middle;
        }
</style>
<?php echo mouceiconeonclick('.galary_hader_tnc');?>
<div class="" onclick="" id="page_no<?php echo '19';?>">
    <div class="col-xs-12 col-md-12 col-sm-12 col-lg-12">
        <div class="col-md-6 col-md-offset-3 galary_hader" id="pageno_6" ondblclick="load_popup2('#view_prod','#title_popup<?php echo $pageid6; ?>','<?php echo $pageid6; ?>')" style="<?php echo $btn_theme_style,$pagetitleposition6;?>"><?php echo $pagetitle6;?></div>
    </div>
  <div id="add_item_page_<?php echo $pageid6;?>"></div>
    <!--<img class="image_as" alt="image" src='edit_assets/image/process.gif' style="position: relative;z-index: 1;"/> -->
 
    <div class="container" ondblclick="load_popup('#view_prod','#term_condition_popup')">
              
        <div class="col-md-12 galary_hader_tnc" id="termconditiontextfull" data-toggle="popover"> 
            <?php ?>
    <?php if($user_TermCondition_full){
        print_r($user_TermCondition_full);        
    }?>
            
        </div>
    </div>
</div>
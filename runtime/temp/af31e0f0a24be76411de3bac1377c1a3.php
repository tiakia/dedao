<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:72:"F:\XAMPP\htdocs\video\public/../application/admin\view\open\pic_cut.html";i:1510306797;s:71:"F:\XAMPP\htdocs\video\public/../application/admin\view\open\header.html";i:1510306797;}*/ ?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<!-- Set render engine for 360 browser -->
	<meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- HTML5 shim for IE8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <![endif]-->

	<link href="__PUBLIC__/css/theme.min.css" rel="stylesheet">
    <link href="__PUBLIC__/css/simplebootadmin.css" rel="stylesheet">
    <link href="__PUBLIC__/js/artDialog/skins/default.css" rel="stylesheet" />
    <link href="__PUBLIC__/font-awesome/4.4.0/css/font-awesome.min.css"  rel="stylesheet" type="text/css">
    <style>
		form .input-order{margin-bottom: 0px;padding:3px;width:40px;}
		.table-actions{margin-top: 5px; margin-bottom: 5px;padding:0px;}
		.table-list{margin-bottom: 0px;}
	</style>
	<!--[if IE 7]>
	<link rel="stylesheet" href="__PUBLIC__/simpleboot/font-awesome/4.4.0/css/font-awesome-ie7.min.css">
	<![endif]-->
	<script type="text/javascript">
	//全局变量
	var GV = {
	    WEB_ROOT: "/",
	    JS_ROOT: "__PUBLIC__/js/",
	    APP:"admin"/*当前应用名*/
	};
	</script>
    <script src="__PUBLIC__/js/jquery.js"></script>
    <script src="__PUBLIC__/js/wind.js"></script>
    <script src="__PUBLIC__/js/bootstrap.min.js"></script>
    <script>
    	$(function(){
    		$("[data-toggle='tooltip']").tooltip();
    	});
    </script>
<if condition="APP_DEBUG">
	<style>
		#think_page_trace_open{
			z-index:9999;
		}
	</style>
</if> 
<link rel="stylesheet" href="__PUBLIC__/css/pic_cut.css">
<div class="page">
  <form action="<?php echo url('member/pic_cut'); ?>" id="form_cut" method="post">
    <input type="hidden" id="x" name="x" value="<?php echo $param['x']; ?>" />
    <input type="hidden" id="x1" name="x1" />
    <input type="hidden" id="y1" name="y1" />
    <input type="hidden" id="x2" name="x2" />
    <input type="hidden" id="y2" name="y2" />
    <input type="hidden" id="w" name="w" />
    <input type="hidden" id="h" name="h" />    
    <input type="hidden" id="url" name="url" value="<?php echo $param['src']; ?>" />
    <input type="hidden" id="filename" name="filename" value="" />
    <div class="pic-cut-<?php echo $param['x']; ?><?php echo $param['type']; ?>">
      <div class="work-title">工作区域</div>
      <div class="work-layer">
        <p><img id="nccropbox" src="<?php echo $param['src']; ?>"/></p>
      </div>
      <div class="thumb-title">裁剪预览</div>
      <div class="thumb-layer">
        <p><img id="preview" src="<?php echo $param['src']; ?>"/></p>
      </div>
      <div class="cut-help">
        <h4>操作帮助</h4>
        <p>请在工作区域放大缩小及移动选取框，选择要裁剪的范围，裁切宽高比例固定；裁切后的效果为右侧预览图所显示；保存提交后生效。</p>
      </div>
      <div class="cut-btn"> <a href="JavaScript:void(0);" class="btn btn-info" id="pic_submit"><span>提交</span></a> </div>
    </div>
  </form>
</div>
<script type="text/javascript">
Wind.css("jcrop");
Wind.use("jcrop",function(){
  $('.dialog_head').css('margin-top','0px');
  $('.page').css('padding-top','0px');
  $('.dialog_close_button').remove();
  $('#nccropbox').Jcrop({
    aspectRatio: 1,
    setSelect: [ 0, 0, <?php echo $param['x']; ?>, <?php echo $param['y']; ?> ],
    minSize:[50, 50],
    allowSelect:0,
    allowResize:1,
    onChange: showPreview,
    onSelect: showPreview,
    onDblClick:submitCoords
  });
  function showPreview(coords){
    if (parseInt(coords.w) > 0){
      var rx = <?php echo $param['x']; ?> / coords.w;
      var ry = <?php echo $param['y']; ?> / coords.h;
      $('#preview').css({
        width: Math.round(rx * <?php echo $param['width']; ?>) + 'px',
        height: Math.round(ry * <?php echo $param['height']; ?>) + 'px',
        marginLeft: '-' + Math.round(rx * coords.x) + 'px',
        marginTop: '-' + Math.round(ry * coords.y) + 'px'
      });
    }
    $('#x1').val(coords.x);
    $('#y1').val(coords.y);
    $('#x2').val(coords.x2);
    $('#y2').val(coords.y2);
    $('#w').val(coords.w);
    $('#h').val(coords.h);
  }
  
 });
function submitCoords(c){
  $('#pic_submit').click();
}
$('#pic_submit').click(function(){
  var d=$('#form_cut').serialize();
  $.post("<?php echo url('member/pic_cut'); ?>",d,function(data){
    parent.window.call_back(data);
    try{
        art.dialog.close();
    }catch(err){
        Wind.use('artDialog','iframeTools',function(){
            art.dialog.close();
        });
    };
  });
});
</script>
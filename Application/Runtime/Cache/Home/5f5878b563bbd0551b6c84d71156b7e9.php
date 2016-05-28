<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <title>Document</title>
   <link rel="stylesheet" type="text/css" href="/kebiao/Public/css/bootstrap.css"></head>
<body>
   <nav class="navbar navbar-default" role="navigation">
      <div class="container">
         <div class="navbar-header">
            <a class="navbar-brand" href="#">课表在线</a>
         </div>
         <div>
            <form class="navbar-form navbar-left pull-right" role="search" method="get" action="/kebiao/index.php/Home/Index/Index">
               <div class="form-group">
                  <input type="text" class="form-control" placeholder="Search" id="search" name="id"></div>
               <button type="submit" class="btn btn-default" id="btn">查询</button>
            </form>
         </div>
      </div>
   </nav>
   <div class="container">
      <div class="row">
          <h1><span id="d-xh"><?php echo ($student); ?></span>同学的课表</h1>
    <table class="table .table-striped .table-hover">
        <thead>
            <tr>
             <th>周一</th>
             <th>周二</th>
             <th>周三</th>
             <th>周四</th>
             <th>周五</th>
             <th>周六</th>
             <th>周日</th>
            </tr>
        </thead>
        <tbody>
         <?php if(is_array($table)): $i = 0; $__LIST__ = $table;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v1): $mod = ($i % 2 );++$i;?><tr>
               <?php if(is_array($v1)): $i = 0; $__LIST__ = $v1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v2): $mod = ($i % 2 );++$i;?><td>
                     <?php if(is_array($v2)): $i = 0; $__LIST__ = $v2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v3): $mod = ($i % 2 );++$i;?><p><?php echo ($v3["course_id"]); ?></p>
                        <p><?php echo ($v3["course"]); ?></p>
                        <p><?php echo ($v3["teacher"]); ?></p>
                        <p><?php echo ($v3["classroom"]); ?></p>
                        <p><?php echo ($v3["property"]); ?></p>
                        <p><?php echo ($v3["week"]); ?></p>
                        <br><?php endforeach; endif; else: echo "" ;endif; ?>
                  </td><?php endforeach; endif; else: echo "" ;endif; ?>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>           
        </tbody>
    </table>    

      </div>
   </div>
</body>
   <script src="http://apps.bdimg.com/libs/jquery/2.0.0/jquery.min.js"></script>
   <script type="text/javascript" src="/kebiao/Public/js/bootstrap.min.js"></script>
</html>
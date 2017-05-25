
  <div class="navbar navbar-default navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <a class="navbar-brand" href="#" style="margin-top : -10px">
          <img src="img/sdu-text-h40.png" class="img-responsive" alt="มหาวิทยาลัยราชภัฏสวนดุสิต">
        </a>
      </div>
      <!-- /.navbar-header -->

      <div class="navbar-collapse collapse navbar-responsive-collapse">
        <ul class="nav navbar-nav navbar-right">
          <!-- 
          <li><a href="bm-list.php?c=2">ระเบียบวาระการประชุมคบม.</a></li>
          <li><a href="bm-list.php?c=3">ระเบียบวาระการประชุมรองอธิการ</a></li>
          <li><a href="bm-list.php?c=5">ระเบียบวาระการประชุมติดตามฯ</a></li>
          -->
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"> 
              <i class="fa fa-user fa-lg"></i> <?= $_SESSION["user_fullname"] ?> <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="logout.php">ออกจากระบบ</a></li>
            </ul>
          </li>
        </ul>
      </div>
      <!-- /.navbar-collapse -->

    </div>
  </div>
  <!-- /.navbar navbar-default -->  
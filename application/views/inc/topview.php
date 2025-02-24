<nav class="page-controls navbar navbar-default">
    <div class="container-fluid">
        <!-- .navbar-header contains links seen on xs & sm screens -->
        <div class="navbar-header">
            <ul class="nav navbar-nav">
                <li>
                    <!-- whether to automatically collapse sidebar on mouseleave. If activated acts more like usual admin templates -->
                    <a class="hidden-sm hidden-xs" id="nav-state-toggle" href="#" title="사이드메뉴 On/Off" data-placement="bottom">
                        <i class="fa fa-bars fa-lg"></i>
                    </a>
                    <!-- shown on xs & sm screen. collapses and expands navigation -->
                    <a class="visible-sm visible-xs" id="nav-collapse-toggle" href="#" title="Show/hide sidebar" data-placement="bottom">
                        <span class="rounded rounded-lg bg-gray text-white visible-xs"><i class="fa fa-bars fa-lg"></i></span>
                        <i class="fa fa-bars fa-lg hidden-xs"></i>
                    </a>
                </li>
            </ul>  
        </div>

        <div class="collapse navbar-collapse">
            
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle dropdown-toggle-notifications" id="notifications-dropdown-toggle" data-toggle="dropdown">
                        <!-- <span class="circle bg-warning fw-bold">
                            13
                        </span> -->
                        &nbsp;
                        <strong><?php echo $this->session->userdata('nm');?></strong>&nbsp;&nbsp;<?php echo $this->session->userdata('jikwi');?>&nbsp;님
                        <b></b></a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-cog fa-lg"></i>
                    </a>
                    <ul class="dropdown-menu">

                        <?php if($this->session->userdata('rolegu') == "AD") { ?>
                            <li><a href="<?php echo site_url('/user/account'); ?>">사용자 관리</a></li>
                            <li class="divider"></li>
                            <?php
                        }
                        ?>
                        <li><a href="/sys/logout"><i class="fa fa-power-off"></i> &nbsp; Log Out</a></li>
                    </ul>
                </li>
                
            </ul>
        </div>
    </div>
</nav>
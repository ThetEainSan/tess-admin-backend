 <!-- Side Nav START -->
 <div class="side-nav">
    <div class="side-nav-inner">
        <ul class="side-nav-menu scrollable">
            <li class="nav-item dropdown open">                
                    <a href="{{ route('dashboard') }}">
                        <span class="icon-holder">
                            <i class="anticon anticon-dashboard"></i>
                        </span>
                        <span class="title">Dashboard</span> 
                    </a>                                      
            </li>
            <li class="nav-item dropdown open">                
                <a href="{{ route('admins') }}">
                    <span class="icon-holder">
                        <i class="anticon anticon-team"></i>
                    </span>
                    <span class="title">Admins</span> 
                </a>                                      
            </li>
            <li class="nav-item dropdown open">                
                <a href="{{ route('employees') }}">
                    <span class="icon-holder">
                        <i class="anticon anticon-team"></i>
                    </span>
                    <span class="title">Employees</span> 
                </a>                                      
            </li>
            <li class="nav-item dropdown">
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="anticon anticon-shopping"></i>
                    </span>
                    <span class="title">Inventory</span>
                    <span class="arrow">
                        <i class="arrow-icon"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{ route('foods') }}"><span class="anticon anticon-cloud mr-1"></span>Food</a>
                    </li>
                    <li>
                        <a href="{{ route('drinks') }}"><span class="anticon anticon-coffee mr-2"></span>Drinks</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<!-- Side Nav END -->

<ul class="nav" id="side-menu">
    <li class="nav-header">
        <div class="dropdown profile-element">
                <img alt="image" class="logo_class" src="{{ env('APP_URL').'/'. 'public/img/Quotation-logo.png' }}" />
            
            {{-- <span>
                <img alt="image" class="img-circle" src="{{ env('APP_URL').'/public/img/profile.png' }}" style="width: 50px;" />
            </span>
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">
                    @if(Auth::check()) 
                    {{ Auth::user()->FirstName }} {{ Auth::user()->LastName }}
                    @endif </strong>
                </span> <span class="text-muted text-xs block">Admin<b class="caret"></b></span> </span> 
            </a>
            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                <li>
                    <a href="{!! url('/logout') !!}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log out </a>
                </li>
            </ul> --}}
        </div>
        <div class="logo-element">
            <!-- <img alt="image" style="width:70%" src="{{ env('APP_URL').'/'. 'public/img/ascend-logo-icon.png' }}" /> -->
            <img alt="image" style="width:90%" src="{{ env('APP_URL').'/'. 'public/img/ascend-logo-icon.jpg' }}" />
        </div>
    </li>
    {{-- <li class="{{ Request::is('home*') ? 'active' : '' }}">
        <a href="{{url('home')}}"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span> </a>
    </li> --}}
    
    {{-- <li class="{{ Request::is('users*') ? 'active' : ''  || Request::is('home') ? 'active' : '' }}">
        <a href="{{ url('users')}}"><i class="fas fa-users"></i> <span class="nav-label">Users</span> </a>
    </li> --}}
    
    <li class="{{ Request::is('om*') ? 'active' : '' }}">
        <a href="{{ url('om')}}"<i class="fas fa-desktop"></i> <span class="nav-label">Om Electricals</span> </a>
    </li>
    
    <li class="{{ Request::is('earth*') ? 'active' : '' }}">
        <a href="{{ url('earth')}}"><i class="far fa-building"></i> <span class="nav-label">Earth Enterprise</span> </a>
    </li>
    
    
</ul>
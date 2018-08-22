{{--  <img src="../images/unc.png" width="30px">  --}}
<!--sidebar-menu-->
{{--  <img src="../images/unc.png">  --}}


<div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> <span>UNC Hotel</span></a>
  <ul>
    <li><a href="{{ url('/admin/dashboard') }}"><i class="icon icon-home"></i> <span>Room Status</span></a> </li>

    <li> <a href="{{ url('/guest/hotel_guest') }}"><i class="icon-user"></i> <span>Guest</span> </a>
      {{-- <ul>
        <li><a href="{{ url('/guest/hotel_guest') }}"> <i class="icon-list"></i> Guest List</a></li>
        <li><a href="{{ url('/dynamic_pdf') }}"> <i class="icon-arrow-up"></i> Archived Guest</a></li>
      </ul> --}}
    </li>

    {{--  <li class="submenu"> <a href="#"><i class="icon-th"></i> <span>Rooms</span> </a>
      <ul>
        <li><a href="{{ url('/admin/add-product') }}">Rooms</a></li>
        <li><a href="{{ url('/admin/view-product') }}">Room Management</a></li>
      </ul>
    </li>  --}}

    <li> <a href="{{ route('out') }}"><i class="icon-calendar"></i> <span>Next Checkouts</span></a> </li>

    <li class="submenu"> <a href="widgets.html"><i class="icon icon-file"></i>  <span>Reports</span></a>
        <ul>
        <li><a href="{{ route('collection') }}"><i class="icon icon-money"></i> Collection</a></li>
        <li><a href="{{ route('rcollection') }}"><i class="icon icon-briefcase"></i> Remitted Collection</a></li>
        </ul>

    </li>
    <li class="submenu"><a href="tables.html"><i class="icon icon-cog"></i> <span>Manage</span></a>
        <ul>
            <li><a href="{{ url('/settings/room') }}"><i class="icon icon-th"></i> Room</a></li>
            <li><a href="{{ url('/settings/room_type') }}"><i class="icon icon-th"></i> Room type</a></li>
            <li><a href="{{ url('/settings/room_extra') }}"><i class="icon icon-th"></i> Extras</a></li>
            <li><a href="{{ url('/settings/room_categoryExtra') }}"><i class="icon icon-th"></i> Category Extra</a></li>
            <li><a href="{{ route('front') }}"><i class="icon icon-user"></i> Front Desk</a></li>
            <li><a href="{{ route('user') }}"><i class="icon icon-user"></i> User(s)</a></li>
        </ul>
    </li>

  </ul>
</div>
<!--sidebar-menu-->

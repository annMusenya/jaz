<div id="sidebar" class="sidebar py-3">

  <div class="text-gray-400 text-uppercase px-3 px-lg-4 py-4 font-weight-bold small headings-font-family">MAIN</div>

  <ul class="sidebar-menu list-unstyled">

     <li class="sidebar-list-item"><a href="/writer" data-toggle="collapse" data-target="#orders" aria-expanded="false" aria-controls="pages" class="sidebar-link active"><i class="o-document-1 mr-3 text-gray"></i><span>Orders</span></a>
            <div id="orders" class="collapse">
              <ul class="sidebar-menu list-unstyled border-left border-primary border-thick">
                <li class="sidebar-list-item"><a href="/writer" class="sidebar-link text-muted pl-lg-5">Available @if($availableCount)<span class="badge badge-primary badge-pill px-2 py-1 ml-2 text-white">{{$availableCount}}</span>@endif</a></li>
                <li class="sidebar-list-item"><a href="/writer/active" class="sidebar-link text-muted pl-lg-5">Assigned @if($assignedNum)<span class="badge badge-primary badge-pill px-2 py-1 ml-2 text-white">{{$assignedNum}}</span>@endif</a></li>
                <li class="sidebar-list-item"><a href="/writer/done" class="sidebar-link text-muted pl-lg-5">Done @if($doneNum)<span class="badge badge-primary badge-pill px-2 py-1 ml-2 text-white">{{$doneNum}}</span>@endif</a></li>
                <li class="sidebar-list-item"><a href="/writer/delivered" class="sidebar-link text-muted pl-lg-5">Delivered @if($deliveredNum)<span class="badge badge-primary badge-pill px-2 py-1 ml-2 text-white">{{$deliveredNum}}</span>@endif</a></li>
                <li class="sidebar-list-item"><a href="/writer/revision" class="sidebar-link text-muted pl-lg-5">Revision @if($revisionNum)<span class="badge badge-primary badge-pill px-2 py-1 ml-2 text-white">{{$revisionNum}}</span>@endif</a></li>
                <li class="sidebar-list-item"><a href="/writer/disputed" class="sidebar-link text-muted pl-lg-5">Disputed @if($disputedNum)<span class="badge badge-primary badge-pill px-2 py-1 ml-2 text-white">{{$disputedNum}}</span>@endif</a></li>
              </ul>
            </div>
          </li>

    <li class="sidebar-list-item">

      <a href="/writer/bidding" class="sidebar-link text-muted">

        <i class="fa fa-gavel mr-3 text-gray"></i>

        <span>Bids</span>

      </a>

    </li>

    <li class="sidebar-list-item">

      <a href="/writer/finished" class="sidebar-link text-muted">

        <i class="o-like-hand-1 mr-3 text-gray"></i>

        <span>Finished</span>

      </a>

    </li>

    <li class="sidebar-list-item">

      <a href="/writer/payments" class="sidebar-link text-muted">

        <i class="o-stack-1 mr-3 text-gray"></i>

        <span>Payments</span>

      </a>

    </li>

    <li class="sidebar-list-item">

      <a href="/writer/messages" class="sidebar-link text-muted">

        <i class="fa fa-comments-o mr-3 text-gray"></i>

        <span>Messages</span>

      </a>

    </li>

  </ul>

  <div class="text-gray-400 text-uppercase px-3 px-lg-4 py-4 font-weight-bold small headings-font-family">EXTRAS</div>

  <ul class="sidebar-menu list-unstyled">

    <li class="sidebar-list-item">

      <a href="/writer/help" class="sidebar-link text-muted">

        <i class="o-imac-screen-1 mr-3 text-gray"></i>

        <span>Help</span>

      </a>

    </li>

    <li class="sidebar-list-item">

      <a href="/writer/logout" class="sidebar-link text-muted">

        <i class="o-exit-1 mr-3 text-gray"></i>

        <span>Log Out</span>

      </a>

    </li>

  </ul>

</div>
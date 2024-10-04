 <!--  BEGIN SIDEBAR  -->
 <div class="sidebar-wrapper sidebar-theme">


     <nav id="sidebar">

         <ul class="navbar-nav theme-brand flex-row  text-center">

             <li class="nav-item theme-text">
                 <a href="{{ Route('dashboard_admin') }}" class="nav-link"> OPNAME </a>
             </li>
             <li class="nav-item toggle-sidebar">
                 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                     class="feather feather-arrow-left sidebarCollapse">
                     <line x1="19" y1="12" x2="5" y2="12"></line>
                     <polyline points="12 19 5 12 12 5"></polyline>
                 </svg>
             </li>
         </ul>

         <div class="shadow-bottom"></div>
         <ul class="list-unstyled menu-categories" id="accordionExample">
             <li class="menu {{ $title == 'Dashboard' ? 'active' : '' }}">
                 <a href="{{ route('dashboard_admin') }}" aria-expanded="true" class="dropdown-toggle nav-link"
                     style="text-decoration: none">
                     <div class="fs-6 ">
                         <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-speedometer mx-2" viewBox="0 0 16 16">
                             <path
                                 d="M8 2a.5.5 0 0 1 .5.5V4a.5.5 0 0 1-1 0V2.5A.5.5 0 0 1 8 2M3.732 3.732a.5.5 0 0 1 .707 0l.915.914a.5.5 0 1 1-.708.708l-.914-.915a.5.5 0 0 1 0-.707M2 8a.5.5 0 0 1 .5-.5h1.586a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 8m9.5 0a.5.5 0 0 1 .5-.5h1.5a.5.5 0 0 1 0 1H12a.5.5 0 0 1-.5-.5m.754-4.246a.39.39 0 0 0-.527-.02L7.547 7.31A.91.91 0 1 0 8.85 8.569l3.434-4.297a.39.39 0 0 0-.029-.518z" />
                             <path fill-rule="evenodd"
                                 d="M6.664 15.889A8 8 0 1 1 9.336.11a8 8 0 0 1-2.672 15.78zm-4.665-4.283A11.95 11.95 0 0 1 8 10c2.186 0 4.236.585 6.001 1.606a7 7 0 1 0-12.002 0" />
                         </svg>
                         <span> Dashboard</span>
                     </div>
                 </a>
             </li>
             <li class="menu {{ $title == 'Data Gudang' ? 'active' : '' }}">
                 <a href="{{ route('data_gudang') }}" aria-expanded="true" class="dropdown-toggle nav-link">
                     <div class="fs-6 ">
                         <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-card-heading mx-2" viewBox="0 0 16 16">
                             <path
                                 d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z" />
                             <path
                                 d="M3 8.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5m0-5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5z" />
                         </svg>
                         <span> Data Gudang</span>
                     </div>
                 </a>
             </li>
             <li class="menu {{ $title == 'Stok Barang' ? 'active' : '' }}">
                 <a href="{{ route('stok_barang') }}" aria-expanded="true" class="dropdown-toggle nav-link">
                     <div class="fs-6 ">
                         <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-box-seam mx-2" viewBox="0 0 16 16">
                             <path
                                 d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2zm3.564 1.426L5.596 5 8 5.961 14.154 3.5zm3.25 1.7-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464z" />
                         </svg>
                         <span> Stok Barang</span>
                     </div>
                 </a>
             </li>
             <li class="menu ">
                 <a href="{{ route('data_produk') }}" aria-expanded="true" class="dropdown-toggle nav-link">
                     <div class="fs-6">
                         <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-box-fill mx-2" viewBox="0 0 16 16">
                             <path fill-rule="evenodd"
                                 d="M15.528 2.973a.75.75 0 0 1 .472.696v8.662a.75.75 0 0 1-.472.696l-7.25 2.9a.75.75 0 0 1-.557 0l-7.25-2.9A.75.75 0 0 1 0 12.331V3.669a.75.75 0 0 1 .471-.696L7.443.184l.004-.001.274-.11a.75.75 0 0 1 .558 0l.274.11.004.001zm-1.374.527L8 5.962 1.846 3.5 1 3.839v.4l6.5 2.6v7.922l.5.2.5-.2V6.84l6.5-2.6v-.4l-.846-.339Z" />
                         </svg>
                         <span> Data Produk</span>
                     </div>
                 </a>
             </li>
             <li class="menu ">
                 <a href="{{ route('data_user') }}" aria-expanded="true" class="dropdown-toggle nav-link">
                     <div class="fs-6">
                         <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-person mx-2" viewBox="0 0 16 16">
                             <path
                                 d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
                         </svg>
                         <span> Data User</span>
                     </div>
                 </a>
             </li>
         </ul>
     </nav>

 </div>
 <!--  END SIDEBAR  -->

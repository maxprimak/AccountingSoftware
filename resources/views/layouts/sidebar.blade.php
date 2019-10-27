
  <div class="side-content-wrap">
            <div class="sidebar-left open rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
                <ul class="navigation-left">

                    @if(auth()->user()->isNotCourier() )
                    <li class="nav-item {{ request()->is('dashboard/*') ? 'active' : '' }}">
                        <a class="nav-item-hold" href="/customers">
                            <i class="nav-icon i-Suitcase"></i>
                            <span class="nav-text">Customers</span>
                        </a>
                        <div class="triangle"></div>
                    </li>
                    @endif

                    @if(auth()->user()->isHead() || auth()->user()->isTopManager())
                    <li class="nav-item {{ request()->is('dashboard/*') ? 'active' : '' }}">
                        <a class="nav-item-hold" href="/employees">
                            <i class="nav-icon i-Administrator"></i>
                            <span class="nav-text">Employees</span>
                        </a>
                        <div class="triangle"></div>
                    </li>
                    @endif

                    @if(auth()->user()->isHead() || auth()->user()->isTopManager())
                    <li class="nav-item {{ request()->is('dashboard/*') ? 'active' : '' }}">
                        <a class="nav-item-hold" href="/companies">
                            <i class="nav-icon i-Bar-Chart"></i>
                            <span class="nav-text">My Company</span>
                        </a>
                        <div class="triangle"></div>
                    </li>
                    @endif

                    {{-- 
                    <li class="nav-item {{ request()->is('repair-orders') ? 'active' : '' }}">
                        <a class="nav-item-hold" href="/repair-orders">
                            <i class="nav-icon i-Library"></i>
                            <span class="nav-text">Orders</span>
                        </a>
                        <div class="triangle"></div>
                    </li>
                    <li class="nav-item" data-item="extrakits">
                        <a class="nav-item-hold" href="#">
                            <i class="nav-icon i-Suitcase"></i>
                            <span class="nav-text">Warehouses</span>
                        </a>
                        <div class="triangle"></div>
                    </li>
                    <li class="nav-item" data-item="apps">
                        <a class="nav-item-hold" href="#">
                            <i class="nav-icon i-Computer-Secure"></i>
                            <span class="nav-text">Goods & parts</span>
                        </a>
                        <div class="triangle"></div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-item-hold" href="#basic-tables">
                            <i class="nav-icon i-File-Horizontal-Text"></i>
                            <span class="nav-text">Services</span>
                        </a>
                        <div class="triangle"></div>
                    </li>
                    <li class="nav-item" {{ request()->is('employees/*') ? 'active' : '' }} data-item="users">
                        <a class="nav-item-hold" href="/employees">
                            <i class="nav-icon i-Administrator"></i>
                            <span class="nav-text">Users</span>
                        </a>
                        <div class="triangle"></div>
                    </li>
                    <li class="nav-item" data-item="others">
                        <a class="nav-item-hold" href="/test.html">
                            <i class="nav-icon i-Double-Tap"></i>
                            <span class="nav-text">Accounting</span>
                        </a>
                        <div class="triangle"></div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-item-hold" href="{{route('companies.index')}}">
                            <i class="nav-icon i-Safe-Box1"></i>
                            <span class="nav-text">My Company</span>
                        </a>
                        <div class="triangle"></div>
                    </li> --}}
                </ul>
            </div>

            <div class="sidebar-left-secondary rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
                <!-- Submenu Dashboards -->
                <ul class="childNav" data-parent="dashboard">
                    <li class="nav-item">
                        <a class="{{ Route::currentRouteName()=='dashboard_version_1' ? 'open' : '' }}" href="{{route('rechnung_hand_dif.all')}}">
                            <i class="nav-icon i-Money-2"></i>
                            <span class="item-name">Rechnung Handy Differenz</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('kostenvoranschlag.all')}}">
                            <i class="nav-icon i-Gear"></i>
                            <span class="item-name">Konstenvoranchläge</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('kaufvertrag.all')}}">
                            <i class="nav-icon i-Financial"></i>
                            <span class="item-name">Kaufverträge</span>
                        </a>
                    </li>
                    </ul>
                    <ul class="childNav" data-parent="users">
                        <li class="nav-item">
                            <a class="{{ Route::currentRouteName()=='dashboard_version_1' ? 'open' : '' }}" href="{{route('rechnung_hand_dif.all')}}">
                                <i class="nav-icon i-Money-2"></i>
                                <span class="item-name">Customers</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('kostenvoranschlag.all')}}">
                                <i class="nav-icon i-Gear"></i>
                                <span class="item-name">Suppliers</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('employees.index')}}">
                                <i class="nav-icon i-Financial"></i>
                                <span class="item-name">Employees</span>
                            </a>
                        </li>
                        </ul>
                    <!-- <li class="nav-item">
                        <a href="#dashboard_version_4">
                            <i class="nav-icon i-Clock"></i>
                            <span class="item-name">Version 4</span>
                        </a>
                    </li>
                -->
                <ul class="childNav" data-parent="forms">
                    <li class="nav-item">
                        <a href="#forms-basic">
                            <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                            <span class="item-name">Basic Elements</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#form-layouts">
                            <i class="nav-icon i-Split-Vertical"></i>
                            <span class="item-name">Form Layouts</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#form-input-group">
                            <i class="nav-icon i-Receipt-4"></i>
                            <span class="item-name">Input Groups</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#form-validation">
                            <i class="nav-icon i-Close-Window"></i>
                            <span class="item-name">Form Validation</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#smartWizard">
                            <i class="nav-icon i-Width-Window"></i>
                            <span class="item-name">Smart Wizard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#tagInput">
                            <i class="nav-icon i-Tag-2"></i>
                            <span class="item-name">Tag Input</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#form-editor">
                            <i class="nav-icon i-Pen-2"></i>
                            <span class="item-name">Rich Editor</span>
                        </a>
                    </li>
                </ul>
                <ul class="childNav" data-parent="apps">
                    <li class="nav-item">
                        <a href="#invoice">
                            <i class="nav-icon i-Add-File"></i>
                            <span class="item-name">Invoice</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#inbox">
                            <i class="nav-icon i-Email"></i>
                            <span class="item-name">Inbox</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#chat">
                            <i class="nav-icon i-Speach-Bubble-3"></i>
                            <span class="item-name">Chat</span>
                        </a>
                    </li>
                </ul>
                <ul class="childNav" data-parent="extrakits">
                    <li class="nav-item">
                        <a href="#imageCroper">
                            <i class="nav-icon i-Crop-2"></i>
                            <span class="item-name">Image Cropper</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#loader">
                            <i class="nav-icon i-Loading-3"></i>
                            <span class="item-name">Loaders</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#laddaButton">
                            <i class="nav-icon i-Loading-2"></i>
                            <span class="item-name">Ladda Buttons</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#toastr">
                            <i class="nav-icon i-Bell"></i>
                            <span class="item-name">Toastr</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#sweetAlert">
                            <i class="nav-icon i-Approved-Window"></i>
                            <span class="item-name">Sweet Alerts</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#tour">
                            <i class="nav-icon i-Plane"></i>
                            <span class="item-name">User Tour</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#upload">
                            <i class="nav-icon i-Data-Upload"></i>
                            <span class="item-name">Upload</span>
                        </a>
                    </li>
                </ul>
                {{-- <ul class="childNav" data-parent="uikits">
                    <li class="nav-item"> --}}
                    <!-- <a href="#alerts">
                            <i class="nav-icon i-Bell1"></i>
                            <span class="item-name">Alerts</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#accordion">
                            <i class="nav-icon i-Split-Horizontal-2-Window"></i>
                            <span class="item-name">Accordion</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#badges">
                            <i class="nav-icon i-Medal-2"></i>
                            <span class="item-name">Badges</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#buttons">
                            <i class="nav-icon i-Cursor-Click"></i>
                            <span class="item-name">Buttons</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#cards">
                            <i class="nav-icon i-Line-Chart-2"></i>
                            <span class="item-name">Cards</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#cards-mertics">
                            <i class="nav-icon i-ID-Card"></i>
                            <span class="item-name">Card Metrics</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#carousel">
                            <i class="nav-icon i-Video-Photographer"></i>
                            <span class="item-name">Carousels</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#lists">
                            <i class="nav-icon i-Belt-3"></i>
                            <span class="item-name">Lists</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#pagination">
                            <i class="nav-icon i-Arrow-Next"></i>
                            <span class="item-name">Paginations</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#popover">
                            <i class="nav-icon i-Speach-Bubble-2"></i>
                            <span class="item-name">Popover</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#progressbar">
                            <i class="nav-icon i-Loading"></i>
                            <span class="item-name">Progressbar</span>
                        </a>
                    </li> -->
                    {{-- <li class="nav-item">
                        <a href="#tables">
                            <i class="nav-icon i-File-Horizontal-Text"></i>
                            <span class="item-name">Create Order</span>
                        </a>
                    </li> --}}
                    <!-- <li class="nav-item">
                        <a href="#tabs">
                            <i class="nav-icon i-New-Tab"></i>
                            <span class="item-name">Tabs</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#tooltip">
                            <i class="nav-icon i-Speach-Bubble-8"></i>
                            <span class="item-name">Tooltip</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#modals">
                            <i class="nav-icon i-Duplicate-Window"></i>
                            <span class="item-name">Modals</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#NoUislider">
                            <i class="nav-icon i-Width-Window"></i>
                            <span class="item-name">Sliders</span>
                        </a>
                    </li>
                </ul> -->
                <ul class="childNav" data-parent="sessions">
                    <li class="nav-item">
                        <a href="#signIn">
                            <i class="nav-icon i-Checked-User"></i>
                            <span class="item-name">Sign in</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#signUp">
                            <i class="nav-icon i-Add-User"></i>
                            <span class="item-name">Sign up</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#forgot">
                            <i class="nav-icon i-Find-User"></i>
                            <span class="item-name">Forgot</span>
                        </a>
                    </li>
                </ul>
                <ul class="childNav" data-parent="others">
                    <li class="nav-item">
                        <a href="#notFound">
                            <i class="nav-icon i-Error-404-Window"></i>
                            <span class="item-name">Not Found</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#user-profile">
                            <i class="nav-icon i-Male"></i>
                            <span class="item-name">User Profile</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#starter" class="open">
                            <i class="nav-icon i-File-Horizontal"></i>
                            <span class="item-name">Blank Page</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="sidebar-overlay"></div>
        </div>
        <!--=============== Left side End ================-->

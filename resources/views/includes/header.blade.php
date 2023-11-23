<div class="leftside-menu">

    <!-- Brand Logo Light -->
    <a href="{{route('dashboard')}}" class="logo logo-light">
                    <span class="logo-lg">
                        <img src="{{asset('hyper/saas/assets/images/logo.png')}}" alt="logo">
                    </span>
        <span class="logo-sm">
                        <img src="{{asset('hyper/saas/assets/images/logo-sm.png')}}" alt="small logo">
                    </span>
    </a>

    <!-- Brand Logo Dark -->
    <a href="index.html" class="logo logo-dark">
                    <span class="logo-lg">
                        <img src="{{asset('hyper/saas/assets/images/logo-dark.png')}}" alt="dark logo">
                    </span>
        <span class="logo-sm">
                        <img src="{{asset('hyper/saas/assets/images/logo-dark-sm.png')}}" alt="small logo">
                    </span>
    </a>

    <!-- Sidebar Hover Menu Toggle Button -->
    <div class="button-sm-hover" data-bs-toggle="tooltip" data-bs-placement="right" title="Show Full Sidebar">
        <i class="ri-checkbox-blank-circle-line align-middle"></i>
    </div>

    <!-- Full Sidebar Menu Close Button -->
    <div class="button-close-fullsidebar">
        <i class="ri-close-fill align-middle"></i>
    </div>

    <!-- Sidebar -left -->
    <div class="h-100" id="leftside-menu-container" data-simplebar>

        <!--- Sidemenu -->
        <ul class="side-nav">

            <li class="side-nav-title">Menu</li>

            <li class="side-nav-item">
                <a href="{{route('cards')}}" class="side-nav-link">
                    <i class="uil-calender"></i>
                    <span>Cartões</span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="{{route('category')}}" class="side-nav-link">
                    <i class="uil-shop"></i>
                    <span>Categoria</span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="{{route('responsive')}}" class="side-nav-link">
                    <i class=" uil-user-circle"></i>
                    <span>Responsavel</span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="{{route('launch')}}" class="side-nav-link">
                    <i class="uil-shopping-trolley"></i>
                    <span>Lançamento</span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="{{route('invoice')}}" class="side-nav-link">
                    <i class="uil-file-minus-alt"></i>
                    <span>Fatura Mensal</span>
                </a>
            </li>

            {{--            <li class="side-nav-item">--}}
            {{--                <form method="POST" action="{{ route('logout') }}">--}}
            {{--                    @csrf--}}
            {{--                    <x-dropdown-link :href="route('logout')"--}}
            {{--                                     onclick="event.preventDefault();--}}
            {{--                                                this.closest('form').submit();">--}}
            {{--                        {{ __('Sair') }}--}}
            {{--                    </x-dropdown-link>--}}
            {{--                </form>--}}
            {{--            </li>--}}
            {{--            <li class="side-nav-item">--}}
            {{--                <a data-bs-toggle="collapse" href="#sidebarDashboards" aria-expanded="false" aria-controls="sidebarDashboards" class="side-nav-link">--}}
            {{--                    <i class="uil-home-alt"></i>--}}
            {{--                    <span class="badge bg-success float-end">5</span>--}}
            {{--                    <span> Relatorios </span>--}}
            {{--                </a>--}}
            {{--                <div class="collapse" id="sidebarDashboards">--}}
            {{--                    <ul class="side-nav-second-level">--}}
            {{--                        <li>--}}
            {{--                            <a href="dashboard-analytics.html">Analytics</a>--}}
            {{--                        </li>--}}
            {{--                        <li>--}}
            {{--                            <a href="index.html">Ecommerce</a>--}}
            {{--                        </li>--}}
            {{--                        <li>--}}
            {{--                            <a href="dashboard-projects.html">Projects</a>--}}
            {{--                        </li>--}}
            {{--                        <li>--}}
            {{--                            <a href="dashboard-crm.html">CRM</a>--}}
            {{--                        </li>--}}
            {{--                        <li>--}}
            {{--                            <a href="dashboard-wallet.html">E-Wallet</a>--}}
            {{--                        </li>--}}
            {{--                    </ul>--}}
            {{--                </div>--}}
            {{--            </li>--}}


            <li class="side-nav-title">Components</li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarBaseUI" aria-expanded="false" aria-controls="sidebarBaseUI"
                   class="side-nav-link">
                    <i class="uil-box"></i>
                    <span> Base UI </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarBaseUI">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="ui-accordions.html">Accordions & Collapse</a>
                        </li>
                        <li>
                            <a href="ui-alerts.html">Alerts</a>
                        </li>
                        <li>
                            <a href="ui-avatars.html">Avatars</a>
                        </li>
                        <li>
                            <a href="ui-badges.html">Badges</a>
                        </li>
                        <li>
                            <a href="ui-breadcrumb.html">Breadcrumb</a>
                        </li>
                        <li>
                            <a href="ui-buttons.html">Buttons</a>
                        </li>
                        <li>
                            <a href="ui-cards.html">Cards</a>
                        </li>
                        <li>
                            <a href="ui-carousel.html">Carousel</a>
                        </li>
                        <li>
                            <a href="ui-dropdowns.html">Dropdowns</a>
                        </li>
                        <li>
                            <a href="ui-embed-video.html">Embed Video</a>
                        </li>
                        <li>
                            <a href="ui-grid.html">Grid</a>
                        </li>
                        <li>
                            <a href="ui-list-group.html">List Group</a>
                        </li>
                        <li>
                            <a href="ui-modals.html">Modals</a>
                        </li>
                        <li>
                            <a href="ui-notifications.html">Notifications</a>
                        </li>
                        <li>
                            <a href="ui-offcanvas.html">Offcanvas</a>
                        </li>
                        <li>
                            <a href="ui-placeholders.html">Placeholders</a>
                        </li>
                        <li>
                            <a href="ui-pagination.html">Pagination</a>
                        </li>
                        <li>
                            <a href="ui-popovers.html">Popovers</a>
                        </li>
                        <li>
                            <a href="ui-progress.html">Progress</a>
                        </li>
                        <li>
                            <a href="ui-ribbons.html">Ribbons</a>
                        </li>
                        <li>
                            <a href="ui-spinners.html">Spinners</a>
                        </li>
                        <li>
                            <a href="ui-tabs.html">Tabs</a>
                        </li>
                        <li>
                            <a href="ui-tooltips.html">Tooltips</a>
                        </li>
                        <li>
                            <a href="ui-links.html">Links</a>
                        </li>
                        <li>
                            <a href="ui-typography.html">Typography</a>
                        </li>
                        <li>
                            <a href="ui-utilities.html">Utilities</a>
                        </li>
                    </ul>
                </div>
            </li>
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <li class="side-nav-item">
                    <button type="submit" class="side-nav-link" style="width: 100%; text-align: justify">
                        <i class="uil-exit"></i>
                        <span>Sair</span>
                    </button>
                </li>
            </form>
        </ul>
        <!--- End Sidemenu -->

        <div class="clearfix"></div>
    </div>
</div>
<!-- ========== Left Sidebar End ========== -->

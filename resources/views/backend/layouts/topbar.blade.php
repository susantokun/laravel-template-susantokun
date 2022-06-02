<div class="topbar">
    <div class="hidden p-2 overflow-hidden rounded-md cursor-pointer hover:bg-slate-300/90 toggle xl:block bg-slate-200 topbar__menu">
        <i
            data-feather="menu"
            class="w-5 h-5 text-primary dark:text-slate-500 topbar__menu__icon"
        ></i>
        {{-- <i
            data-feather="x"
            class="w-5 h-5 text-primary dark:text-slate-500"
        ></i> --}}
    </div>
    <!-- BEGIN: Breadcrumb -->
    <nav
        aria-label="breadcrumb"
        class="hidden ml-0 mr-auto xl:ml-3 -intro-x sm:flex"
    >
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li
                class="breadcrumb-item active"
                aria-current="page"
            >Dashboard</li>
        </ol>
    </nav>
    <!-- END: Breadcrumb -->
    <!-- BEGIN: Search -->
    {{-- <div class="relative mr-3 intro-x sm:mr-6">
        <div class="hidden search sm:block">
            <input
                type="text"
                class="border-transparent search__input form-control"
                placeholder="Search..."
            >
            <i
                data-feather="search"
                class="search__icon dark:text-slate-500"
            ></i>
        </div>
        <a
            class="notification sm:hidden"
            href=""
        >
            <i
                data-feather="search"
                class="notification__icon dark:text-slate-500"
            ></i>
        </a>
        <div class="search-result">
            <div class="search-result__content">
                <div class="search-result__content__title">Pages</div>
                <div class="mb-5">
                    <a
                        href=""
                        class="flex items-center"
                    >
                        <div class="flex items-center justify-center w-8 h-8 rounded-full bg-success/20 dark:bg-success/10 text-success">
                            <i
                                class="w-4 h-4"
                                data-feather="inbox"
                            ></i>
                        </div>
                        <div class="ml-3">Mail Settings</div>
                    </a>
                    <a
                        href=""
                        class="flex items-center mt-2"
                    >
                        <div class="flex items-center justify-center w-8 h-8 rounded-full bg-pending/10 text-pending">
                            <i
                                class="w-4 h-4"
                                data-feather="users"
                            ></i>
                        </div>
                        <div class="ml-3">Users & Permissions</div>
                    </a>
                    <a
                        href=""
                        class="flex items-center mt-2"
                    >
                        <div class="flex items-center justify-center w-8 h-8 rounded-full bg-primary/10 dark:bg-primary/20 text-primary/80">
                            <i
                                class="w-4 h-4"
                                data-feather="credit-card"
                            ></i>
                        </div>
                        <div class="ml-3">Transactions Report</div>
                    </a>
                </div>
                <div class="search-result__content__title">Users</div>
                <div class="mb-5">
                    ok
                </div>
                <div class="search-result__content__title">Products</div>
                ok
            </div>
        </div>
    </div> --}}
    <!-- END: Search -->
    <!-- BEGIN: Notifications -->
    <div class="mr-auto intro-x dropdown sm:mr-6">
        <div
            class="cursor-pointer dropdown-toggle notification notification--bullet"
            role="button"
            aria-expanded="false"
            data-tw-toggle="dropdown"
        >
            <i
                data-feather="bell"
                class="notification__icon dark:text-slate-500"
            ></i>
        </div>
        <div class="pt-2 notification-content dropdown-menu">
            <div class="notification-content__box dropdown-content">
                <div class="notification-content__title">Notifications</div>
            </div>
        </div>
    </div>
    <!-- END: Notifications -->
    <!-- BEGIN: Account Menu -->
    <div class="w-8 h-8 intro-x dropdown">
        <div
            class="w-8 h-8 overflow-hidden rounded-full shadow-lg dropdown-toggle image-fit zoom-in"
            role="button"
            aria-expanded="false"
            data-tw-toggle="dropdown"
        >
            <img
                alt="Rubick Tailwind HTML Admin Template"
                src="{{ env('APP_URL_ASSET').'/images/profiles/avatar192.png' }}"
            >
        </div>
        <div class="w-56 dropdown-menu">
            <ul class="text-white dropdown-content bg-primary">
                <li class="p-2">
                    <div class="font-medium">{{ auth()->user()->name }}</div>
                    <div class="text-xs text-white/70 mt-0.5 dark:text-slate-500">{{ auth()->user()->getRoleNames()[0] }}</div>
                </li>
                <li>
                    <hr class="dropdown-divider border-white/[0.08]">
                </li>
                <li>
                    <a
                        href=""
                        class="dropdown-item hover:bg-white/5"
                    >
                        <i
                            data-feather="user"
                            class="w-4 h-4 mr-2"
                        ></i> Profile
                    </a>
                </li>
                <li>
                    <a
                        href=""
                        class="dropdown-item hover:bg-white/5"
                    >
                        <i
                            data-feather="edit"
                            class="w-4 h-4 mr-2"
                        ></i> Add Account
                    </a>
                </li>
                <li>
                    <a
                        href=""
                        class="dropdown-item hover:bg-white/5"
                    >
                        <i
                            data-feather="lock"
                            class="w-4 h-4 mr-2"
                        ></i> Reset Password
                    </a>
                </li>
                <li>
                    <a
                        href=""
                        class="dropdown-item hover:bg-white/5"
                    >
                        <i
                            data-feather="help-circle"
                            class="w-4 h-4 mr-2"
                        ></i> Help
                    </a>
                </li>
                <li>
                    <hr class="dropdown-divider border-white/[0.08]">
                </li>
                <li>
                    <form
                        method="POST"
                        action="{{ route('logout') }}"
                    >
                        @csrf
                        <a
                            href="{{ route('logout') }}"
                            class="dropdown-item hover:bg-white/5"
                            onclick="event.preventDefault(); this.closest('form').submit();"
                        >
                            <i
                                data-feather="toggle-right"
                                class="w-4 h-4 mr-2"
                            ></i> Logout
                        </a>
                    </form>


                </li>
            </ul>
        </div>
    </div>
    <!-- END: Account Menu -->
</div>
<!-- END: Top Bar -->

<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="route('forum.index')" :active="request()->routeIs('forum')">
                        {{ __('Forum') }}
                    </x-nav-link>

                    <!-- Add Community Link -->
                    <x-nav-link :href="route('community.index')" :active="request()->routeIs('community.index')">
                        {{ __('Community') }}
                    </x-nav-link>

                    <!-- **Add Watched Threads Link** -->
                    @auth
                        <x-nav-link :href="route('forum.watched')" :active="request()->routeIs('forum.watched')">
                            {{ __('Watched Threads') }}
                        </x-nav-link>
                    @endauth

                    <!-- Admin Link for Admin Users -->
                    @auth
                        @if(Auth::user()->isAdmin())
                            <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                                {{ __('Admin Panel') }}
                            </x-nav-link>
                        @endif
                    @endauth
                </div>
            </div>

            <!-- Authentication Links -->
             <div class="hidden sm:flex sm:items-center sm:ms-6">
                @guest
                    <!-- Login Link -->
                    <a href="{{ route('login') }}" class="text-gray-500 hover:text-gray-700">
                        {{ __('Login') }}
                    </a>

                    <!-- Register Link -->
                    <a href="{{ route('register') }}" class="ml-4 text-gray-500 hover:text-gray-700 pr-10">
                        {{ __('Register') }}
                    </a>
                @endguest
                <select id="fontSizeSelector" class="bg-gray-100 border rounded-md py-1 px-2 text-gray-700 pr-10">
                <option value="small">Smaller font</option>
                    <option value="normal">Default font</option>
                <option value="large">Bigger font</option>
                </select>


                <button id="contrastButton" class="bg-gray-100 border rounded-md py-1 px-2 text-gray-700">Change contrast</button>
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div>
                                    {{ Auth::user()->name }}
                                </div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Logout Form -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @endauth
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('forum.index')" :active="request()->routeIs('forum')">
                {{ __('Forum') }}
            </x-responsive-nav-link>

            <!-- Add Community Link for mobile -->
            <x-responsive-nav-link :href="route('community.index')" :active="request()->routeIs('community.index')">
                {{ __('Community') }}
            </x-responsive-nav-link>

            <!-- **Add Watched Threads Link for mobile** -->
            @auth
                <x-responsive-nav-link :href="route('forum.watched')" :active="request()->routeIs('forum.watched')">
                    {{ __('Watched Threads') }}
                </x-responsive-nav-link>
            @endauth


            <!-- Admin Link for Admin Users in Mobile View -->
            @auth
                @if(Auth::user()->isAdmin())
                    <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                        {{ __('Admin Panel') }}
                    </x-responsive-nav-link>
                @endif
            @endauth
        </div>

        <!-- Authentication Links for Mobile -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                @guest
                    <p>You are not logged in.</p>
                @endguest

                @auth
                    <p>Logged in as: {{ Auth::user()->name }}</p>
                @endauth
            </div>

            <div class="mt-3 space-y-1">
                @guest
                    <!-- Login Link -->
                    <x-responsive-nav-link :href="route('login')">
                        {{ __('Login') }}
                    </x-responsive-nav-link>

                    <!-- Register Link -->
                    <x-responsive-nav-link :href="route('register')">
                        {{ __('Register') }}
                    </x-responsive-nav-link>
                @endguest

                @auth
                    <!-- Profile Link -->
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <!-- Logout Form -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                @endauth
            </div>
        </div>
    </div>
</nav>
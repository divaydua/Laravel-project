<nav x-data="{ open: false }" class="bg-gray-800 shadow-md">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <!-- Uncomment and replace with your logo if needed -->
                        <!-- <img src="{{ asset('/images/logo.webp') }}" alt="Logo" class="h-8 w-auto"> -->
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:ml-10 sm:flex items-center">
                    <a href="{{ route('dashboard') }}" class="text-white font-semibold hover:text-gray-300">
                        {{ __('Dashboard') }}
                    </a>
                    <a href="{{ route('weather.index') }}" class="text-white font-semibold hover:text-gray-300">
    Weather
</a>
                    <a href="{{ route('posts.index') }}" class="text-white font-semibold hover:text-gray-300">
                        {{ __('Posts') }}
                    </a>
                    <li>
                <a href="{{ route('notifications.index') }}" class="text-white font-semibold hover:text-gray-900">
                  Notifications ({{ App\Models\Notification::where('receiver_id', auth()->id())->where('is_read', false)->count() }})
      </a>
</li>
</a>
    <a href="{{ route('profiles.index') }}" class="text-white font-semibold hover:text-gray-300">
        {{ __('My Profile') }}
    </a>
    <a href="{{ route('quotes.random') }}" class="text-white hover:text-gray-300">
                    Random Quote
                </a>
                <a href="{{ route('quotes.byAuthor', ['author' => 'Albert Einstein']) }}" class="text-white hover:text-gray-300">
    Quotes by Author
</a>
                </div>
            </div>

            <!-- Settings Dropdown -->
            @if(Auth::check())
                <div class="hidden sm:flex sm:items-center">
                    <div class="relative">
                        <button @click="open = !open" class="flex items-center text-sm font-medium text-white focus:outline-none">
                            <img src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : '/images/default-avatar.jpg' }}" 
                                 alt="User Avatar" 
                                 class="h-8 w-8 rounded-full border border-gray-500">
                            <span class="ml-2">{{ Auth::user()->name }}</span>
                            <svg class="ml-2 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7 7 7-7" />
                            </svg>
                        </button>
                        <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-20">
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                {{ __('Profile') }}
                            </a>
                            <form method="POST" action="{{ route('logout') }}" class="block">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    {{ __('Log Out') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-md text-white hover:text-gray-300 focus:outline-none">
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path :class="{'hidden': open, 'inline-flex': ! open}" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open}" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</nav>
@php
    $primaryNavigationItems = app()->getNavigationItems('primary-navigation-menu');
    $userNavigationMenu = app()->getNavigationItems('user-navigation-menu');
    $isGlobalNavigationEnabled = App\Facades\Plugin::getPlugin('Tempest')->getSetting('global_navigation')
@endphp

@if($isGlobalNavigationEnabled)
<div class="navbar-publisher navbar-container bg-white shadow z-[51] text-gray-800">
    <div class="navbar mx-auto max-w-7xl items-center h-full flex flex-col">
        <div class="w-full flex flex-row justify-between items-center py-2">
            <div class="navbar-start flex items-center gap-x-4 pl-4">
                <x-website::logo class="font-oswald" :headerLogo="app()->getSite()->getFirstMedia('logo')?->getAvailableUrl(['thumb', 'thumb-xl'])" :headerLogoAltText="app()->getSite()->getMeta('name')" :homeUrl="url('/')"/>
                @if(App\Models\Conference::exists())
                    @livewire(App\Livewire\GlobalNavigation::class)
                @endif
            </div>
            <div class="navbar-end ms-auto gap-x-4 flex items-center">
                <x-website::navigation-menu :items="$userNavigationMenu" class="text-gray-800" />
            </div>
        </div>
        <hr class="w-full border-t border-gray-500 my-2" />
        <div class="w-full flex flex-row justify-between items-center">
            <div class="hidden lg:flex w-full justify-start pl-4">
                <x-website::navigation-menu :items="$primaryNavigationItems" class="text-gray-800" />
            </div>
        </div>
    </div>
</div>
@endif

@if(app()->getCurrentConference() || app()->getCurrentScheduledConference())
    <div id="navbar" class="navbar-container bg-primary sticky top-0 text-white shadow z-50">
        <div class="backdrop-blur-md py-5 transition-all duration-100 flex flex-col">
            <div class="w-full flex flex-row justify-between items-center">
                <div class="navbar-start flex items-center gap-2 pl-9">
                    <x-website::navigation-menu-mobile />
                    <x-website::logo class="font-oswald" :headerLogo="$headerLogo"/>
                </div>
                <div class="navbar-end flex relative z-10 items-center">
                    <x-tempest::navigation-menu :items="$userNavigationMenu" class="flex items-center gap-2" />
                </div>
            </div>
            <hr class="w-full border-t border-gray-500 my-2" />
            <div class="w-full flex flex-row justify-between items-center">
                <div class="hidden lg:flex w-full justify-start pl-4">
                    <x-website::navigation-menu :items="$primaryNavigationItems" class="text-gray-800 holographic-card" />
                </div>
            </div>
        </div>
    </div>
@endif

<script>
function handleNavbarScroll() {
    const navbar = document.getElementById('navbar');
    const scrollPosition = window.scrollY;
    if (navbar) {
        if (scrollPosition > 50) {
            navbar.classList.remove('bg-black/50', 'text-white');
            navbar.classList.add('bg-white', 'text-black');
        } else {
            navbar.classList.remove('bg-white', 'text-black');
            navbar.classList.add('bg-black/50', 'text-white');
        }
    }
}
window.addEventListener('scroll', handleNavbarScroll);
handleNavbarScroll();
</script>
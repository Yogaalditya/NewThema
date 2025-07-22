@php
    $primaryNavigationItems = app()->getNavigationItems('primary-navigation-menu');
    $userNavigationMenu = app()->getNavigationItems('user-navigation-menu');
    $isGlobalNavigationEnabled = App\Facades\Plugin::getPlugin('Tempest')->getSetting('global_navigation')
@endphp

<<<<<<< HEAD
@if($isGlobalNavigationEnabled)
<div class="navbar-publisher navbar-container bg-white shadow z-[51] text-gray-800">
    <div class="navbar mx-auto max-w-7xl items-center h-full">
        <div class="navbar-start items-center gap-x-4 w-max">
=======

@if($isGlobalNavigationEnabled)
<div class="navbar-publisher navbar-container bg-white shadow z-[51] text-gray-800">
    <div class="navbar mx-auto max-w-7xl h-full flex items-center justify-between px-6">
        <div class="flex items-center gap-x-4 min-w-0">
>>>>>>> 3c54a4d (Rework navbar: UI modern, garis horizontal, font custom, dropdown user menu di atas garis, dan perbaikan responsif)
            <x-website::logo :headerLogo="app()->getSite()->getFirstMedia('logo')?->getAvailableUrl(['thumb', 'thumb-xl'])" :headerLogoAltText="app()->getSite()->getMeta('name')" :homeUrl="url('/')"/>
            @if(App\Models\Conference::exists())
                @livewire(App\Livewire\GlobalNavigation::class)
            @endif
<<<<<<< HEAD

        </div>
        
        <div class="navbar-end ms-auto gap-x-4 hidden lg:inline-flex">
=======
        </div>
        <div class="flex items-center gap-x-4">
>>>>>>> 3c54a4d (Rework navbar: UI modern, garis horizontal, font custom, dropdown user menu di atas garis, dan perbaikan responsif)
            <x-website::navigation-menu :items="$userNavigationMenu" class="text-gray-800" />
        </div>
    </div>
</div>
<<<<<<< HEAD
    
@endif

@if(app()->getCurrentConference() || app()->getCurrentScheduledConference())
    <div id="navbar" class="navbar-container bg-primary sticky top-0 text-white shadow z-50">
        <div class="backdrop-blur-md py-5 transition-all duration-100">
            <div class="navbar mx-auto max-w-7xl justify-between">
                <div class="navbar-start items-center w-max gap-2">
                    <x-website::navigation-menu-mobile />
                    <x-website::logo :headerLogo="$headerLogo"/>
                </div>
                <div class="navbar-end hidden lg:flex relative z-10 w-max">
                    <x-website::navigation-menu :items="$primaryNavigationItems" />
                </div>
                @if(!$isGlobalNavigationEnabled)
                <div class="user-nav flex items-center">
                    <x-tempest::navigation-menu 
                        :items="$userNavigationMenu"
                        class="flex items-center gap-4" />
                </div>
                @endif
            </div>
        </div>
        
=======
@endif


@if(app()->getCurrentConference() || app()->getCurrentScheduledConference())
    <div id="navbar" class="navbar-container bg-primary sticky top-0 text-white shadow z-50 relative">
        <div class="py-2 transition-all duration-100" style="background: transparent; min-height:48px;">
            <div class="navbar mx-auto flex flex-col px-6 min-h-0">
                <div class="flex items-center justify-between gap-2 min-w-0 w-full">
                    <div class="flex items-center gap-2 min-w-0">
                        <x-website::navigation-menu-mobile />
                        <x-website::logo :headerLogo="$headerLogo"/>
                    </div>
                    @if(!$isGlobalNavigationEnabled)
                    <div class="user-nav flex items-center">
                        <x-tempest::navigation-menu 
                            :items="$userNavigationMenu"
                            class="flex items-center gap-4" />
                    </div>
                    @endif
                </div>
            </div>
            <div class="w-full border-b-2 border-[#d7dee1] opacity-70 my-2"></div>
            <div class="navbar mx-auto flex flex-col px-2">
                <div class="w-full flex flex-col lg:flex-row lg:items-center lg:justify-between">
                    <div class="w-full lg:w-auto flex justify-center lg:justify-start">
                        <div class="hidden lg:flex relative z-10 w-full">
                            <x-website::navigation-menu :items="$primaryNavigationItems" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
>>>>>>> 3c54a4d (Rework navbar: UI modern, garis horizontal, font custom, dropdown user menu di atas garis, dan perbaikan responsif)
    </div>
@endif

<script>

function handleNavbarScroll() {
    const navbar = document.getElementById('navbar');
    const scrollPosition = window.scrollY;

    if (scrollPosition > 50) {
        navbar.classList.remove('bg-black/50', 'text-white');
        navbar.classList.add('bg-white', 'text-black');
    } else {
        navbar.classList.remove('bg-white', 'text-black');
        navbar.classList.add('bg-black/50', 'text-white');
    }
}

window.addEventListener('scroll', handleNavbarScroll);
handleNavbarScroll();
</script>

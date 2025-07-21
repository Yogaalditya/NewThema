@props([
    'items' => [],
])
@php
$user = Auth::user();

$profilePhotoUrl = null;

if ($user) {
    $profilePhotoUrl = $user->getFirstMediaUrl('profile', 'thumb');
}
@endphp
<nav class="relative">
    <ul class="navbar-items flex items-center justify-center flex-1 p-1 space-x-1 list-none group">
        @foreach ($items as $key => $item)
            @if(!$item->isDisplayed())
                @continue
            @endif

            @if ($item->children->isEmpty())
            <li>
                <x-tempest::link
                    class="navigation-menu-item btn no-animation btn-ghost btn-sm rounded-lg inline-flex items-center justify-center px-4 transition-colors focus:outline-none disabled:opacity-50 disabled:pointer-events-none group w-max gap-0 ease-out duration-300"
                    :href="$item->getUrl()"
                >
                    <span>{{ $item->getLabel() }}</span>
                </x-tempest::link>
            </li>

            @else
                <li x-data="{ open: false }" 
                    x-on:mouseover="open = true" x-on:mouseleave="open = false"
                    >
                    <button 
                        x-ref="button"
                        @@click="open = !open"
                        class="navigation-menu-item btn btn-ghost no-animation btn-sm rounded-lg inline-flex items-center justify-center px-4 transition-colors focus:outline-none disabled:opacity-50 disabled:pointer-events-none group w-max gap-0 ease-out duration-300"
                        >
                        <x-heroicon-m-chevron-down class="transition relative top-[1px] h-5 w-5" x-bind:class="{ '-rotate-180': open}" />
                        @if ($profilePhotoUrl)
                            <img src="{{ $profilePhotoUrl }}" alt="Profile Photo" class="w-10 h-10 ml-1 rounded-full">
                        @else
                            <span class="ml-1">{{ $item->getLabel() }}</span>
                        @endif
                    </button>
                    <div 
                        x-show="open"
                        x-transition
                        x-anchor.bottom-end="$refs.button"
                        x-cloak
                        class="navbar-dropdown-content text-gray-800"
                        >
                        <div class="flex flex-col divide-y mt-1 min-w-[12rem] bg-white rounded-md shadow-md">
                            @foreach ($item->children as $key => $childItem)
                                <x-tempest::link
                                    class="first:rounded-t-md last:rounded-b-md relative flex hover:bg-base-content/10 items-center py-2 px-4 pr-6 text-sm outline-none transition-colors gap-4 w-full"
                                    :href="$childItem->getUrl()">
                                    {{ $childItem->getLabel() }}
                                </x-tempest::link>
                            @endforeach
                        </div>
                    </div>
                </li>
            @endif
        @endforeach
    </ul>
</nav>

@php
    /** @var \App\Services\MenuBuilder\MenuItem $item */
@endphp
<div>
    @foreach($menu as $item)
        @if($item->hasChildren())
            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-body-secondary text-uppercase">
                <span>{{ $item->getLabel() }}</span>
            </h6>
            <ul class="nav flex-column mb-auto">
                @foreach($item->getChildren() as $child)
                    <x-sidebar-menu-item :label="$child->getLabel()" :icon="$child->getIcon()" :url="$child->getUrl()"></x-sidebar-menu-item>
                @endforeach
            </ul>
        @else
            <ul class="nav flex-column mb-auto">
                <x-sidebar-menu-item :label="$item->getLabel()" :icon="$item->getIcon()" :url="$item->getUrl()"></x-sidebar-menu-item>
            </ul>
        @endif
    @endforeach
</div>

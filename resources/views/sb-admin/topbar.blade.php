<nav class="navbar navbar-expand navbar-light bg-white topbar static-top shadow text-purple justify-content-between">

    <div class="d-flex align-items-center mr-2">
        <!-- Optional Icon -->
        @isset($icon)
            <i class="{{ $icon }} ms-3"></i>
        @endisset

        <!-- Title -->
        <div class="top-bar-brand-text ms-3  mb-0 font-weight-bold h4">
            {{ $title ?? 'Default Title' }}
        </div>
    </div>

    @php
        // Get the name of the current route
        $currentRouteName = Route::currentRouteName();

        // Remove ".index" or other suffixes from the route name
        $baseRouteName = Str::beforeLast($currentRouteName, '.index');

        // Append ".create" to the base route name
        $createRouteName = $baseRouteName . '.create';

        // Generate the full URL for the "create" route
        $createRouteUrl = Route::has($createRouteName) ? route($createRouteName) : '#';

        $showCreateButton = Str::endsWith($currentRouteName, '.index');

    @endphp
    @if ($showCreateButton)
        <div class="mr-3">


            <a href="{{ $createRouteUrl }}" class="btn btn-secondary">
                <i class="fas fa-plus"></i> Create
            </a>


        </div>
    @endif


</nav>

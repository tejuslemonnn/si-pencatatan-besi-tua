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
        $baseRouteName =
            Str::beforeLast($currentRouteName, '.index') ?:
            Str::beforeLast($currentRouteName, '.index-besi-tua') ?:
            Str::beforeLast($currentRouteName, '.index-besi-scrap');

        // Append ".create" to the base route name
        $createRouteName = $baseRouteName . '.create';

        // Generate the full URL for the "create" route
        $createRouteUrl = Route::has($createRouteName) ? route($createRouteName) : '#';

        // Determine if the current route ends with ".index"
        $showCreateButton =
            Str::endsWith($currentRouteName, '.index') ||
            Str::endsWith($currentRouteName, '.index-besi-tua') ||
            Str::endsWith($currentRouteName, '.index-besi-scrap');

        $showBack =
            Str::endsWith($currentRouteName, '.create') ||
            Str::endsWith($currentRouteName, '.show') ||
            Str::endsWith($currentRouteName, '.edit');
        $showSubmitButton = Str::endsWith($currentRouteName, '.create') || Str::endsWith($currentRouteName, '.edit');

        // If not ".index", create variable for back to ".index"
        $indexRouteName = Str::before($currentRouteName, '.') . '.index';

        // Generate the full URL for the "index" route
        $backToIndexUrl = Route::has($indexRouteName) ? route($indexRouteName) : '#';

    @endphp
    @if ($showCreateButton)
        <div class="mr-3">

            <a href="{{ $createRouteUrl }}" class="btn bg-purple text-white">
                <i class="fas fa-plus"></i> Create
            </a>


        </div>
    @else
        <div>
            @if ($showBack)
                <a href="{{ route($indexRouteName) }}" class="btn btn-danger mr-2"> <i class="fas fa-arrow-left"> </i>
                    Back</a>

                @if ($showSubmitButton)
                    <button type="button" class="btn btn-primary" id="submit_button"> <i class="fas fa-check">
                        </i>Save</button>
                @endif
        </div>
    @endif
    <script>
        document.getElementById('submit_button').addEventListener('click', function() {
            document.getElementById('add_form').submit();
        });
    </script>
    @endif


</nav>

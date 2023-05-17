@unless($breadcrumbs->isEmpty())
    {{-- <div class="breadcrumb"> --}}
        @foreach ($breadcrumbs as $breadcrumb)
            @if (!is_null($breadcrumb->url) && !$loop->last)
                <h2 class="breadcrumb-item"><a href="@{{ $breadcrumb - > url }}">{{ $breadcrumb->title }}</a>
                </h2>
            @else
                <h2 class="breadcrumb-item active">{{ $breadcrumb->title }}</h2>
            @endif
        @endforeach
    {{-- </div> --}}
@endunless

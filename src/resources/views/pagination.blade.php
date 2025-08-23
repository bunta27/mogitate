@if ($paginator->hasPages())
<nav class="pager" role="navigation" aria-label="Paginator">
    <ul class="pager__list">
        @if ($paginator->onFirstPage())
            <li class="disabled"><span aria-hidden="true"><</span></li>
        @else
            <li><a href="{{ $paginator->previousPagerUrl() }}" rel="prev" aria-label="@lang('previous')"><</a></li>
        @endif

        @foreach ($elements as $element)
            @if (is_string($element))
                <li class="disabled"><span>{{ $element }}</span></li>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active" aria-current="page"><span>{{ $page }}</span></li>
                    @else
                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <li><a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('next')">></a></li>
        @else
            <li class="disabled"><span aria-hidden="true">></span></li>
        @endif
    </ul>
</nav>
@endif
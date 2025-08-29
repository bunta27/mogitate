@if ($paginator->hasPages())
<nav class="pager" role="navigation" aria-label="Paginator">
    <ul class="pager__list">
        @if ($paginator->onFirstPage())
            <li class="disabled"><span aria-hidden="true"><</span></li>
        @else
            <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('previous')"><</a></li>
        @endif

        @for ($page = 1; $page <= 3; $page++)
            @if ($page == $paginator->currentPage())
                <li class="active"><span>{{ $page }}</span></li>
            @elseif ($page > $paginator->lastPage())
                <li class="disabled"><span>{{ $page }}</span></li>
            @else
                <li><a href="{{ $paginator->url($page) }}">{{ $page }}</a></li>
            @endif
        @endfor

        @if ($paginator->hasMorePages())
            <li><a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('next')">></a></li>
        @else
            <li class="disabled"><span aria-hidden="true">></span></li>
        @endif
    </ul>
</nav>
@endif
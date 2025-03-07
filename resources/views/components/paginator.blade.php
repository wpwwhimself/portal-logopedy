@if ($paginator->hasPages())
<nav role="paginator" aria-label="{{ __('Pagination Navigation') }}" class="flex right center middle">
    <x-button icon="page-first"
        :action="$paginator->url(1)"
        class="phantom small"
        :disabled="$paginator->onFirstPage()"
    />

    @foreach ($elements as $element)
        @if (is_string($element))
        <x-icon name="dots-horizontal" />
        @endif
        
        @if (is_array($element))
        @foreach ($element as $page => $url)
            @if (in_array($page, range($paginator->currentPage() - 4, $paginator->currentPage() + 4)))
            <x-button
                :action="$url"
                class="{{ $page == $paginator->currentPage() ? 'accent background secondary' : 'phantom' }} small"
                :disabled="$page == $paginator->currentPage()"
            >
                {{ $page }}
            </x-button>
            @endif
        @endforeach
        @endif
    @endforeach

    <x-button icon="page-last"
        :action="$paginator->url($paginator->lastPage())"
        class="phantom small"
        :disabled="!$paginator->hasMorePages()"
    />

    {{--
    <div>
        <p>
            Wyświetlanie
            @if ($paginator->firstItem())
                <span>{{ $paginator->firstItem() }}</span>
                -
                <span>{{ $paginator->lastItem() }}</span>
            @else
                {{ $paginator->count() }}
            @endif
            z
            <span>{{ $paginator->total() }}</span>
        </p>
    </div>
    --}}
</nav>
@endif

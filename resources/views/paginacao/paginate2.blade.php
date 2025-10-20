@if ($paginator->hasPages())
    <nav >
        <ul class="pagination justify-content-left " style="padding:0; margin:0; border:1px; font-size:12px;">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <a class="page-link" href="">
                        <b>&laquo;</b>
                    </a></li>
            @else
                <li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}">&laquo;</a></li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled">{{ $element }}</li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item">
                                <a class="page-link">
                                    {{ $page }}
                                </a>
                            </li>
                        @else
                            <li class="waves-effect"><a class="page-link"
                                    href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}">
                        &raquo;
                    </a>
                </li>
            @else
                <li class="page-item disabled ">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}">
                        &raquo;
                    </a>
            @endif

        </ul>
    </nav>
@endif


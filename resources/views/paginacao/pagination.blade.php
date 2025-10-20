@if ($paginator->hasPages())
    <nav aria-label="Pagination">
        <ul class="pagination justify-content-center m-0 flex-wrap gap-2">
            {{-- Previous Page Link --}}
            <li class="page-item {{ $paginator->onFirstPage() ? 'disabled' : '' }}">
                <a class="page-link px-3 py-2 rounded-start" href="{{ $paginator->previousPageUrl() }}" aria-label="Previous" {{ $paginator->onFirstPage() ? 'tabindex="-1"' : '' }}>
                    <span aria-hidden="true">&laquo;</span>
                    <span class="visually-hidden">Previous</span>
                </a>
            </li>

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled">
                        <span class="page-link px-3 py-2">{{ $element }}</span>
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        <li class="page-item {{ $page == $paginator->currentPage() ? 'active' : '' }}">
                            <a class="page-link px-3 py-2 {{ $page == $paginator->currentPage() ? 'fw-bold' : '' }}" 
                               href="{{ $page == $paginator->currentPage() ? '#' : $url }}" 
                               aria-label="Page {{ $page }}"
                               {{ $page == $paginator->currentPage() ? 'aria-current="page"' : '' }}>
                                {{ $page }}
                            </a>
                        </li>
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            <li class="page-item {{ !$paginator->hasMorePages() ? 'disabled' : '' }}">
                <a class="page-link px-3 py-2 rounded-end" href="{{ $paginator->nextPageUrl() }}" aria-label="Next" {{ !$paginator->hasMorePages() ? 'tabindex="-1"' : '' }}>
                    <span aria-hidden="true">&raquo;</span>
                    <span class="visually-hidden">Next</span>
                </a>
            </li>
        </ul>
    </nav>

    <style>
        .page-link {
            color: #2B2B2B; /* Cinza Grafite para texto */
            background-color: white;
            border: 1px solid #003e46; /* Champagne Dourado para bordas */
            transition: all 0.3s ease;
            min-width: 30px;
            text-align: center;
        }
        
        .page-link:hover {
            color: #003e46; /* Roxo Imperial no hover */
            background-color: #f8f1ff; /* Tom muito claro do roxo */
            border-color: #003e46; /* Roxo Imperial para borda no hover */
        }
        
        .page-item.active .page-link {
            background-color: #003e46; /* Roxo Imperial */
            border-color: #003e46;
            color: white;
        }
        
        .page-item.active .page-link:hover {
            background-color: #003e46; /* Tom mais escuro do roxo */
        }
        
        .page-item.disabled .page-link {
            color: #a0aec0;
            background-color: #f8f9fa;
            border-color: #003e46; /* Champagne Dourado mantido para bordas */
        }
        
        .pagination {
            gap: 6px;
        }
        
        /* Destaques especiais */
        .page-link:focus {
            box-shadow: 0 0 0 0.25rem hsl(187, 100%, 14%); /* Roxo Imperial com transparência */
            outline: none;
        }
    </style>
@endif
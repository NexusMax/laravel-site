@if ($paginator->hasPages())
    <div class="pagination-wrapper">
        <ul class="pagination_">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="pagination_item disabled btn wow fadeIn"><span>&laquo;</span></li>
            @else
                <?php
                    $uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);
                    $pag = $paginator->previousPageUrl();
                    if(mb_strpos($pag,'page=1')){
                        $pag = 'https://' . $_SERVER['HTTP_HOST'] . $uri_parts[0];
                    }
                ?>
                <li><a class="pagination_item btn wow fadeIn" href="{{ $pag }}" rel="prev">&laquo;</a></li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="pagination_item disabled btn wow fadeIn"><span>{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="pagination_item active btn wow fadeIn"><span>{{ $page }}</span></li>
                        @else
                            <?php
                            $uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);
                            $pag = $url;
                            if(mb_strpos($pag,'page=1')){
                                $pag = 'https://' . $_SERVER['HTTP_HOST'] . $uri_parts[0];
                            }
                            ?>
                            <li><a  class="pagination_item btn wow fadeIn" href="{{ $pag }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li><a  class="pagination_item btn wow fadeIn" href="{{ $paginator->nextPageUrl() }}">&raquo;</a></li>
            @else
                <li class="pagination_item disabled btn wow fadeIn"><span>&raquo;</span></li>
            @endif
        </ul>
    </div>
@endif

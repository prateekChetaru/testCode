@if ($paginator->hasPages())

<ul class="pagination">
    {{-- Previous Page Link --}}

    @if ($paginator->onFirstPage())
    <li class="prev"><a style="background: url({{ asset('public/images/page-arrow-left.png') }})no-repeat center center;"  href="#">Previous</a></li>
    
    @else
    <li class="prev"><a style="background: url({{ asset('public/images/page-arrow-left.png') }})no-repeat center center;"  href="{{ $paginator->previousPageUrl() }}">Previous</a></li>
    
    @endif

    {{-- Pagination Elements --}}

    @foreach ($elements as $element)

    {{-- "Three Dots" Separator --}}
    @if (is_string($element))
    <li class="disabled"><a  href="#">{{ $element }}</a></li>

    @endif

    {{-- Array Of Links --}}

    @if (is_array($element))

    @foreach ($element as $page => $url)

    @if ($page == $paginator->currentPage())
    <li class="active my-active"><a  href="#">{{ $page }}</a></li>

    @else
    <!-- <li class="active my-active"><a  href="#">{{ $page }}</a></li> -->
    <li><a href="{{ $url }}">{{ $page }}</a></li>

    @endif
    @endforeach
    @endif
    @endforeach
    {{-- Next Page Link --}}

    @if ($paginator->hasMorePages())
    <li class="next"><a style="background: url({{ asset('public/images/page-arrow-right.png') }})no-repeat center center;" href="{{ $paginator->nextPageUrl() }}">Next</a></li>

    @else    
    <li class="next"><a style="background: url({{ asset('public/images/page-arrow-right.png') }})no-repeat center center;" href="{{ $paginator->nextPageUrl() }}">Next</a></li>
    @endif
</ul>
@endif

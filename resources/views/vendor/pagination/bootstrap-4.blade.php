@if ($paginator->hasPages())
    <nav class="flexbox mt-30">
        @if ($paginator->onFirstPage())
            <a class="btn btn-white disabled"><i class="ti-arrow-left fs-9 mr-4"></i> Previous</a>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="btn btn-white">Previous <i class="ti-arrow-right fs-9 ml-4"></i></a>
        @endif

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="btn btn-white">Next <i class="ti-arrow-right fs-9 ml-4"></i></a>
        @else
            <a class="btn btn-white disabled"><i class="ti-arrow-left fs-9 mr-4"></i> Next</a>
        @endif
    </nav>
@endif


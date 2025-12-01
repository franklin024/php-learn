@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-between">

        {{-- Giao diện Mobile (Tối giản) --}}
        <div class="flex justify-between flex-1 sm:hidden">
            @if ($paginator->onFirstPage())
                <span
                    class="relative inline-flex items-center px-3 py-1 text-sm font-medium text-slate-400 bg-white border border-slate-200 cursor-default leading-5 rounded-md">
                    {!! __('pagination.previous') !!}
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}"
                    class="relative inline-flex items-center px-3 py-1 text-sm font-medium text-slate-600 bg-white border border-slate-200 leading-5 rounded-md hover:text-slate-800 hover:bg-slate-50 focus:outline-none focus:ring ring-slate-200 active:bg-slate-100 transition ease-in-out duration-150">
                    {!! __('pagination.previous') !!}
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                    class="relative inline-flex items-center px-3 py-1 ml-3 text-sm font-medium text-slate-600 bg-white border border-slate-200 leading-5 rounded-md hover:text-slate-800 hover:bg-slate-50 focus:outline-none focus:ring ring-slate-200 active:bg-slate-100 transition ease-in-out duration-150">
                    {!! __('pagination.next') !!}
                </a>
            @else
                <span
                    class="relative inline-flex items-center px-3 py-1 ml-3 text-sm font-medium text-slate-400 bg-white border border-slate-200 cursor-default leading-5 rounded-md">
                    {!! __('pagination.next') !!}
                </span>
            @endif
        </div>

        {{-- Giao diện Desktop (Đã sửa lỗi nút rời) --}}
        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-center">

            {{-- Container nút bấm: Dùng gap-1 để tách nút ra --}}
            <div class="flex gap-1">

                {{-- Nút Previous --}}
                @if ($paginator->onFirstPage())
                    <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                        <span
                            class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-slate-300 bg-white border border-slate-200 cursor-default rounded-md leading-5"
                            aria-hidden="true">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </span>
                    </span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                        class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-slate-500 bg-white border border-slate-200 rounded-md leading-5 hover:text-slate-600 hover:bg-slate-50 focus:z-10 focus:outline-none focus:ring ring-slate-200 active:bg-slate-100 active:text-slate-500 transition ease-in-out duration-150"
                        aria-label="{{ __('pagination.previous') }}">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                @endif

                {{-- Các trang số (1, 2, 3...) --}}
                @foreach ($elements as $element)
                    {{-- Dấu ba chấm "..." --}}
                    @if (is_string($element))
                        <span aria-disabled="true">
                            <span
                                class="relative inline-flex items-center px-3 py-1 text-sm font-medium text-slate-500 bg-white border border-slate-200 cursor-default rounded-md leading-5">{{ $element }}</span>
                        </span>
                    @endif

                    {{-- Mảng các trang --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                {{-- TRANG HIỆN TẠI: Bo tròn tất cả --}}
                                <span aria-current="page">
                                    <span
                                        class="relative inline-flex items-center px-3 py-1 text-sm font-bold text-slate-700 bg-slate-100 border border-slate-200 cursor-default rounded-md leading-5">{{ $page }}</span>
                                </span>
                            @else
                                {{-- CÁC TRANG KHÁC: Bo tròn tất cả --}}
                                <a href="{{ $url }}"
                                    class="relative inline-flex items-center px-3 py-1 text-sm font-medium text-slate-500 bg-white border border-slate-200 rounded-md leading-5 hover:bg-slate-50 hover:text-slate-700 focus:z-10 focus:outline-none focus:ring ring-slate-200 active:bg-slate-100 active:text-slate-700 transition ease-in-out duration-150"
                                    aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Nút Next --}}
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                        class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-slate-500 bg-white border border-slate-200 rounded-md leading-5 hover:text-slate-600 hover:bg-slate-50 focus:z-10 focus:outline-none focus:ring ring-slate-200 active:bg-slate-100 active:text-slate-500 transition ease-in-out duration-150"
                        aria-label="{{ __('pagination.next') }}">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                @else
                    <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                        <span
                            class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-slate-300 bg-white border border-slate-200 cursor-default rounded-md leading-5"
                            aria-hidden="true">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </span>
                    </span>
                @endif
            </div>
        </div>
    </nav>
@endif

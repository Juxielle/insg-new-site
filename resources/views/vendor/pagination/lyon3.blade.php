@if ($paginator->hasPages())
    <nav class="search-result__pagination" role="navigation" aria-label="Pagination">
        <div class="search-pagination__nav-group">
            {{-- Lien Précédent --}}
            @if ($paginator->onFirstPage())
                <span class="search-pagination__btn search-pagination__prev-page disabled" aria-disabled="true">
                    &lsaquo;&nbsp;Précédente
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="search-pagination__btn search-pagination__prev-page" rel="prev">
                    &lsaquo;&nbsp;Précédente
                </a>
            @endif

            {{-- Statut Page courante / Total --}}
            <span class="search-pagination__current-page">
                Page <strong>{{ $paginator->currentPage() }}</strong> / {{ $paginator->lastPage() }}
            </span>

            {{-- Liens numérotés --}}
            <ul class="search-pagination__list">
                @foreach ($elements as $element)
                    @if (is_string($element))
                        <li class="search-pagination__item disabled" aria-disabled="true"><span>{{ $element }}</span></li>
                    @endif

                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="search-pagination__item active" aria-current="page"><span>{{ $page }}</span></li>
                            @else
                                <li class="search-pagination__item"><a href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </ul>

            {{-- Lien Suivant --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="search-pagination__btn search-pagination__next-page" rel="next">
                    Suivante&nbsp;&rsaquo;
                </a>
            @else
                <span class="search-pagination__btn search-pagination__next-page disabled" aria-disabled="true">
                    Suivante&nbsp;&rsaquo;
                </span>
            @endif
        </div>

        {{-- Menu déroulant de pagination (Sélecteur de page direct) --}}
        <div class="search-pagination__dropdown-wrapper">
            <label for="pagination-select-{{ $paginator->getPageName() }}" class="search-pagination__dropdown-label">
                Aller &agrave; la page&nbsp;:
            </label>
            <span class="select_style select_style--pagination">
                <select id="pagination-select-{{ $paginator->getPageName() }}" onchange="if(this.value) window.location.href=this.value;" aria-label="Sélectionner une page">
                    @for ($i = 1; $i <= $paginator->lastPage(); $i++)
                        <option value="{{ $paginator->url($i) }}" {{ $i == $paginator->currentPage() ? 'selected' : '' }}>
                            Page {{ $i }} sur {{ $paginator->lastPage() }}
                        </option>
                    @endfor
                </select>
            </span>
        </div>
    </nav>
@endif


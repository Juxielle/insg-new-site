@props(['evenement'])

<li>
    <a href="{{ route('evenements.index') }}" class="card_evnt">
        <span class="day">{{ $evenement->start_date ? $evenement->start_date->format('d') : '15' }}</span>
        <span class="month">{{ $evenement->start_date ? $evenement->start_date->translatedFormat('M') : 'oct.' }}</span>
    </a>
    <h3><a href="{{ route('evenements.index') }}">{{ $evenement->title }}</a></h3>
    @if($evenement->location)
        <span class="event_location" style="display:block; font-size: 0.85em; color: #666; margin-top: 2px;">
            <i class="icon-location"></i> {{ $evenement->location }}
        </span>
    @endif
</li>


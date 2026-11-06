<section id="formations-initiales" class="toolbox">
    <h2>{{ $catalogueTitle }}</h2>
    <p class="chapo">Formation initiale</p>
    <div class="insg-catalogue-groups">
    @foreach(collect($groups)->groupBy('department') as $department => $departmentGroups)
        
        @foreach($departmentGroups as $group)
            <div>
            @if($department && $groups[0]['department'] !== $groups[count($groups) - 1]['department'])<h3>Département {{ $department }}</h3>@endif
            <h4>{{ $group['label'] }}</h4>
            <ul>
                @foreach($group['courses'] as $course)
                    <li><a class="lien_interne" href="{{ route('formations.show', $course['slug']) }}">{{ $course['title'] }}</a></li>
                @endforeach
            </ul>
            @if($group['level'] === 'Master Recherche')
                <p>En partenariat avec l’Université Omar Bongo (UOB).</p>
            @endif
            </div>
        @endforeach
    @endforeach
    </div>
    <p><a class="lien_interne" href="{{ route('formations.index') }}">Consulter l’ensemble des formations</a></p>
</section>

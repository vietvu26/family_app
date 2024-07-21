<li>
    <button onclick="window.location.href='{{ route('person.profile', $person->id) }}'">{{ $person->name }}</button>
    @if (isset($person->children))
        <ul>
            @foreach ($person->children as $child)
                @include('partials.branch', ['person' => $child])
            @endforeach
        </ul>
    @endif
</li>

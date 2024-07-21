<!-- resources/views/welcome.blade.php -->
@extends('layouts.app')

@section('main')
<div class="container">
    <h1>Family Members</h1>
    <div class="tree">
        @foreach ($tree as $generation => $people)
            <ul>
                @foreach ($people as $person)
                    <li>
                        <a href="#">{{ $person['first_name'] }} {{ $person['last_name'] }}</a>
                        {{-- <div class="relation">
                            @foreach ($person['relationships'] as $relationship)
                                {{ $relationship['relationship_type'] }} with {{ $relationship['related_person_id'] }}<br>
                            @endforeach
                        </div>
                        <ul>
                            @foreach ($person['relatedTo'] as $relatedPerson)
                                <li>
                                    <a href="#">{{ $relatedPerson['firstname'] }} {{ $relatedPerson['lastname'] }}</a>
                                </li>
                            @endforeach
                        </ul> --}}
                    </li>
                @endforeach
            </ul>
        @endforeach
    </div>
</div>
@endsection

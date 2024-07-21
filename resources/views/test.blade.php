@extends('layouts.app')

@section('main')
<style>
    .tree {
        display: flex;
        justify-content: center;
        align-items: flex-start;
        flex-direction: column;
    }

    .tree ul {
        position: relative;
        padding-top: 20px;
        transition: all 0.5s;
        -webkit-transition: all 0.5s;
        -moz-transition: all 0.5s;
    }

    .tree li {
        float: left;
        text-align: center;
        list-style-type: none;
        position: relative;
        padding: 20px 5px 0 5px;
        transition: all 0.5s;
        -webkit-transition: all 0.5s;
        -moz-transition: all 0.5s;
    }

    .tree li::before, .tree li::after {
        content: '';
        position: absolute;
        top: 0;
        right: 50%;
        border-top: 1px solid #ccc;
        width: 50%;
        height: 20px;
    }

    .tree li::after {
        right: auto;
        left: 50%;
        border-left: 1px solid #ccc;
    }

    .tree li:only-child::after, .tree li:only-child::before {
        display: none;
    }

    .tree li:only-child {
        padding-top: 0;
    }

    .tree li:first-child::before, .tree li:last-child::after {
        border: 0 none;
    }

    .tree li:last-child::before {
        border-right: 1px solid #ccc;
        border-radius: 0 5px 0 0;
        -webkit-border-radius: 0 5px 0 0;
        -moz-border-radius: 0 5px 0 0;
    }

    .tree li:first-child::after {
        border-radius: 5px 0 0 0;
        -webkit-border-radius: 5px 0 0 0;
        -moz-border-radius: 5px 0 0 0;
    }

    .tree ul ul::before {
        content: '';
        position: absolute;
        top: 0;
        left: 50%;
        border-left: 1px solid #ccc;
        width: 0;
        height: 20px;
    }

    .tree li button {
        display: inline-block;
        border: 1px solid #ccc;
        padding: 10px 20px;
        text-decoration: none;
        color: #666;
        font-family: Arial, Verdana, Tahoma;
        font-size: 12px;
        background-color: #f9f9f9;
        border-radius: 5px;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        transition: all 0.3s ease;
        cursor: pointer;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .tree li button:hover {
        background-color: #e6e6e6;
        color: #000;
        border: 1px solid #b3b3b3;
    }

    .tree li button:active {
        background-color: #d4d4d4;
        box-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.1);
    }

    .tree > ul > li:first-child {
        margin-left: 40px; 
    }
</style>

<div class="tree">
    <ul>
        @foreach ($tree as $person)
            @include('partials.branch', ['person' => $person])
        @endforeach
    </ul>
</div>
@endsection

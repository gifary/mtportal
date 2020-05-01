{{-- \resources\views\users\create.blade.php --}}
@extends('layouts.master')

@section('title', '| Edit Roles')


@section('content')
    <!--   modal start -->
    <div class="modal-content">
        @if (Session::get('message'))
            <?php
            echo Session::get('message');
            Session::put('message');
            ?>
        @endif
        @if ($errors->any())
            <div style="width: 60%;margin: 0 auto;background: #fff;border: none;" class="alert text-left alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li style="color: #f00;font-size: 13px;" >{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        {!! Form::open(['route' => ["roles.update",$role->id], 'method' => 'put','autocomplete'=>"false"]) !!}
                @include('roles._form')
        {!! Form::close() !!}
    </div>
    <!--   modal end -->

@endsection

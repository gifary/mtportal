{{-- \resources\views\users\create.blade.php --}}
@extends('layouts.master')

@section('title', '| Edit User')


@section('style')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/select2.css')}}">
    <style>
        .select2-container {
            width: 100% !important;
        }

        .select2-container {
            display: block;
            width: 100%;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da!important;
            border-radius: 0.25rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

    </style>
@endsection

@section('breadcrumb-items')

    <li class="breadcrumb-item active">View Users</li>
@endsection

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
        {!! Form::open(['route' => ["users.update",$user->id], 'method' => 'put','autocomplete'=>"false","enctype"=>'multipart/form-data']) !!}
        @include('users._form')
        {!! Form::close() !!}
    </div>
    <!--   modal end -->

@endsection

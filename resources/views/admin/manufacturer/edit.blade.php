<?php
/**
 * Тестовая задача для Netco telecom.
 *
 * @author  Muzaffardjan Karaev
 * @link    https://karaev.uz
 * Created: 28.10.2018 / 22:08
 */

/**
 * @var \App\Models\Manufacturer $manufacturer
 */
?>

@extends('admin.layout.layout')
@section('title', $manufacturer->getName())

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                {{ $manufacturer->getName() }}
            </h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ __('admin_manufacturer.insert_data') }}
                </div>

                <div class="panel-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form role="form" method="post" action="{{ route('admin.manufacturer.create', ['locale' => app()->getLocale()]) }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label>
                                {{ __('admin_manufacturer.name_label') }}
                            </label>

                            <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="{{ __('admin_manufacturer.name') }}">

                            <p class="help-block">
                                {{ __('admin_manufacturer.name_example') }}
                            </p>
                        </div>

                        <div class="form-group">
                            <label>File input</label>
                            <input type="file" name="image" class="form-control">
                        </div>

                        <a class="btn btn-default" href="{{ route('admin.manufacturers', ['locale' => app()->getLocale()]) }}">
                            <i class="fa fa-angle-left"></i>
                            {{ __('admin_manufacturer.cancel') }}
                        </a>

                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-save"></i>
                            {{ __('admin_manufacturer.save') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

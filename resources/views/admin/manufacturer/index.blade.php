<?php
/**
 * Тестовая задача для Netco telecom.
 *
 * @author  Muzaffardjan Karaev
 * @link    https://karaev.uz
 * Created: 28.10.2018 / 1:09
 */

/**
 * @var \App\Models\Manufacturer $manufacturer
 */
$i = 1;
?>

@extends('admin.layout.layout')
@section('title', __('admin_manufacturer.title'))

@section('admin-header-style')
<link rel="stylesheet" href="{{ asset('dashboard/css/data-tables.css') }}">
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            {{ __('admin_manufacturer.list') }}

            <div class="pull-right">
                <a href="{{ route('admin.manufacturer.create', ['locale' => app()->getLocale()]) }}" class="btn btn-primary">
                    <i class="fa fa-plus"></i>
                    {{ __('admin_manufacturer.add') }}
                </a>
            </div>
        </h1>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                {{ __('admin_manufacturer.list') }}
            </div>

            <div class="panel-body">
                <div class="dataTable_wrapper">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($manufacturers as $manufacturer)
                            <tr class="odd gradeA">
                                <td>{{ $i++ }}</td>
                                <td>{{ $manufacturer->getName() }}</td>
                                <td>
                                    <a href="{{ route('admin.manufacturer.edit', ['locale' => app()->getLocale(), 'id' => $manufacturer->id]) }}" class="btn btn-primary btn-sm">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('admin-footer-script')
<script src="{{ asset('dashboard/js/data-tables.js') }}"></script>
@endsection

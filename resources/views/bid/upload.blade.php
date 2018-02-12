{{-- This is no longer used --}}

@extends('layouts.frontend')
@section('content')
<div class="row">
    <div class="col-xs-12 col-sm-8 col-sm-offset-2 bid">
        <h1>Upload photo or video</h1>
        {{Form::open(['route' => 'do_bid_upload','class' => 'form'])}}
            <div class="btn btn-success js-fileapi-wrapper btn-block btn-large" id="bidUpload">
                <div class="js-browse">
                    <span class="btn-txt">Browse</span>
                    <input type="file" name="file">
                </div>
                <div class="js-upload">
                    <div class="progress progress-success">
                        <div class="js-progress bar"></div>
                    </div>
                    <span class="btn-txt">Uploading (<span class="js-size"></span>)</span>
                </div>
            </div>
        {{Form::close()}}
    </div>
</div> 
@stop

@section('css_include')
{{asset_stylesheet('plugins/bootstrapValidator/dist/css/bootstrapValidator.min.css')}}
@stop
@section('js_include')
{{asset_javascript('plugins/jquery.fileapi.min.js')}}
{{asset_javascript('app/bidUpload.min.js')}}
@stop
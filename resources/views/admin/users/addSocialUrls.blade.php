@extends('layouts.admin')
@section('main_header', 'Users')
@section('content')
    <style>.mb {margin-bottom: 10px;}</style>
    <h4 style="margin-bottom: 10px;">Add Social URLs for <b>{{ $user->name }}</b>:</h4>

    <div class="col-md-6 well">
        <?php echo Form::open(['route' => 'store_social_urls', 'class'=>'']); ?>
            <input type="hidden" name="user_id" value="{{ $user->id }}"/>
            <label>Facebook</label>
            <input class="mb form-control" type="text" value="{{ $user->socialAccounts->first()->facebook }}" name="facebook" />
            <label>Twitter</label>
            <input class="mb form-control" type="text" value="{{ $user->socialAccounts->first()->twitter }}" name="twitter" />
            <label>Google</label>
            <input class="mb form-control" type="text" value="{{ $user->socialAccounts->first()->google }}" name="google" />
            <label>Youtube</label>
            <input class="mb form-control" type="text" value="{{ $user->socialAccounts->first()->youtube }}" name="youtube" />
            <label>Sound Cloud</label>
            <input class="mb form-control" type="text" value="{{ $user->socialAccounts->first()->soundcloud }}" name="soundcloud" />
            <label>Website</label>
            <input class="mb form-control" type="text" value="{{ $user->socialAccounts->first()->web }}" name="web" />
            <label>Instagram</label>
            <input class="mb form-control" type="text" value="{{ $user->socialAccounts->first()->instagram }}" name="instagram" />
            <label>LinkedIn</label>
            <input class="mb form-control" type="text" value="{{ $user->socialAccounts->first()->linkedin }}" name="linkedin" />

            <button class="btn btn-primary btn-lg" type="submit">Save</button>
        <?php echo Form::close(); ?>
    </div>
@stop
@extends('layout')

@section('content')
    <form method="POST" enctype="multipart/form-data" action="{{ route('users.update', ['user' => $user->id]) }}" class="form-horizontal">

        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-4">
                <img class="img-thumbnail avatar" src="{{ $user->image ?$user->image->url(): '' }}" />
                <div class="card mt-4">
                    <div class="card-body">
                        <h6>Upload a different photo</h6>
                        <input class="form-control-file" type="file" name="avatar" id="">
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div class="form-group">
                    <label for="">Name:</label>
                    <input class="form-control" type="text" name="name" id="" value="">
                </div>
                @errors @enderrors
                <div class="form-group">
                    <input type="submit" value="Save Changes" class="btn btn-primary">
                </div>
            </div>
        </div>
    </form>
@endsection

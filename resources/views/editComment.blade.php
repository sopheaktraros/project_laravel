@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-3"></div>
        <div class="col-6">
            <div class="card">
                <div class="card-header text-center"><h3>Edit Student</h3></div>
                <div class="card-body">
                    <form action="{{route('updatecomment', $comment->id)}}" method="post">
                        @csrf
                        @method('PATCH')
                          <div class="form-group">
                            <textarea name="comment" cols="68" rows="4" placeholder="Write a comment here ....." required>{{$comment->comment}}</textarea>
                          </div>
                          <button type="submit" class="btn btn-primary btn-block">Add Commnet</button>
                      </form>
                </div>
            </div>
        </div>
        <div class="col-3"></div>
    </div>
</div>

@endsection
@extends('layouts.app')

@section('content')
  <div class="comtainer">
    <div class="row">
      <div class="col-1"></div>
      <div class="col-10">
        <div class="card">
          <div class="card-header text-center">
            <img src="{{asset('image/'.$student->picture)}}" width="150" height="150" class="mx-auto d-block img-thumbnail mt-1"/></td>
          </div>
          <div class="card-body">
            <h2> <strong>{{$student->firstname}} {{$student->lastname}}</strong> ({{$student->class}})</h2>
            <h4>Description</h4>
            {{$student->description}} <p></p>
            <h5>TuTor By: {{$student->user->firstname}}</h5>
            <hr>

            <form action="{{route('addcomment', $student->id)}}" method="post">
              @csrf
                <div class="form-group">
                    <textarea name="comment" cols="153" rows="4" placeholder="Write a comment here ....." required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Add Commnet</button>
            </form>
            <br>
            
            @foreach($comments as $comment)
              <h5>{{$comment->user->firstname}}</h5>
              <div class="card p-2">{{$comment->comment}}</div>
              <a href="{{route('editcomment', $comment->id)}}">Edit</a> |
              <a href="{{route('deletecomment', $comment->id)}}">Delete</a>
              <hr>
            @endforeach

          </div>

        </div>
      </div>

      <div class="col-1"></div>

    </div>
  </div>
@endsection
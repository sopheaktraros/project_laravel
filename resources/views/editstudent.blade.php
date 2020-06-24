@extends('layouts.app')

@section('content')
  <div class="comtainer">
    <div class="row">
      <div class="col-3"></div>
      <div class="col-6">
        <div class="card">
          <div class="card-header text-center">
            <img src="{{asset('image/'.$student->picture)}}" width="100" height="100" class="mx-auto d-block img-thumbnail mt-1" style="border-radius: 50px;"/></td>
            <h4>{{$student->firstname}} {{$student->lastname}}  ({{$student->class}})</h4>
          </div>
          <div class="card-body">
              <form action="{{route('students.update', $student->id)}}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('PATCH') 
          
                <div class="form-group">
                  <input type="text" placeholder="First name" class="form-control" name="firstname" value="{{$student->firstname}}" required>
                </div>
          
                <div class="form-group">
                  <input type="text" placeholder="Last name" class="form-control" name="lastname" value="{{$student->lastname}}" required>
                </div>
          
                <div class="form-group">
                <select class="form-control" name="class" required>

                    <option disabled selected>Class</option>
                    <option value="WEB A" {{ ($student->class == "WEB A") ? 'selected' : '' }} >WEB A</option>
                    <option value="WEB B" {{ ($student->class == "WEB B") ? 'selected' : '' }}>WEB B</option>
                    <option value="SNA" {{ ($student->class == "SNA") ? 'selected' : '' }}>SNA</option>
                    <option value="2021 A" {{ ($student->class == "2021 A") ? 'selected' : '' }}>2021 A</option>
                    <option value="2021 B" {{ ($student->class == "2021 B") ? 'selected' : '' }}>2021 B</option>
                    <option value="2021 C" {{ ($student->class == "2021 C") ? 'selected' : '' }}>2021 C</option>

                </select>
              </div>
          
                <div class="form-group">
                <select class="form-control" name="tutor">
                  <option disabled selected>Tutor</option>
                  @foreach ($users as $user)
                  <option value="{{$user->id}}" {{ ($student->user_id == $user->id) ? 'selected' : '' }}>{{$user->firstname}}</option>
                  @endforeach
                </select>
              </div>
          
              <div class="form-group">    
                <input id="avatar" type="file" class="form-control" name="avatar" autocomplete="picture">
            </div>
          
              <div class="form-group">
                <textarea class="form-control" rows="4" id="comment" placeholder="Desciption" name="description">{{$student->description}}</textarea>
              </div>

              <button type="submit" class="btn btn-primary btn-block">Edit</button>
          
            </form>

          </div>

        </div>
      </div>

      <div class="col-3"></div>

    </div>
  </div>
@endsection
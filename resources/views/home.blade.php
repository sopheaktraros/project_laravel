@extends('layouts.app')

@section('content')
<div class="container">
  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">

    <li class="nav-item">
      <a class="nav-link active" data-toggle="tab" href="#home">Follow Up</a>
    </li>

    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#menu1">Out Of Followup</a>
    </li>

  </ul>

  <!-- Tab panes -->
  <div class="tab-content">

    <div id="home" class="container tab-pane active"><br>

      {{-- add student --}}
        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add Student</a>

      <!-- The Modal -->
      <div class="modal" id="myModal">
        <div class="modal-dialog">
          <div class="modal-content">
          
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Edd New Student</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <!-- Modal body -->
            <div class="modal-body">
              <form action="{{route('students.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
  
                  <div class="form-group">
                    <input type="text" placeholder="First name" class="form-control" name="firstname" required>
                  </div>
  
                  <div class="form-group">
                    <input type="text" placeholder="Last name" class="form-control" name="lastname" required>
                </div>
  
                <div class="form-group">
                  <select class="form-control" name="class" required>
                    <option disabled selected>Class</option>
                    <option value="WEB A">WEB A</option>
                    <option value="WEB B">WEB B</option>
                    <option value="SNA">SNA</option>
                    <option value="2021 A">2021 A</option>
                    <option value="2021 B">2021 B</option>
                    <option value="2021 C">2021 C</option>
                  </select>
                </div>
  
                <div class="form-group">
                  <select class="form-control" name="tutor">
                  <option disabled selected>Tutor</option>
                  @foreach ($users as $user)
                  <option value="{{$user->id}}">{{$user->firstname}}</option>
                  @endforeach
                  </select>
                </div>
  
                <div class="form-group">      
                  <input id="avatar" type="file" class="form-control" name="avatar">
                </div>
  
                <div class="form-group">
                  <textarea class="form-control" rows="4" id="comment" placeholder="Desciption" name="desciption"></textarea>
                </div>
  
                <hr>
                <button type="submit" class="btn btn-primary btn-block">Add</button>
            </form>
          </div>
            
          </div>
        </div>
      </div>

{{-- end add student --}}
<p></p>
      {{-- student in follow up --}}
      <table class="table table-bordered table-hover">
        <thead style="background-color: rgb(230, 230, 230)">
          <tr>
            <th>Picture</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Class</th>
            <th>Action</th>
          </tr>
        </thead>

        @foreach ($students as $item)
        @if ($item->activeFollowup == 0)
        <tbody>
          <tr>
            <td><img src="{{asset('image/'.$item->picture)}}" width="80" height="100" class="mx-auto d-block img-thumbnail"/></td>
            <td>{{ $item->firstname }}</td>
            <td>{{ $item->lastname }}</td>
            <td>{{ $item->class }}</td>
            <td>
                <a href="#"><span class="material-icons text-warning">person_add_disabled</span></a>
                <a href="{{route('viewdetail', $item->id)}}"><span class="material-icons text-primary">remove_red_eye</span></a>
                <a href="{{route('students.edit', $item->id)}}"><span class="material-icons text-primary">create</span></a>
                <a href="{{route('deletestudent', $item->id)}}"><span class="material-icons text-danger" onclick="return confirm('Are you sure to delete?')">delete</span></a>
            </td>
          </tr>
        </tbody>
        @endif
        @endforeach
      </table>
    </div>

    {{-- student out follow up --}}
    <div id="menu1" class="container tab-pane fade"><br>

      <table class="table table-bordered table-hover">
        <thead style="background-color: rgb(230, 230, 230)">
          <tr>
            <th>Picture</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Class</th>
            <th>Action</th>
          </tr>
        </thead>

        @foreach ($students as $item)
        @if ($item->activeFollowup == 1)
        <tbody>
          <tr>
            <td><img src="{{asset('image/'.$item->picture)}}" width="80" height="100" class="mx-auto d-block img-thumbnail"/></td>
            <td>{{ $item->firstname }}</td>
            <td>{{ $item->lastname }}</td>
            <td>{{ $item->class }}</td>
            <td>
              <a href="#"><span class="material-icons">person_remove</span></a>
            </td>
          </tr>
        </tbody>
        @endif
        @endforeach
      </table>

    </div>

  </div>
</div>
@endsection


{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div> --}} 
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
      @if ($login == 1)
        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add Student</a>
      @else
          <p></p>
      @endif
      
      <p></p>
      <input class="form-control" id="myInput" type="text" placeholder="Search..">
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
        <tbody id="myTable">
          <tr>
            <td><img src="{{asset('image/'.$item->picture)}}" width="80" height="100" class="mx-auto d-block img-thumbnail"/></td>
            <td>{{ $item->firstname }}</td>
            <td>{{ $item->lastname }}</td>
            <td>{{ $item->class }}</td>
            <td>
              @if ($login == 1)
                <a href="{{route('uotfollowup', $item->id)}}"><span class="material-icons text-warning">person_add_disabled</span></a>
                <a href="{{route('viewdetail', $item->id)}}"><span class="material-icons text-primary">remove_red_eye</span></a>
                <a href="{{route('students.edit', $item->id)}}"><span class="material-icons text-primary">create</span></a>
                <a href="{{route('deletestudent', $item->id)}}"><span class="material-icons text-danger" onclick="return confirm('Are you sure to delete?')">delete</span></a>
              @else
                <a href="{{route('viewdetail', $item->id)}}"><span class="material-icons text-primary">remove_red_eye</span></a>
              @endif
                
            </td>
          </tr>
        </tbody>
        @endif
        @endforeach
      </table>
    </div>

    {{-- student out follow up --}}
    <div id="menu1" class="container tab-pane fade"><br>

      <p></p>
      <input class="form-control" id="search" type="text" placeholder="Search..">
      <p></p>

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

        <tbody id="search">
          <tr>
            <td><img src="{{asset('image/'.$item->picture)}}" width="80" height="100" class="mx-auto d-block img-thumbnail"/></td>
            <td>{{ $item->firstname }}</td>
            <td>{{ $item->lastname }}</td>
            <td>{{ $item->class }}</td>
            <td>
              @if ($login == 1)
                <a href="{{route('backtofollowup', $item->id)}}"><span class="material-icons">person_remove</span></a>
              @else
                <a href="{{route('viewdetail', $item->id)}}"><span class="material-icons text-primary">remove_red_eye</span></a>
              @endif
              
            </td>
          </tr>
        </tbody>
        @endif
        @endforeach
      </table>

    </div>

  </div>

<script>
    $(document).ready(function(){
      $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });

    $(document).ready(function(){
      $("#search").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#search tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });
    </script>
</div>
@endsection
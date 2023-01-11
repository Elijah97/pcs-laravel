@extends('dashboard.sidemenu')
@section('content')
    <div class="container-fluid Main_Content pad32">
        <p>@include('inc.messages')</p>
        <div class="row">

            <div class="col-4">
                <div class="col-12 M_Card_32">
                    <p class="M_Txt_Article black mabo32">Add user</p>
                    <form method="POST" action="{{ route('addUser') }}" autocomplete="off">
                        @csrf


                        <p class="M_Txt_Info black "> SVC N<sup>0</sup></p>
                        <input type="number" name="serv_no" autofocus placeholder="Service Number"
                            class="input mabo16 M_Input_A">
                        <p class="M_Txt_Info black "> Rank</p>
                        <select class="custom-select M_select_A mabo16" name="rank">
                            <option class="grey">Select rank</option>
                            <option value="Colonel">Colonel</option>
                            <option value="Lieutenant Colonel">Lieutenant Colonel</option>
                            <option value="Major">Major</option>
                            <option value="Captain">Captain</option>
                            <option value="Lieutenant">Lieutenant</option>
                            <option value="2nd Lieutenant">2nd Lieutenant</option>
                        </select>
                        <p class="M_Txt_Info black "> Names</p>
                        <input type="text" name="names" autofocus placeholder="Names" class="input mabo16 M_Input_A">
                        <p class="M_Txt_Info black"> Gender</p>
                        <select class="custom-select M_select_A mabo16" name="gender">
                            <option class="grey" selected>Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                        <p class="M_Txt_Info black "> Email</p>
                        <input type="Email" name="email" placeholder="Email" class="input mabo16 M_Input_A">
                        <p class="M_Txt_Info black "> Password</p>
                        <input type="password" name="password" placeholder="******" class="input mabo16 M_Input_A">
                        <p class="M_Txt_Info black "> Phone</p>
                        <input type="text" name="phone" placeholder="Phone" class="input mabo16 M_Input_A">
                        <p class="M_Txt_Info black "> Function</p>
                        <input type="text" name="function" placeholder="Function" class="input mabo16 M_Input_A">
                        <p class="M_Txt_Info black "> Unit</p>
                        <input type="text" name="unit" placeholder="Unit" class="input mabo16 M_Input_A">
                        <p class="M_Txt_Info black ">User Type</p>
                        <select class="custom-select M_select_A mabo16" name="userType">
                            <option class="grey">Select type</option>
                            <option value="0">Head DRD/Deputy</option>
                            <option value="1">Superior</option>
                            <option value="2">Applicant</option>
                            <option value="99">System Admin</option>
                        </select>
                        <p class="M_Txt_Info black "> Department</p>
                        <select class="custom-select M_select_A mabo16" name="department">
                            <option class="grey" selected>Select Department</option>
                            <option value="N/A">N/A</option>
                            <option value="Science">Science</option>
                            <option value="Technology">Technology</option>
                            <option value="Analytics">Analytics</option>
                            <option value="Industries">Industries</option>
                        </select>
                        <center><button type="submit" class="btn M_Btn_2 mato16 text-uppercase">Add User</button></center>
                    </form>
                </div>
            </div>

            <div class="col-8">
                <div class="col-12 mabo32 pad0">
                    <div class="col-12 M_Card_16 mabo32">
                        <span class="M_Txt_Title black">{{ count($users) }} Users</span>

                        <div class="btn-group fright">
                            <a href="" class="btn M_Icon_Btn  ml-2" role="button" id="dropdownMenuLink"
                                data-toggle="dropdown">
                                <i class="material-icons" style="font-size: 16px;">filter_list</i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <p class="dropdown-item-text M_Txt_Normal" href="#">Filter list</p>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item M_Txt_Normal grey" href="#">Active</a>
                                <a class="dropdown-item M_Txt_Normal grey" href="#">Inactive</a>
                            </div>
                        </div>

                        <div class="btn-group fright">
                            <a href="" class="btn M_Icon_Btn  ml-2" role="button" id="dropdownMenuLink2"
                                data-toggle="dropdown">
                                <i class="material-icons" style="font-size: 16px;">sort</i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink2">
                                <p class="dropdown-item-text M_Txt_Normal" href="#">Sort by</p>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item M_Txt_Normal grey" href="#">Privilege</a>
                                <a class="dropdown-item M_Txt_Normal grey" href="#">Name</a>
                            </div>
                        </div>

                    </div>


                    <div class="col-12 M_Card_16">
                        <table class="table table-md table-borderless">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Rank</th>
                                    <th scope="col">Names</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Department</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($users as $user)
                                    <tr>
                                        <td scope="row">{{ $index++ }}</td>
                                        <td>{{ $user->rank }}</td>
                                        <td>{{ $user->names }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>{{ $user->department }}</td>
                                        <td>
                                            @if ($user->type == 0)
                                                Head / Deputy DRD
                                            @elseif($user->type == 1)
                                                Superior
                                            @elseif($user->type == 2)
                                                Applicant
                                            @else
                                                System Admin
                                            @endif
                                        </td>
                                        <td>
                                            <a href="user/{{ $user->id }}/details" class="grey"><span
                                                    class=""><i
                                                        class="material-icons actionIcons">visibility</i></span></a>

                                            @if ($user->status == 1)
                                                <a href="user/{{ $user->id }}/suspend" class="grey"><span
                                                        class=""><i
                                                            class="material-icons actionIcons">pause</i></span></a>
                                            @else
                                                <a href="user/{{ $user->id }}/activate" class="grey"><span
                                                        class=""><i
                                                            class="material-icons actionIcons">play_arrow</i></span></a>
                                            @endif

                                            <a href="user/{{ $user->id }}/edit" class="grey"><span
                                                    class=""><i
                                                        class="material-icons actionIcons">edit</i></span></a>

                                            <a href="user/{{ $user->id }}/delete" class="grey"><span
                                                    class=""><i
                                                        class="material-icons actionIcons">cancel</i></span></a>
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

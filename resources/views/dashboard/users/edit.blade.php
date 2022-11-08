@extends('dashboard.sidemenu')
@section('content')
    <div class="container-fluid Main_Content pad32">
        <div class="row  justify-content-center">
            <div class="col-6">

                <div class="col-12 M_Card_16 mabo32">
                    <div class="row mato16">
                        <div class="col-1">
                            <a href="/users" class="grey">
                                <i class="material-icons">arrow_back</i>
                            </a>
                        </div>
                        <div class="col-4">
                            <span class="M_Txt_Normal M_Title text-uppercase">
                                {{ $detail[0]->names }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-12 M_Card_32">

                    <p class="M_Txt_Article black mabo32">Edit user</p>
                    <form method="POST" action="{{ route('updateUser') }}" autocomplete="off">
                        @csrf

                        <p>@include('inc.messages')</p>
                        <p class="M_Txt_Info black "> SVC N<sup>0</sup></p>
                        <input type="number" name="serv_no" value="{{ $detail[0]->serv_no }}" autofocus
                            placeholder="Service Number" class="input mabo16 M_Input_A">

                        <p class="M_Txt_Info black "> Rank</p>
                        <select class="custom-select M_select_A mabo16" name="rank">
                            <option class="grey" value="{{ $detail[0]->rank }}" selected>{{ $detail[0]->rank }}</option>
                            <option value="Colonel">Colonel</option>
                            <option value="Lieutenant Colonel">Lieutenant Colonel</option>
                            <option value="Major">Major</option>
                            <option value="Captain">Captain</option>
                            <option value="Lieutenant">Lieutenant</option>
                            <option value="2nd Lieutenant">2nd Lieutenant</option>
                        </select>

                        <p class="M_Txt_Info black "> Names</p>
                        <input type="text" name="names" value="{{ $detail[0]->names }}" autofocus placeholder="Names"
                            class="input mabo16 M_Input_A">

                        <p class="M_Txt_Info black"> Gender</p>
                        <select class="custom-select M_select_A mabo16" name="gender">
                            <option class="grey" value="{{ $detail[0]->gender }}" selected>{{ $detail[0]->gender }}
                            </option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>

                        <p class="M_Txt_Info black "> Email</p>
                        <input type="Email" name="email" value="{{ $detail[0]->email }}" placeholder="Email"
                            class="input mabo16 M_Input_A">

                        <p class="M_Txt_Info black "> Phone</p>
                        <input type="text" name="phone" value="{{ $detail[0]->phone }}" placeholder="Phone"
                            class="input mabo16 M_Input_A">

                        <p class="M_Txt_Info black "> Function</p>
                        <input type="text" name="function" value="{{ $detail[0]->function }}" placeholder="Function"
                            class="input mabo16 M_Input_A">

                        <p class="M_Txt_Info black "> Unit</p>
                        <input type="text" name="unit" value=" {{ $detail[0]->unit }}" placeholder="Unit"
                            class="input mabo16 M_Input_A">

                        <p class="M_Txt_Info black ">User Type</p>
                        <select class="custom-select M_select_A mabo16" name="userType">
                            <option class="grey" value="{{ $detail[0]->type }}" selected>
                                @if ($detail[0]->type == 0)
                                    Head / Deputy DRD
                                @elseif($detail[0]->type == 1)
                                    Superior
                                @elseif($detail[0]->type == 2)
                                    Applicant
                                @else
                                    System Admin
                                @endif
                            </option>
                            <option value="0">Head DRD/Deputy</option>
                            <option value="1">Superior</option>
                            <option value="2">Applicant</option>
                            <option value="99">System Admin</option>
                        </select>

                        <p class="M_Txt_Info black "> Department</p>
                        <select class="custom-select M_select_A mabo16" name="department">
                            <option class="grey" value="{{ $detail[0]->department }}" selected>
                                {{ $detail[0]->department }}</option>
                            <option value="N/A">N/A</option>
                            <option value="Science">Science</option>
                            <option value="Technology">Technology</option>
                            <option value="Analytics">Analytics</option>
                            <option value="Industries">Industries</option>
                        </select>
                        <input type="hidden" value="{{ $detail[0]->id }}" name="id">
                        <center><button type="submit" class="btn M_Btn_2 mato16">Add User</button></center>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

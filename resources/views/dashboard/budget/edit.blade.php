@extends('dashboard.sidemenu')
@section('content')
    <div class="container-fluid Main_Content pad32">
        <p>@include('inc.messages')</p>
        <div class="row justify-content-center">
            <div class="col-6">

                <div class="col-12 M_Card_16 mabo32">
                    <div class="row mato16">
                        <div class="col-1">
                            <a href="/budget" class="grey">
                                <i class="material-icons">arrow_back</i>
                            </a>
                        </div>
                        <div class="col-4">
                            <span class="M_Txt_Normal M_Title text-uppercase">
                                {{ $budget->name }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-12 M_Card_32">
                    <form method="POST" action="{{ route('updateBudget') }}" autocomplete="off">
                        @csrf
                        <input type="hidden" name="id" value="{{ $budget->id }}" autofocus placeholder="Names" <p
                            class="M_Txt_Article black mabo32">Edit Budget</p>
                        <p class="M_Txt_Info black ">Name</p>
                        <input type="text" name="name" value="{{ $budget->name }}" autofocus placeholder="Names"
                            class="input mabo16 M_Input_A">
                        <p class="M_Txt_Info black ">Budget From</p>
                        <input type="date" name="dateFrom" value="{{ $budget->dateFrom }}" autofocus
                            class="input mabo16 M_Input_A">
                        <input type="date" name="dateTo" value="{{ $budget->dateTo }}" autofocus
                            class="input mabo16 M_Input_A">
                        <p class="M_Txt_Info black ">Amount</p>
                        <input type="number" name="amount" value="{{ $budget->amount }}" autofocus placeholder="Names"
                            class="input mabo16 M_Input_A">
                        <p class="M_Txt_Info black mabo8"> Description</p>
                        <textarea name="description" cols="50" rows="5" placeholder="Describe category here..." class="M_Textarea_A">{{ $budget->description }}</textarea>
                        <br />
                        <center><button type="submit" class="btn M_Btn_2 mato16 text-uppercase">Update Budget</button>
                        </center>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection

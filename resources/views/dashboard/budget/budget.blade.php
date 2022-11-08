@extends('dashboard.sidemenu')
@section('content')
    <div class="container-fluid Main_Content pad32">
        <p>@include('inc.messages')</p>
        <div class="row">

            <div class="col-8">
                <div class="col-12 mabo32 pad0">
                    <div class="col-12 M_Card_16 mabo32">
                        <span class="M_Txt_Title black">{{ count($budgets) }} Budget Records</span>

                    </div>


                    <div class="col-12 M_Card_16">
                        <table class="table table-md table-borderless">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Budget From</th>
                                    <th scope="col">Budget To</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Expense</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($budgets as $budget)
                                    <tr>
                                        <td scope="row">{{ $index++ }}</td>
                                        <td>{{ $budget->name }}</td>
                                        @if ($budget->dateFrom != null)
                                            <td>{{ date('d-m-Y', strtotime($budget->dateFrom)) }}</td>
                                        @else
                                            <td>-------</td>
                                        @endif
                                        @if ($budget->dateTo != null)
                                            <td>{{ date('d-m-Y', strtotime($budget->dateTo)) }}</td>
                                        @else
                                            <td>-------</td>
                                        @endif
                                        <td>{{ number_format($budget->amount) }} Rwf</td>
                                        <td>{{ number_format($budget->expenses) }} Rwf</td>
                                        <td>
                                            <a onclick="viewBudget( {{ $budget->id }} );" data-toggle="modal"
                                                data-target='#detailsModal' data-id="{{ $budget->id }}"
                                                class="grey"><span class=""><i
                                                        class="material-icons actionIcons">remove_red_eye</i></span></a>
                                            @if ($budget->status == 1)
                                                <a href="budget/{{ $budget->id }}/suspend" class="grey"><span
                                                        class=""><i
                                                            class="material-icons actionIcons">pause</i></span></a>
                                            @else
                                                <a href="budget/{{ $budget->id }}/activate" class="grey"><span
                                                        class=""><i
                                                            class="material-icons actionIcons">play_arrow</i></span></a>
                                            @endif
                                            <a href="budget/{{ $budget->id }}/details" class="grey"><span
                                                    class=""><i class="material-icons actionIcons">edit</i></span></a>

                                            <a href="" class="grey"><span class=""><i
                                                        class="material-icons actionIcons">cancel</i></span></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="modal fade" id="detailsModal">
                            <div class="modal-dialog">
                                <form id="companydata">
                                    <div class="modal-content">
                                        <div class="col-12 M_Card_32">
                                            <p class="M_Txt_Article black mabo32">Budget Details</p>
                                            <input type="hidden" id="id" name="id" value="">


                                            <div class="row ">
                                                <div class="col-3">
                                                    <span class="M_Txt_Normal black "> Name</span>
                                                </div>
                                                <div class="col-1">
                                                    <span class="M_Txt_Normal black "> :</span>
                                                </div>
                                                <div class="col-8">
                                                    <span class="M_Txt_Normal_light" id="name"></span>
                                                </div>
                                            </div>

                                            <div class="row ">
                                                <div class="col-3">
                                                    <span class="M_Txt_Normal black "> Budget From</span>
                                                </div>
                                                <div class="col-1">
                                                    <span class="M_Txt_Normal black "> :</span>
                                                </div>
                                                <div class="col-8">
                                                    <span class="M_Txt_Normal_light" id="dateFrom"></span>
                                                </div>
                                            </div>

                                            <div class="row ">
                                                <div class="col-3">
                                                    <span class="M_Txt_Normal black "> Budget To</span>
                                                </div>
                                                <div class="col-1">
                                                    <span class="M_Txt_Normal black "> :</span>
                                                </div>
                                                <div class="col-8">
                                                    <span class="M_Txt_Normal_light" id="dateTo"></span>
                                                </div>
                                            </div>

                                            <div class="row ">
                                                <div class="col-3">
                                                    <span class="M_Txt_Normal black "> Amount</span>
                                                </div>
                                                <div class="col-1">
                                                    <span class="M_Txt_Normal black "> :</span>
                                                </div>
                                                <div class="col-8">
                                                    <span class="M_Txt_Normal_light" id="amount"></span>
                                                </div>
                                            </div>

                                            <div class="row ">
                                                <div class="col-3">
                                                    <span class="M_Txt_Normal black "> Expenses</span>
                                                </div>
                                                <div class="col-1">
                                                    <span class="M_Txt_Normal black "> :</span>
                                                </div>
                                                <div class="col-8">
                                                    <span class="M_Txt_Normal_light" id="expense"></span>
                                                </div>
                                            </div>

                                            <div class="row mato16">
                                                <div class="col-3">
                                                    <span class="M_Txt_Normal black "> Description</span>
                                                </div>
                                                <div class="col-1">
                                                    <span class="M_Txt_Normal black "> :</span>
                                                </div>
                                                <div class="col-8">
                                                    <span class="M_Txt_Normal_light" id="description"></span>
                                                </div>
                                            </div>

                                            <div class="row mato16">
                                                <div class="col-3">
                                                    <span class="M_Txt_Normal black "> Status</span>
                                                </div>
                                                <div class="col-1">
                                                    <span class="M_Txt_Normal black "> :</span>
                                                </div>
                                                <div class="col-8">
                                                    <span class="M_Txt_Normal_light" id="status"></span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>


                </div>
            </div>

            <div class="col-4">
                <div class="col-12 M_Card_32">
                    <form method="POST" action="{{ route('addBudget') }}" autocomplete="off">
                        @csrf
                        <p class="M_Txt_Article black mabo32">Add Budget</p>
                        <p class="M_Txt_Info black ">Name</p>
                        <input type="text" name="name" autofocus placeholder="January's budget"
                            class="input mabo16 M_Input_A">
                        <p class="M_Txt_Info black ">Budget From</p>
                        <input type="date" name="dateFrom" autofocus class="input mabo16 M_Input_A">
                        <p class="M_Txt_Info black ">Budget To</p>
                        <input type="date" name="dateTo" autofocus class="input mabo16 M_Input_A">
                        <p class="M_Txt_Info black ">Amount</p>
                        <input type="number" name="amount" class="input mabo16 M_Input_A">
                        <p class="M_Txt_Info black mabo8"> Description</p>
                        <textarea cols="50" rows="5" name="description" placeholder="Describe yourself here..."
                            class="M_Textarea_A"></textarea>
                        <br />
                        <center><button type="submit" class="btn M_Btn_2 mato16 text-uppercase">Add Budget</button>
                        </center>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <script>
        function viewBudget(id) {
            $.get('budget/' + id + '/details', function(data) {
                $('#userCrudModal').html("Edit category");
                $('#submit').val("Edit category");
                $('#detailsModal').modal('show');
                $('#id').val(data.data.id);
                $("#name").text(data.data.name);
                $("#date").text(data.data.dateFrom);
                $("#dateTo").text(data.data.dateTo);
                $("#amount").text(data.data.amount);
                $("#expenses").text(data.data.expenses);
                $('#description').text(data.data.description);
                $('#created_at').text(data.data.created_at);
                if (data.data.status == 0) {
                    $('#status').text('Pending');
                } else {
                    $('#status').text('Active');
                }
            })
        }
    </script>
@endsection

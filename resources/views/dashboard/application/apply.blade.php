@extends('dashboard.sidemenu')
@section('content')
    <div class="container-fluid Main_Content pad32">
        <div class="row justify-content-center">
            <div class="col-5">
                <p>@include('inc.messages')</p>
                <div class="col-12 M_Card_0">
                    <form method="POST" action="{{ route('apply') }}" autocomplete="off">
                        @csrf
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="borrow" role="tabpanel"
                                aria-labelledby="borrow-tab">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="col-12 pad32">
                                            <p class="M_Txt_Title black mabo32 text-uppercase text-center">PETTY CASH
                                                REQUEST FORM</p>

                                            <p class="M_Txt_Info black "> Title</p>
                                            <input type="text" name="title" value=""
                                                class="input M_Input_A black mabo16">

                                            <p class="M_Txt_Info black "> Category</p>
                                            <select name="categoryId" class="custom-select M_select_A mabo16">
                                                <option selected>Select Category</option>
                                                @foreach ($categories as $cat)
                                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                                @endforeach
                                            </select>

                                            <p class="M_Txt_Info black "> Quantity</p>
                                            <input type="number" name="qty" id="qty" value=""
                                                class="input M_Input_A black mabo16">


                                            <p class="M_Txt_Info black "> Unit Price</p>
                                            <input type="number" name="unitPrice" id="unit" value=""
                                                class="input M_Input_A black mabo16">

                                            <div class="row">
                                                <div class="col-10">
                                                    <p class="M_Txt_Info black "> Total Price</p>
                                                    <input type="number" name="totalPrice" id="total"
                                                        class="input M_Input_A black mabo16">
                                                </div>
                                                <div class="col-2">

                                                    <button type="submit" id="calculate"
                                                        class="btn M_Btn_2 mato16 text-uppercase">Calculate</button>
                                                </div>
                                            </div>


                                            <p class="M_Txt_Info black "> Needed by</p>
                                            <input type="date" name="neededBy" value=""
                                                class="input M_Input_A black mabo16">


                                            <p class="M_Txt_Info black mabo8"> Reason</p>
                                            <textarea cols="50" rows="5" name="reason" placeholder="Describe the reason..." class="M_Textarea_A"></textarea><br />
                                            <center><button type="submit" class="btn M_Btn_2 mato16 text-uppercase">Send
                                                    Application</button>
                                            </center>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#calculate").click(function(event) {
                event.preventDefault();
                var qty = $("#qty").val();
                var unit = $("#unit").val();
                var total = qty * unit;
                $('#total').val(total);
            });
        });
    </script>
@endsection

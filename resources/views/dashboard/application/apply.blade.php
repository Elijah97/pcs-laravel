@extends('dashboard.sidemenu')
@section('content')
    <div class="container-fluid Main_Content pad32">
        <div class="row justify-content-center">
            <div class="col-8">
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

                                            <p class="M_Txt_Info black "> Category</p>
                                            <select name="categoryId" class="custom-select M_select_A mabo16">
                                                <option selected>Select Category</option>
                                                @foreach ($categories as $cat)
                                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                                @endforeach
                                            </select>


                                            <p class="M_Txt_Info black "> Center/Project</p>
                                            <input type="text" name="project" value=""
                                                class="input M_Input_A black mabo16">

                                            <!-- <p class="M_Txt_Info black "> Needed by</p>
                                            <input type="date" name="neededBy" value=""
                                                class="input M_Input_A black mabo16"> -->


                                            <p class="M_Txt_Info black mabo8"> Funds request details</p>
                                            <textarea cols="50" rows="5" name="details" placeholder="Request details..." class="M_Textarea_A"></textarea><br />



                                            <hr/><br/>

                                            <div class=" field_wrapper">
                                                <div class="border-item mabo16">

                                                    <p class="M_Txt_Info black "> Item</p>
                                                    <input type="text" name="item[]" id="item" value=""
                                                        class="input M_Input_A black mabo16">

                                                    <p class="M_Txt_Info black "> Description</p>
                                                    <input type="text" name="desc[]" id="desc" value=""
                                                        class="input M_Input_A black mabo16">


                                                    <p class="M_Txt_Info black "> Quantity</p>
                                                    <input type="number" name="qty[]" id="qty" value=""
                                                        class="input M_Input_A black mabo16">


                                                    <p class="M_Txt_Info black "> Unit Price</p>
                                                    <input type="number" name="unitPrice[]" id="unit" value=""
                                                        class="input M_Input_A black mabo16">

                                                    <p class="M_Txt_Info black "> Total Price</p>
                                                    <input type="number" name="totalPrice[]" id="total"
                                                        class="input M_Input_A black mabo16">
                                                    <button type="button" class="add_button btn M_Btn_2 text-uppercase" title="Add field"><span class="M_Txt_Normal"><i class="material-icons optionIcon">add</i> Add item</span> </button>
                                                </div>
                                                    
                                            </div>


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

<script type="text/javascript">
    $(document).ready(function(){
        var maxField = 10; //Input fields increment limitation
        var addButton = $('.add_button'); //Add button selector
        var wrapper = $('.field_wrapper'); //Input field wrapper
        var fieldHTML = '<div class="border-item mabo16"> \
            <p class="M_Txt_Info black "> Item</p> \
            <input type="text" name="item[]" id="item" value="" class="input M_Input_A black mabo16" /> \
            <p class="M_Txt_Info black "> Description</p> \
            <input type="text" name="desc[]" id="desc" value="" class="input M_Input_A black mabo16"/> \
            <p class="M_Txt_Info black "> Quantity</p>\
            <input type="number" name="qty[]" id="qty" value="" class="input M_Input_A black mabo16" /> \
            <p class="M_Txt_Info black "> Unit Price</p>\
            <input type="number" name="unitPrice[]" id="unit" value="" class="input M_Input_A black mabo16" />\
            <p class="M_Txt_Info black "> Total Price</p> \
            <input type="number" name="totalPrice[]" id="total" class="input M_Input_A black mabo16" />\
            <button type="button" class="remove_button btn M_Btn_2 text-uppercase" title="Add field">\
                <span class="M_Txt_Normal"><i class="material-icons optionIcon">remove</i> Remove item</span> \
            </button> \
            </div>'; //New input field html 
        var x = 1; //Initial field counter is 1
        
        //Once add button is clicked
        $(addButton).click(function(){
            //Check maximum number of input fields
            if(x < maxField){ 
                x++; //Increment field counter
                $(wrapper).append(fieldHTML); //Add field html
            }
        });
        
        //Once remove button is clicked
        $(wrapper).on('click', '.remove_button', function(e){
            e.preventDefault();
            $(this).parent('div').remove(); //Remove field html
            x--; //Decrement field counter
        });
    });
    </script>

@endsection

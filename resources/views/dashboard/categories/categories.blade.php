@extends('dashboard.sidemenu')
@section('content')
    <div class="container-fluid Main_Content pad32">
        <p>@include('inc.messages')</p>
        <div class="row">

            <div class="col-8">
                <div class="col-12 mabo32 pad0">
                    <div class="col-12 M_Card_16 mabo32">
                        <span class="M_Txt_Title black">{{ count($categories) }} Categories</span>

                    </div>


                    <div class="col-12 M_Card_16">
                        <table class="table table-md table-borderless">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Category Name</th>
                                    <th scope="col">N<sup>o</sup> Used</th>
                                    <th scope="col">Created at</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $cat)
                                    <tr>
                                        <td scope="row">{{ $index++ }}</td>
                                        <td>{{ $cat->name }}</td>
                                        <td>0</td>
                                        <td>{{ $cat->created_at }}</td>
                                        <td>
                                            <a onclick="viewCategories( {{ $cat->id }} );" data-toggle="modal"
                                                data-target='#detailsModal' data-id="{{ $cat->id }}"
                                                class="grey"><span class=""><i
                                                        class="material-icons actionIcons">remove_red_eye</i></span></a>
                                            @if ($cat->status == 1)
                                                <a href="category/{{ $cat->id }}/suspend" class="grey"><span
                                                        class=""><i
                                                            class="material-icons actionIcons">pause</i></span></a>
                                            @else
                                                <a href="category/{{ $cat->id }}/activate" class="grey"><span
                                                        class=""><i
                                                            class="material-icons actionIcons">play_arrow</i></span></a>
                                            @endif
                                            <a href="/category/{{ $cat->id }}/details" class="grey"><span
                                                    class=""><i class="material-icons actionIcons">edit</i></span></a>

                                            <a href="/category/{{ $cat->id }}/delete" class="grey"><span
                                                    class=""><i
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
                                            <p class="M_Txt_Article black mabo32">Category Details</p>
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

                                            <div class="row mato16">
                                                <div class="col-3">
                                                    <span class="M_Txt_Normal black "> Date</span>
                                                </div>
                                                <div class="col-1">
                                                    <span class="M_Txt_Normal black "> :</span>
                                                </div>
                                                <div class="col-8">
                                                    <span class="M_Txt_Normal_light" id="created_at"></span>
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
                    <form method="POST" action="{{ route('addCategory') }}" autocomplete="off">
                        @csrf
                        <p class="M_Txt_Article black mabo32">Add Category</p>
                        <p class="M_Txt_Info black ">Name</p>
                        <input type="text" name="name" autofocus placeholder="Names" class="input mabo16 M_Input_A">
                        <p class="M_Txt_Info black mabo8"> Description</p>
                        <textarea name="description" cols="50" rows="5" placeholder="Describe category here..." class="M_Textarea_A"></textarea><br />
                        <center><button type="submit" class="btn M_Btn_2 mato16 text-uppercase">Add Category</button></center>
                    </form>
                </div>
            </div>

        </div>
    </div>
    <script>
        function viewCategories(id) {
            $.get('category/' + id + '/details', function(data) {
                $('#userCrudModal').html("Edit category");
                $('#submit').val("Edit category");
                $('#detailsModal').modal('show');
                $('#id').val(data.data.id);
                $("#name").text(data.data.name);
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

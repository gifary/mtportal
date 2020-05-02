@extends('layouts.master')
@section('title', 'All Ticket')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatables.css')}}">
    <style>
        .select2-container {
            width: 100% !important;
        }

        .label-container {
            position: fixed;
            bottom: 48px;
            right: 105px;
            display: table;
            visibility: hidden;
        }

        .label-text {
            color: #FFF;
            background: rgba(51, 51, 51, 0.5);
            display: table-cell;
            vertical-align: middle;
            padding: 10px;
            border-radius: 3px;
        }

        .label-arrow {
            display: table-cell;
            vertical-align: middle;
            color: #333;
            opacity: 0.5;
        }

        .float {
            position: fixed;
            width: 60px;
            height: 60px;
            bottom: 40px;
            right: 40px;
            background-color: #06C;
            color: #FFF;
            border-radius: 50px;
            text-align: center;
            box-shadow: 2px 2px 3px #999;
        }

        .my-float {
            font-size: 24px;
            margin-top: 18px;
        }

        a.float+div.label-container {
            visibility: hidden;
            opacity: 0;
            transition: visibility 0s, opacity 0.5s ease;
        }

        a.float:hover+div.label-container {
            visibility: visible;
            opacity: 1;
        }
        /* Styles for the comment section */
        @media only screen
        and (min-device-width : 320px)
        and (max-device-width : 765px) {
            div.comment-box > div.col-md-1{
                display: none;
            }
            div.comment-box > div.col-md-3{
                padding-top: 20px;
                text-align: right;
            }
        }
        @media only screen and (max-width: 767px)
        {
            .chat-box .chat-right-aside .chat .chat-msg-box { height: 400px!important; }
        }

        .chat-box .chat-right-aside .chat .chat-message{right: 0;left: 0;}
        .chat-message{width: 100%!important}
        .chat-box .chat-right-aside .chat .chat-msg-box .other-message{border-top-right-radius: 10px!important}
        .comment-box{padding-top: 20px!important;padding-bottom:0px!important; }
    </style>
@endsection

@section('breadcrumb-title', 'All Tickets')
@section('breadcrumb-items')
    <li class="breadcrumb-item">Tickets</li>
@endsection
@section('breadcrumb-buttons')
    {{--    <a href="{{route('add_ticket_page')}}" class="btn btn-pill btn-primary" data-original-title="Create Ticket"--}}
    {{--       title="">Create Ticket</a>--}}
    <button class=" btn btn-pill btn-primary text-light" type="button" data-toggle="modal"
            data-target="#addTicketModal" data-whatever="@getbootstrap" id="addTicketId" name="addTicketId"
            data-original-title="" title="">Create Ticket
    </button>
@endsection

@section('content')

    <style>
        .make-me-sticky {
            position: sticky;
            top: 0;
        }

        .pt-7 {
            padding-top: 7px;
        }
    </style>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                @if ($message = Session::get('error'))
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                @endif
                <div class="row">
                    <div class="col-sm-6 col-xl-3 col-lg-6">
                        <div class="card o-hidden">
                            <div class="bg-danger card-body">
                                <div class="media1 static-top-widget1">
                                    <div class="media-body"><span class="m-0">New</span>
                                        <h4 class="mb-0 counter">{{$ticket_counts['new']}}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3 col-lg-6">
                        <div class="card o-hidden">
                            <div class="bg-primary card-body">
                                <div class="media1 static-top-widget1">
                                    <div class="media-body"><span class="m-0">Assigned</span>
                                        <h4 class="mb-0 counter">{{$ticket_counts['assigned']}}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3 col-lg-6">
                        <div class="card o-hidden">
                            <div class="bg-warning card-body">
                                <div class="media1 static-top-widget1">
                                    <div class="media-body"><span class="m-0">Open</span>
                                        <h4 class="mb-0 counter">{{$ticket_counts['open']}}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3 col-lg-6">
                        <div class="card o-hidden">
                            <div class="bg-success card-body">
                                <div class="media1 static-top-widget1">
                                    <div class="media-body"><span class="m-0">Resolved</span>
                                        <h4 class="mb-0 counter">{{$ticket_counts['resolved']}}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row default-according style-1 faq-accordion" id="accordionoc">
                    <div class="col-md-12 mb-5" style="padding: 15px 0px;background: aliceblue;border:3px solid #000;border-radius: 4px" id="filter_search">
                        <div class="col-xl-12 col-lg-12 col-md-12">
                            <div class="row">
                                <div class="col-md-10">
                                    <input type="text" class="form-control" id="search_card" placeholder="search title or ticket number">
                                </div>
                                <div class="col-md-2"><a href="javascript:void(0)" class="btn btn-warning" id="switchtable" style="width: 100%">Switch to table</a></div>
                            </div>
                            <div style="clear: both;"></div>
                        </div>
                    </div>

                    <div class="col-md-12 mb-5" id="filter_table" style="display: none">
                        <div class="col-xl-12 col-lg-12 col-md-12">
                                <div class="pull-right"><a href="javascript:void(0)" class="btn btn-warning" id="switchcard" style="width: 100%">Switch to card</a></div>
                        </div>
                    </div>
                    <div id="card_ticket" class="col-12">
                        @include("supportticket.card_ticket")
                    </div>
                    <div id="table_ticker" class="col-12" style="display: none">
                        @include("supportticket.table")
                    </div>
                </div>
            </div>
        </div>

        <a href="#searchFormModal" class="float" data-whatever="@getbootstrap" data-toggle="modal">
            <i class="fa fa-filter my-float"></i>
        </a>
        <div class="label-container">
            <div class="label-text">Available Filters</div>
            <i class="fa fa-play label-arrow"></i>
        </div>

        <div class="modal fade" id="searchFormModal" tabindex="-1" role="document" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="">Available Filters</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        @include('supportticket.search_form')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
    <!--   modal start for add ticket -->
    <div class="modal fade" id="addTicketModal" tabindex="-1" role="document"
         aria-labelledby="addBusinessModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="business">Add Ticket</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <form action="{{ route('post_ticket') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="cname">Title</label>
                                        <input required class="form-control" id="title" name="title" type="text"
                                               placeholder="Ticket Title">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="start_date">Start Date</label>
                                            <input name="start_date" id="start_date" class="form-control"
                                                   value="{{ date('Y-m-d') }}"
                                                   id="validationCustom03" type="date" placeholder="Start Date">
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="deal_size">Attachment</label>
                                        <input required class="form-control" id="attachment" name="attachment"
                                               type="file"
                                               accept="image/x-png,image/jpeg, .pdf, .docx, .jpeg, .png, .svg, .psd, .ai, .eps">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="contact1">Description</label>
                                        <textarea name="description" id="description" class="form-control"
                                                  id="validationCustom02" placeholder="Ticket Description"
                                                  required=""></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-pill btn-secondary" type="button" data-dismiss="modal">Close</button>
                        <button class="btn btn-pill btn-primary" type="submit">Create Ticket</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="edit-comment-form" tabindex="-1" role="document" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="business">Edit Comment</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <form action="#" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="cname">Comment</label>
                                        <input type="hidden" id="comment_id_form" name="comment_id">
                                        <input required class="form-control" id="comment_form" name="title" type="text">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-pill btn-secondary" type="button" data-dismiss="modal">Close</button>
                        <button class="btn btn-pill btn-primary" type="button" id="edit_comment">Edit comment</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <!--   modal end -->

    {{--    model add task--}}
    <div class="modal fade" id="addTask" tabindex="-1" role="document" aria-labelledby="addBusinessModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="business">Add Task</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>

                <form action="{{ route('save_task') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="ticket_id" id="ticket_id_of_task">
                    <div class="modal-body ">
                        <!-- Container-fluid starts-->
                        <!-- Container-fluid Ends-->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="cname">Title</label>
                                        <input required class="form-control" id="title" name="title" type="text"
                                               placeholder="Task Title">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="start_date">Due Date</label>
                                            <input name="due_date" id="start_date" class="form-control"
                                                   value="{{ date('Y-m-d') }}" id="validationCustom03" type="date"
                                                   placeholder="Start Date">
                                            <input type="hidden" name="start_date" value="{{date('Y-m-d')}}">
                                            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="deal_size">Attachment</label>
                                        <input class="form-control" multiple id="attachment" name="attachment[]"
                                               type="file"
                                               accept="image/x-png,image/jpeg, .pdf, .docx, .jpeg, .png, .svg, .psd, .ai, .eps">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="start_date">Assigned To</label>
                                            {!! Form::select('assigned_to', $assignees, null, ['id' => 'assigned_to', 'class' => 'form-control']); !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="contact1">Description</label>
                                        <textarea name="description" id="description" class="form-control"
                                                  id="validationCustom02" placeholder="Task Description"
                                                  required=""></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-pill btn-secondary" type="button" data-dismiss="modal">Close</button>
                        <button class="btn btn-pill btn-primary" type="submit">Create Task</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
    {{--    end modal add task--}}
@endsection
@section('script')
    <script>
        $("#search_card").on('keyup',function () {
            let val = $(this).val()

            $.ajax({
                url: "{{ url('/searchTicket') }}",
                type: 'get',
                data: {
                    search : val
                },
                dataType:'html',
                success: function(data) {
                    $("#card_ticket").html(data)
                }
            });
        })

        $("#switchtable").on('click',function () {
            $("#card_ticket").hide()
            $("#filter_search").hide()
            $("#table_ticker").show()
            $("#filter_table").show()
        });

        $("#switchcard").on("click",function () {
            $("#card_ticket").show()
            $("#filter_search").show()
            $("#table_ticker").hide()
            $("#filter_table").hide()
        })

        $(document).on('click', "#addTicketId", function () {
            $('#addTicketModal').modal('show').on('shown.bs.modal', function () {
            });
        });

        $(document).ready(function() {
            $('#ticket-table').DataTable();
        } );

        function addTask(id) {
            $("#ticket_id_of_task").val(id)
            $("#addTask").modal('show');
        }

        function deleteAttachment(id) {
            var url = '/supportticket/'+id+'/deleteAttachment'
            $.ajax({
                url: url,
                type: 'delete',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                dataType:'json',
                success: function(data) {
                    $.notify('Delete success', {
                        type: 'success',
                        allow_dismiss: true,
                        delay: 100,
                        timer: 300
                    })
                    $("#attachment_row_"+id).remove()
                }
            });

        }

        function submitForm(id) {
            var form = $("#form_"+id);
            var url = form.attr('action');

            var btn =$("#button_submit_from_"+id);
            $(btn).buttonLoader('start');

            $.ajax({
                type: "PUT",
                url: url,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                dataType:'html',
                data: form.serialize(), // serializes the form's elements.
                success: function(data)
                {
                    $.notify('Success update', {
                        type: 'success',
                        allow_dismiss: true,
                        delay: 100,
                        timer: 300
                    })
                    $(btn).buttonLoader('stop');
                    $("#child_change_log_"+id).append(data)
                }
            });
        }

        function editComment(id,comment)
        {
            // show modal
            $("#comment_id_form").val(id)
            $("#comment_form").val(comment)
            $("#edit-comment-form").modal('show')
        }

        function deleteComment(id)
        {
            $.ajax({
                url: "{{ url('/commentDelete') }}",
                type: 'post',
                data: {
                    _token: '{{ csrf_token() }}',
                    ticket_number : id
                },
                dataType:'json',
                success: function(data) {
                    $.notify('Delete comment success', {
                        type: 'success',
                        allow_dismiss: true,
                        delay: 100,
                        timer: 300
                    })
                    $("#comment_box_"+id).remove()
                }
            });
        }


        $("#edit_comment").on('click',function () {
            // update comment
            let id = $("#comment_id_form").val()
            let comment = $("#comment_form").val()
            if(comment.length<2){
                $.notify('Comment is required', {
                    type: 'warning',
                    allow_dismiss: true,
                    delay: 100,
                    timer: 300
                })

                return
            }

            $.ajax({
                url: "{{ url('/commentEdit') }}",
                type: 'post',
                data: {
                    _token: '{{ csrf_token() }}',
                    ticket_number : id,
                    comment_txt : comment
                },
                dataType:'json',
                success: function(data) {
                    $.notify('Edit comment success', {
                        type: 'success',
                        allow_dismiss: true,
                        delay: 100,
                        timer: 300
                    })
                    $("#comment_body_"+id).text(comment)
                    $("#edit-comment-form").modal('hide')
                }
            });
        })

        function addComment(id)
        {

            let id_ticket = id;
            let comment = $("#comment_"+id_ticket).val()
            if(comment.length<2){
                $.notify('Comment is required', {
                    type: 'warning',
                    allow_dismiss: true,
                    delay: 100,
                    timer: 300
                })

                return
            }
            var btn =$("#button_add_comment_"+id);
            $(btn).buttonLoader('start');

            $.ajax({
                url: "{{ url('/commentAdd') }}",
                type: 'post',
                data: {
                    _token: '{{ csrf_token() }}',
                    ticket_number : id_ticket,
                    comment_txt : comment
                },
                dataType:'html',
                success: function(data) {
                    $.notify('Add comment success', {
                        type: 'success',
                        allow_dismiss: true,
                        delay: 100,
                        timer: 300
                    })
                    $("#comment_"+id_ticket).val("")
                    $('#comment-box-'+id_ticket).append(data);
                    $(btn).buttonLoader('stop');
                    $(btn).html('<i class="icon-angle-right"></i>');
                }
            });
        }
    </script>
@endsection


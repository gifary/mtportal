<div class="col call-chat-body">
    <div class="card" style="-webkit-box-shadow:1px 5px 24px 0 rgba(0, 0, 0, 0.1); box-shadow: 1px 5px 24px 0 rgba(0, 0, 0, 0.1); width:100%;">
        <div class="card-body p-0">
            <div id="row chat-box">
                <div class="col chat-right-aside" style="max-width: 100% !important; flex: 0 0 100%;">
                    <!-- chat start-->
                    <div class="chat">
                        <!-- chat-header end-->
                        <div class="chat-history chat-msg-box custom-scrollbar">
                            <div id="comment-box-attachment" style="margin-top: 15px">
                                @foreach($attachment->comments as $val)
                                    @if ($val->user_id == \Illuminate\Support\Facades\Auth::user()->id)
                                        <div class="message my-message" style="width: 100%; border: 1px solid #e8e8e8; border-radius: 10px; margin-bottom: 15px;padding: 20px" id="comment_box_attachment_{{$val->id}}">
                                            <img class="rounded-circle float-left chat-user-img img-30" src="{{asset($val->user->profile_pic)}}" alt="{{$val->user->name}}" style="margin-top: -30px">
                                            <div class="message-data text-right">
                                                <span class="message-data-time">{{ $val->updated_at  }}, {{$val->user->name}}</span>
                                            </div>
                                            <p id="comment_body_attachment_{{$val->id}}">{{$val->comment}}</p>
                                        </div>
                                    @else
                                        <div class="message other-message pull-right" style="width: 100%; border: 1px solid #e8e8e8; border-radius: 10px; margin-bottom: 15px;padding: 20px">
                                            <img class="rounded-circle float-left chat-user-img img-30" src="{{asset($val->user->profile_pic)}}" alt="{{$val->user->name}}" style="margin-top: -30px">
                                            <div class="message-data">
                                                <span class="message-data-time">{{ $val->updated_at  }}, {{$val->user->name}}</span>
                                            </div>
                                            <p>{{$val->comment_body}}</p>
                                        </div>
                                        <div class="clearfix"></div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="chat-message clearfix">
            <form onsubmit="addCommentAttachment(this);return false" action="" >
                <div class="form-group row comment-box">
                    <div class="col-md-1" style="margin-left: 10px">
                        <img class="rounded-circle float-right img-40" src="{{asset(\Illuminate\Support\Facades\Auth::user()->profile_pic)}}" alt="">
                    </div>
                    <div class="col-md-9">
                        {{ csrf_field() }}
                        <input placeholder="Add Comment" class="form-control" id="comment_attachment" required>
                        <input type="hidden" id="ticket_attachment_id" value="{{$attachment->id}}">
                    </div>
                    <div class="">
                        <button class="btn btn-pill btn-primary text-light add-comment" id="button_add_comment_attachment" type="submit" data-btn-text="<i class='icon-angle-right'></i>"><i class="icon-angle-right"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

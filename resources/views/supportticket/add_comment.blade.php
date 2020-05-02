<div class="message my-message" style="width: 100%; border: 1px solid #e8e8e8; border-radius: 10px; margin-bottom: 15px;padding: 20px" id="comment_box_{{$ticket_comment->id}}">
    <img class="rounded-circle float-left chat-user-img img-30" src="{{asset($ticket_comment->user->profile_pic)}}" alt="{{$ticket_comment->user->name}}" style="margin-top: -30px">
    <div class="message-data text-right">
        <span class="message-data-time">{{ $ticket_comment->updated_at  }}, {{$ticket_comment->user->name}}</span>
    </div>
    <p id="comment_body_{{$ticket_comment->id}}">{{$ticket_comment->comment_body}}</p>
    <div class="row float-right" style="background-color: #efefef; border-radius: 5px;">
        <div class="col-xs-6" style="border-right: 1px solid #dedede;">
            <button class="btn btn-xs form-inline" onclick="editComment('{{$ticket_comment->id}}','{{$ticket_comment->comment_body}}')"><i class="icon-pencil"></i></button>
        </div>
        <div class="col-xs-6">
            <button class="btn btn-xs form-inline" onclick="deleteComment('{{$ticket_comment->id}}')"><i class="icon-trash"></i></button>
        </div>
    </div>
</div>

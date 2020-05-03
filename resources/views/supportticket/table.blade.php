<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="display" id="ticket-table">
                        <thead>
                        <tr>
                            <th>Ticket Number</th>
                            <th>Title</th>
                            <th>Ticket Type</th>
                            <th>Created Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($tickets)>0)
                            @foreach($tickets as $key => $ticket)
                                <tr>
                                    <td>{{$ticket->ticket_number}}</td>
                                    <td>{{$ticket->title}}</td>
                                    <td>{{$ticket->ticket_type}}</td>
                                    <td>{{\Carbon\Carbon::parse($ticket->created_at)->format('d M, Y')}}</td>
                                    <td>
                                        <a href="{{route('show.ticket',$ticket->id)}}" class="btn  btn-xs form-inline"><i class="icon-eye"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="text-center">No data found!</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

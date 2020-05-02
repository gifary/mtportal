<div class="row default-according style-1 faq-accordion" id="toogle_log{{ $log->id }}" style="margin-top: -20px">
    <div class="row" style="width: 100%;">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed"
                                data-toggle="collapse"
                                data-target="#toogle_log-{{ $log->id }}"
                                aria-expanded="false"
                                aria-controls="collapseicon">
                            {{$log->user->name}}, {{ $log->updated_at }}
                        </button>
                    </h5>
                </div>
                <div class="collapse" id="toogle_log-{{ $log->id }}"
                     aria-labelledby="collapseicon"
                     data-parent="#toogle_logb-{{ $log->id }}">
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Label</th>
                                <th>From</th>
                                <th>To</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach(json_decode($log->data) as $key_change=>$data)
                                <tr>
                                    <td>{{ $key_change }}</td>
                                    <td>{{ $data->from  }}</td>
                                    <td> {{ $data->to  }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

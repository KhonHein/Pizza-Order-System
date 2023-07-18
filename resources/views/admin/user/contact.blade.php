@extends('admin.layout.master')
@section('title','message')
@section('content')

<div class="main-content">
    <div class="section__content section__content--p10">
        <div class="container-fluid">
            <div class="row">
                <div class="col-3 offset-8">
                    <a href="{{ route('category#list') }}"><button class="btn bg-dark text-white my-3"><i class="fa fa-home" aria-hidden="true"></i></button></a>
                </div>
            </div>
            @if (Session('deleteMessage'))

            <div class="col-lg-8 offset-2 alert alert-success alert-dismissible fade show" role="alert">
                <strong><i class="fas fa-cloud-upload-alt"></i>{{ session('deleteMessage') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <div class="col-md-12">
                <table class="table table-data2">
                    <thead>
                        <tr>
                            <th class="col-md-2">Name</th>
                            <th class="col-md-3">Email</th>
                            <th class="col-md-2">Date</th>
                            <th class="col">Content</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id='dataList'>
                       @foreach ($messages as $m)
                       <tr>
                            <input type="hidden" class="messageId" value="{{ $m->id }}">
                            <td class="col-md-2">{{ $m->name }}</td>
                            <td class="col-md-3">{{ $m->email }}</td>
                            <td class="col-md-2">{{ $m->created_at->format('d/m/y') }}</td>
                            <td class="col">{{ $m->message }}</td>
                            <td>
                                <button class="deleteMessage"><i class="fa-solid fa-trash text-danger"></i></button>
                            </td>
                        </tr>
                       @endforeach
                    </tbody>
                    <span>{{ $messages->links() }}</span>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scriptSource')
<script>
    $('.deleteMessage').click(function(){
        $parentNote = $(this).parents('tr');
        $messageId = $parentNote.find('.messageId').val();
        $data = { messageId: $messageId};

        $.ajax({
            type: "get",
            url: "http://127.0.0.1:8000/message/sms/delete",
            data: $data,
            dataType: "json",
        });
        location.reload();
    })
</script>
@endsection


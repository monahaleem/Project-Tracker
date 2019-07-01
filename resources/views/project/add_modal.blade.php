<!-- Add project Modal -->
<div class="modal fade" id="addProjectModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Add Project</h5>
                <button class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('project.store') }}" id="addProjectForm">
                    @csrf
                    <div class="form-group">
                        <label for="name">Project Name</label>
                        <input type="text" class="form-control" name="project_name">
                    </div>
                    <div class="form-group">
                        <label for="description">Project Description</label>
                        <input type="description" class="form-control" name="project_description">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="btnAddProject" area-dismiss="modal">Save Changes</button>
            </div>
        </div>
    </div>
</div>

@section('js')
<script>
$(document).on('click', '#btnAddProject', function(e) {
  e.preventDefault();
  var data  = $('#addProjectForm').serialize();
  var url   = $('#addProjectForm').attr('action');

  $.ajax({
    url: url,
    type: 'POST',
    data: data,
    error: function(data) {
        $('#custom-message').show();
        $('#custom-message ul').empty();
        $('#custom-message').addClass('custom-message-error');

        $.each(data.responseJSON.errors, function(key, value) {
            if (Array.isArray(value)) {
                $.each(value, function(k, v) {
                    $('#custom-message ul').append('<li>' + v + '</li>');
                });
            } else {
                $('#custom-message ul').append('<li>' + value + '</li>');
            }
        })
    },
    success: function(data) {
      if (data.data != '') {
        $('#custom-message').show();
        $('#custom-message ul').empty();
        $('#custom-message').addClass('custom-message-success');
        $('#custom-message ul').append('<li>' + data.message + '</li>');
        $('#addProjectForm')[0].reset();
        $('#addProjectModal').modal('hide');
        
        var lastRow = $('#tbody tr').length;
        var tr = `
            <tr id="tr-${data.data.id}">
                <td>${(lastRow + 1)}</td>
                <td>${data.data.project_name}</td>
                <td>${data.data.project_description}</td>
                <td>
                    <button class="btn btn-success btn-sm" data-id="${data.data.id}" id="btnEdit">
                        <i class="far fa-edit"></i> Edit
                    </button>
                    <button class="btn btn-danger btn-sm" data-id="${data.data.id}" id="btnDelete">
                        <i class="far fa-trash-alt"></i> Delete
                    </button>
                </td>
            </tr>
        `;
        $('#tbody').append(tr);
        
        $('#custom-message').delay(4000).slideUp(100);
      }
    }
  });
});
</script>
@endsection

@push('js')

<script>
$(document).on('click', '#btnAddProject', function(e) {
  e.preventDefault();
  var data  = $('#addProjectForm').serialize();
  var url   = $('#addProjectForm').attr('action');

  $.ajax({
    url: url,
    type: 'POST',
    data: data,
    error: function(data) {
        $('#custom-message').show();
        $('#custom-message ul').empty();
        $('#custom-message').addClass('custom-message-error');

        $.each(data.responseJSON.errors, function(key, value) {
            if (Array.isArray(value)) {
                $.each(value, function(k, v) {
                    $('#custom-message ul').append('<li>' + v + '</li>');
                });
            } else {
                $('#custom-message ul').append('<li>' + value + '</li>');
            }
        })
    },
    success: function(data) {
      if (data.data != '') {
        $('#custom-message').show();
        $('#custom-message ul').empty();
        $('#custom-message').addClass('custom-message-success');
        $('#custom-message ul').append('<li>' + data.message + '</li>');
        $('#addProjectForm')[0].reset();
        $('#addProjectModal').modal('hide');
        
        var lastRow = $('#tbody tr').length;
        var tr = `
            <tr id="tr-${data.data.id}">
                <td>${(lastRow + 1)}</td>
                <td>${data.data.project_name}</td>
                <td>${data.data.project_descripion}</td>
                <td>
                    <button class="btn btn-success btn-sm" data-id="${data.data.id}" id="btnEdit">
                        <i class="far fa-edit"></i> Edit
                    </button>
                    <button class="btn btn-danger btn-sm" data-id="${data.data.id}" id="btnDelete">
                        <i class="far fa-trash-alt"></i> Delete
                    </button>
                </td>
            </tr>
        `;
        $('#tbody').append(tr);
        
        $('#custom-message').delay(4000).slideUp(100);
      }
    }
  });
});
</script>
@endpush

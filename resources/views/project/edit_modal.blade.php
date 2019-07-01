<!-- Edit Project Modal -->
<div class="modal fade" id="editProjectModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Edit Project</h5>
                <button class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('project.store') }}" id="editProjectForm">
                    @csrf
                    {{ method_field('PUT') }}

                    <div class="form-group">
                        <label for="name"> Project Name</label>
                        <input type="text" class="form-control" name="project_name" id="project_name">
                    </div>
                    <div class="form-group">
                        <label for="description">project Description</label>
                        <input type="text" class="form-control" name="project_description" id="project_description">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="btnEditProject" area-dismiss="modal">Save Changes</button>
            </div>
        </div>
    </div>
</div>

@push('js')
<script>

$(document).on('click', '#btnEdit', function(e) {
    var action = $(this).data('action');
    $('#editProjectForm')[0].reset();

    $.ajax({
        url: action + '/edit',
        type: 'GET',
        success: function(data) {
            if (data.message == 'success') {
                $('#project_name').val(data.data.project_name);
                $('#project_description').val(data.data.project_description);
                $('#editProjectForm').attr('action', action);
                $('#editProjectModal').modal('show');
            }
        }
    });
});



$(document).on('click', '#btnEditProject', function(e) {
  e.preventDefault();
  var data  = $('#editProjectForm').serialize();
  var url   = $('#editProjectForm').attr('action');

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
        $('#editProjectForm')[0].reset();
        $('#editProjectModal').modal('hide');
        
        var lastRow = $('#tr-'+data.data.id).children('td:first').text();
        var tr = `
            <tr id="tr-${data.data.id}">
                <td>${parseInt(lastRow)}</td>
                <td>${data.data.project_name}</td>
                <td>${data.data.project_description}</td>
                <td>
                    <button class="btn btn-success btn-sm" data-action="/project/${data.data.id}" id="btnEdit">
                        <i class="far fa-edit"></i> Edit
                    </button>
                    <button class="btn btn-danger btn-sm" data-action="/project/${data.data.id}" id="btnDelete">
                        <i class="far fa-trash-alt"></i> Delete
                    </button>
                </td>
            </tr>
        `;
        $('#tr-'+data.data.id).replaceWith(tr);;
        
        $('#custom-message').delay(4000).slideUp(100);
      }
    }
  });
});
</script>
@endpush
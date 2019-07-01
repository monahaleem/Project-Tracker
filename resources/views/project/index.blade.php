@extends('layouts.apps')

@section('title')
Home Bage
@endsection
@section('page-title')
<i class="fas fa-users"></i> Home
@endsection

@section('content')

<!-- projects -->
<section id="projects">
  <div class="container">
    <div class="row">
      <div class="col">
        <div class="card">
          <div class="card-header">
            <button class="btn btn-primary float-right" data-toggle="modal" data-target="#addProjectModal">Add Project</button>
            <h4>Latest Projects</h4>
          </div>
          <table class="table table-striped">
            <thead class="thead-dark">
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>description</th>
                <th>created by</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody id="tbody">
              <?php $i = 1; ?>
              @foreach($projects as $project)
              <tr id="tr-{{ $project->id }}">
                <td>{{ $i }}</td>
                <td>{{ $project->project_name }}</td>
                <td>{{ $project->project_description }}</td>
                <td>{{ $project->user_name }}</td>
        
                <td>
                  <button class="btn btn-success btn-sm" data-action="{{ route('project.update', ['id' => $project->id]) }}" id="btnEdit">
                    <i class="far fa-edit"></i> Edit
                  </button>
                  <button class="btn btn-danger btn-sm" data-action="{{ route('project.destroy', ['id' => $project->id]) }}" id="btnDelete">
                    <i class="far fa-trash-alt"></i> Delete
                  </button>
            
                </td>
              </tr>
              <?php $i++ ?>
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <td colspan="2"></td>
                <td>{{ $projects->links() }}</td>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>
@include('project.add_modal')
@include('project.edit_modal')
@endsection

@push('js')
<script>

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).on('click', '#btnDelete', function(e) {
  var action = $(this).data('action');
  var msg = confirm('Are you sure?');

  if (msg) {
    $.ajax({
      url: action,
      type: 'POST',
      data: {

        _method: 'DELETE'
      },
      success: function(data) {
        if (data.message == 'success') {
          $('#tr-' + data.data).remove();
        }
      }
    });
  }
});
</script>
@endpush
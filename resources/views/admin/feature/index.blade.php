@extends('admin.layouts.app')
@section('content')
<div class="main-panel">
  <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title ">Features Manager</h4>
                <p class="card-category">List of Features</p>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <div class="gapMe" >
                  <a href="{{route('admin.feature.create')}}" class="btn btn-primary float-right">Add New</a>
                  </div>
                  <table class="tableRouteManager">
                    <thead class=" text-primary">
                      <th>ID</th>
                      <th>Feature Logo</th>
                      <th>Title</th>
                      <th>Description</th>
                      <th>Action</th>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
  $(document).ready(function() {
    $('.tableRouteManager').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('admin.features') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'image', name: 'image',render: function( data, type, full, meta ) { return "<img src='"+ "{{asset('features')}}/" + data + "' height='50'/>"; }},
            {data: 'title', name: 'title'},
            {data: 'description', name: 'description'},
            {
                data: 'action', 
                name: 'action', 
                orderable: true, 
                searchable: true,
            },
        ]
    });
  } );



  $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': "{{ csrf_token() }}"
          }
      });
  function deleteData(e){
    var table = $('.tableRouteManager').DataTable();
    var id = e.getAttribute('data-id');
    var url = e.getAttribute('data-url');
      swal({
          title: "Are you sure?",
          text: "Once deleted, you will not be able to recover this imaginary file!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
      })
      .then((willDelete) => {
          if (willDelete) {
              $.ajax({
                  url : url,
                  type : "POST",
                  data : {'_method' : 'DELETE'},
                  success: function(){
                      swal({
                          title: "Success!",
                          text : "Post has been deleted \n Click OK to refresh the page",
                          icon : "success",
                      }).then(function(){
                          $(e).closest("tr").remove();
                      });
                  },
                  error : function(){
                      swal({
                          title: 'Opps...',
                          text : "Something Wrong",
                          type : 'error',
                          timer : '1500'
                      })
                  }
              })
          } else {
          swal("Your imaginary file is safe!");
          }
      });
  }
</script>
@endpush
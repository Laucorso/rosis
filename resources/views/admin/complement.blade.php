<div class="modal-header text-primary ">
    <h5 class="modal-title" id="userModalLabel"><i class="fa fa-building"></i> 'New Company'</h5>
    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
</div>
<div class="modal-body bg-light">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="main-tab" data-toggle="tab" href="#main" role="tab" aria-controls="main" aria-selected="true"><i class="fa fa-fw fa-database"></i> Main</a>
        </li>
        @if( 1 )
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="users-tab" data-toggle="tab" href="#users" role="tab" aria-controls="users" aria-selected="false"><i class="fa fa-fw fa-users"></i> Users</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="users-tab" data-toggle="tab" href="#templates" role="tab" aria-controls="templates" aria-selected="false"><i class="fa fa-fw fa-list-alt"></i> Templates</a>
        </li>
        @endif
    </ul>
    <div class="tab-content border border-top-0 rounded-bottom small bg-white">
        <div class="p-4 tab-pane fade show active" id="main" role="tabpanel" aria-labelledby="main-tab">
            <input type="hidden" name="id" value="">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control form-control-sm" id="name" name="name" value="" autofocus>
            </div>
            <div class="form-group">
                <label for="logo">Logo</label>
                <div id="logo" class="upload w-50">
                </div>
            </div>
            <div class="justify-content-between">
                <div id="buttons">
                    <button type="submit" name="action" value="save" class="btn btn-primary btn-sm">Update</button>
                    <button id="confirm" class="btn btn-danger btn-sm">Delete</button>
                </div>
                <div id="sure" style="display: none;">
                    <span>
                        <b>Do you really want to delete company?</b>
                        <button id="no" type="submit" name="action" value="cancel" class="btn btn-success btn-sm ml-2">No</button>
                        <button type="submit" name="action" value="delete" class="btn btn-danger btn-sm">Yes</button>
                    </span>
                </div>
            </div>
        </div>
        <div class="p-4 tab-pane fade" id="users" role="tabpanel" aria-labelledby="users-tab">
            <div id="usersTableContent">
            </div>
        </div>
        <div class="p-4 tab-pane fade" id="templates" role="tabpanel" aria-labelledby="templates-tab">
            <div id="templatesTableContent">
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Close</button>
</div>
<script>
    var dropbox = new XMMDropbox("logo",{extensions:["gif","png","jpg","svg"],preview:true});
    $("#confirm").on("click", function (event) {
        event.preventDefault();
        event.stopPropagation();
        $("#sure").show();
        $("#buttons").hide();
    });
    $("#no").on("click", function (event) {
        event.preventDefault();
        event.stopPropagation();
        $("#sure").hide();
        $("#buttons").show();
    });
</script>

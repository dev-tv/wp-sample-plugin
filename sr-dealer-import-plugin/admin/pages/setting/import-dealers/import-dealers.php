<hr>
<div class="import-export-container">
    <br />
    <div class="row">
        <form action="" method="POST" class="form-horizontal" id="import-form" name="import-form" enctype="multipart/form-data" style="display: none">
            <input type="file" name="csv" id="import-input" style="display: none" />
        </form>
        <div class="col-md-12 text-center">
            <span>
                <span id="uploaded-file" style="display: none;"></span>
            </span>
            <br />
            <!--<input type="file" name="csv" id="import-input" style="display: none" />-->
            <button class="btn btn-primary cpd-button import-btn" data-button-type="import">Import From CSV</button>
        </div>
    </div>
</div>
<div class="row text-center">
    <div id="export-progress" class="jq-progress-bar">
        <strong></strong>
        <span>This might take a while ...</span>
        <span>Please do not refresh your browser</span>
    </div>
</div>
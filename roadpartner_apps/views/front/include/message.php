<div class="row">
    <div class="col-sm-12">
        <div class="alert {message_class}">
            <a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>
            {message}
        </div>
    </div>
</div>


<script>
    $('div.alert').not('.alert-important').delay(20000).slideUp(300);
</script>
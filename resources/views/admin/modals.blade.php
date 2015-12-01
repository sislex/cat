<div class="modal fade bs-modal-sm" id="delete-confirmation" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title bold">
                    Подтверждение удаления
                </h4>
            </div>
            <div class="modal-body">
                Вы действительно хотите удалить данную запись?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn col-md-5 btn-outline btn-circle btn-sm green" data-dismiss="modal">
                    Отмена
                </button>
                <a href="" class="btn col-md-5 btn-outline btn-circle btn-sm red">
                    Удалить
                </a>

            </div>
        </div>
    </div>
</div>

<script type="application/javascript">
    $(document).on('click', '.modal-del-confirm', function(e){
        e.preventDefault();
        var modal = $('#delete-confirmation');
        var url = $(this).attr('del-url');
        var obj = $(this).attr('del-obj');
        modal.find('.btn-sm').attr('href', url);
        modal.find('.modal-body').html(obj);
        modal.modal('show');
    });
</script>
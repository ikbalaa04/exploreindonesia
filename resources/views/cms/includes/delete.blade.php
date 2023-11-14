<!-- modal delete  -->
<div class="modal fade" role="dialog" id="modal_delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="modal_header_delete">Konfirmasi hapus sementara</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>  
            <div class="modal-body">
                <p id="modal_body_delete">Yakin Delete data ini sementara?</p>
            </div>
            <div class="modal-footer">
                <button type="button" id="delete_button" class="btn btn-danger">Delete</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>   
        </div>
    </div>
</div>

<!-- modal active  -->
<div class="modal fade" role="dialog" id="modal_active">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="modal_header_active">Konfirmasi Aktif</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>  
            <div class="modal-body">
                <p id="modal_body_active">Yakin mengaktifkan data ini kembali?</p>
            </div>
            <div class="modal-footer">
                <button type="button" id="active_button" class="btn btn-success">active</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>   
        </div>
    </div>
</div>

<!-- modal deletePermanent  -->
<div class="modal fade" role="dialog" id="modal_deletePermanent">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Confirm delete permanently</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>  
            <div class="modal-body">
                <p>This data will be permanently deleted, and all related data will be lost. Are you sure Delete this data?</p>
            </div>
            <div class="modal-footer">
                <button type="button" id="deletePermanent_button" class="btn btn-danger">Delete</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            </div>   
        </div>
    </div>
</div>

<!-- modal Stock 0  -->
<div class="modal fade" role="dialog" id="modal_stock">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Stock Akan di Set Jadi 0</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>  
            <div class="modal-body">
                <p>Data ini akan di set jadi 0, Apakah Kamu Yakin?</p>
            </div>
            <div class="modal-footer">
                <button type="button" id="stock_button" class="btn btn-danger">Iya</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            </div>   
        </div>
    </div>
</div>

<!-- modal accept  -->
<div class="modal fade" role="dialog" id="modal_accept">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="accept_title">Konfirmasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>  
            <div class="modal-body">
                <p id="accept_body">Yakin Delete data ini?</p>
            </div>
            <div class="modal-footer">
                <button type="button" id="accept_button" class="btn btn-success">Iya</button>
                <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
            </div>   
        </div>
    </div>
</div>
<!-- modal decline  -->
<div class="modal fade" role="dialog" id="modal_decline">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="decline_title">Konfirmasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>  
            <div class="modal-body">
                <p id="decline_body">Yakin Delete data ini?</p>
            </div>
            <div class="modal-footer">
                <button type="button" id="decline_button" class="btn btn-success">Iya</button>
                <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
            </div>   
        </div>
    </div>
</div>

{{-- input modal reschedule  --}}
<div class="modal fade" id="modal_reschedule" tabindex="-1" aria-labelledby="rescheduleLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="rescheduleLabel">Reschedule</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="text-danger showError" style="font-size: 12px" id="showError"></div>
        <form>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Reschedule:</label>
            <input type="text" required class="form-control form-control-lg" autocomplete="off" value="{{ old('date') }}" id="date" name="date" placeholder="Masukan Tanggal Reschedule">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Alasan:</label>
            <textarea class="form-control form-control-lg" name="reason" id="reason" value="{{ old("reason") }}" id="message-text"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" id="reschedule_button" class="btn btn-warning">Reschedule</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
      </div>
    </div>
  </div>
</div>

{{-- input modal refund  --}}
<div class="modal fade" id="modal_refund" tabindex="-1" aria-labelledby="refundLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="refundLabel">Refund</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="text-danger showErrors" style="font-size: 12px" id="showErrors"></div>
        <form>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Name Bank:</label>
            <input type="text" required class="form-control form-control-lg" autocomplete="off" value="{{ old('account_bank') }}" id="account_bank" name="account_bank" placeholder="Inputkan Name Bank, Example: MANDIRI">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Nomer Rekening:</label>
            <input type="text" required class="form-control form-control-lg" autocomplete="off" value="{{ old('account_number') }}" id="account_number" name="account_number" placeholder="Inputkan nomer rekening anda">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Atas Name:</label>
            <input type="text" required class="form-control form-control-lg" autocomplete="off" value="{{ old('account_name') }}" id="account_name" name="account_name" placeholder="Inputkan Atas Name, Example : zulkifli">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Alasan:</label>
            <textarea class="form-control form-control-lg" name="reasons" id="reasons" value="{{ old("reasons") }}" id="message-text"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" id="refund_button" class="btn btn-warning">Refund</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
      </div>
    </div>
  </div>
</div>
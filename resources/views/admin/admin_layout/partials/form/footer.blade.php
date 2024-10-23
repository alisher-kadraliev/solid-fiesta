<div class="form-footer">
    <div class="form-buttons-container">
        <div>
            <button type="submit" class="button primary-button submit-button js-ak-submit-button">
                <span>
                    @includeIf("admin.admin_layout/partials/misc/loading")
                    {{trans('admin/form.save_button')}}
                </span>
            </button>
        </div>
        @if($cancel_route)
            <div>
                <a href="{{ $cancel_route }}" class="button cancel-button">{{trans('admin/form.cancel_button')}}</a>
            </div>
        @endif
    </div>
</div>

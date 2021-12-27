<template>
    <modal id="employee-bank-account-modal"
           size="large"
           v-model="showModal"
           :title="generateModalTitle('bank_account')"
           @submit="submitData"
           :loading="loading"
           :preloader="preloader">
        <form ref="form"
              :data-url="selectedUrl ? selectedUrl : url"
              @submit.prevent="submitData">
            <div class="row">
                <div class="col-md-6">
                    <app-form-group-selectable
                        type="search-select"
                        :label="$t('bank')"
                        list-value-field="name"
                        :chooseLabel="$t('bank')"
                        v-model="formData.bank_id"
                        :error-message="$errorMessage(errors, 'bank_id')"
                        :fetch-url="`${TENANT_SELECTABLE_BANK}`"
                    />
                </div>
            </div>

            <div class="row">                
                <div class="col-md-6">
                    <app-form-group
                        :label="$t('branch_name')"
                        :placeholder="$placeholder('branch_name')"
                        v-model="formData.branch_name"
                        :error-message="$errorMessage(errors, 'branch_name')"
                    />
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <app-form-group
                        :label="$t('account_holder_name')"
                        :placeholder="$placeholder('account_holder_name')"
                        v-model="formData.account_holder_name"
                        :error-message="$errorMessage(errors, 'account_holder_name')"
                    />
                </div>
                <div class="col-md-6">
                    <app-form-group
                        :label="$t('bank_account_no')"
                        :placeholder="$placeholder('bank_account_no')"
                        v-model="formData.bank_account_no"
                        :error-message="$errorMessage(errors, 'bank_account_no')"
                    />
                </div>
            </div>
        </form>
    </modal>
</template>
<script>

import ModalMixin from "../../../../../../common/Mixin/Global/ModalMixin";
import FormHelperMixins from "../../../../../../common/Mixin/Global/FormHelperMixins";
import {flatObjectWithKey} from "../../../../../../common/Helper/ObjectHelper";
import {TENANT_SELECTABLE_BANK} from "../../../../../../common/Config/apiUrl";

export default {
    name: "EmployeeBankAccountEditModel",
    mixins: [FormHelperMixins, ModalMixin],
    props: {
        url: {},
    },
    data() {
        return {
            TENANT_SELECTABLE_BANK,
            formData: {},
            errors: {},
            preloader: false,
        }
    },
    methods: {
        submitData() {
            this.loading = true;
            const formData = {...this.formData};
            this.save(formData)
        },
        afterSuccess({data}) {
            this.loading = false;
            $('#employee-bank-account-modal').modal('hide');
            this.$toastr.s('', data.message);
            this.$emit('reload')
        },
        afterSuccessFromGetEditData({data}) {
            this.preloader = false;
            this.formData = data;
            this.formData = flatObjectWithKey(this.formData, 'value');
        },
    },
}
</script>
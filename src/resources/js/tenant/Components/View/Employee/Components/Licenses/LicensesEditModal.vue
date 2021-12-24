<template>
    <modal id="employee-license-modal"
           size="large"
           v-model="showModal"
           :title="generateModalTitle('license')"
           @submit="submitData"
           :loading="loading"
           :preloader="preloader">
        <form ref="form"
              :data-url="selectedUrl ? selectedUrl : url"
              @submit.prevent="submitData">
            <div class="row">
                <div class="col-md-6">
                    <app-form-group
                        :label="$t('license_name')"
                        :placeholder="$placeholder('license_name')"
                        v-model="formData.license_name"
                        :error-message="$errorMessage(errors, 'license_name')"
                    />
                </div>
                <div class="col-md-6">
                    <app-form-group
                        :label="$t('license_description')"
                        :placeholder="$placeholder('license_description')"
                        v-model="formData.license_description"
                        :error-message="$errorMessage(errors, 'license_description')"
                    />
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <app-form-group
                            :label="$fieldTitle('valid_from', '')"
                            :id="'valid_from'"
                            type="date"
                            v-model="formData.valid_from"
                            :placeholder="$placeholder('valid_from', '')"
                            :required="true"
                            :error-message="$errorMessage(errors, 'valid_from')"
                        />
                </div>
                <div class="col-md-6">
                    <app-form-group
                            :label="$fieldTitle('valid_to', '')"
                            :id="'valid_to'"
                            type="date"
                            v-model="formData.valid_to"
                            :placeholder="$placeholder('valid_to', '')"
                            :required="true"
                            :error-message="$errorMessage(errors, 'valid_to')"
                        />
                </div>

                <div class="col-md-12">
                    <app-form-group
                        :label="$t('license_no')"
                        :placeholder="$placeholder('license_no')"
                        v-model="formData.license_no"
                        :required="true"
                        :error-message="$errorMessage(errors, 'license_no')"
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
import {formatDateForServer} from "../../../../../../common/Helper/Support/DateTimeHelper";

export default {
    name: "EmployeeLicenseEditModel",
    mixins: [FormHelperMixins, ModalMixin],
    props: {
        url: {},
    },
    data() {
        return {
            formData: {
                valid_from: '',
                valid_to: '',
            },
            errors: {},
            preloader: false,
        }
    },
    methods: {
        submitData() {
            let formData = {...this.formData};

            formData.valid_from = formatDateForServer(this.formData.valid_from);
            formData.valid_to = formatDateForServer(this.formData.valid_to);

            console.log(formData.valid_from)

            this.loading = true;
            this.save(formData)
        },
        afterSuccess({data}) {
            this.loading = false;
            $('#employee-license-modal').modal('hide');
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
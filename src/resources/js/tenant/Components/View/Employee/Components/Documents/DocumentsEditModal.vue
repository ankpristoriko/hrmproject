<template>
    <modal id="employee-documents-modal"
           v-model="showModal"
           size="large"
           :title="$fieldTitle(actionType , title === '' ? 'npwp' : title, true)"
           @submit="submit"
           :loading="loading"
           :preloader="preloader"
           :scrollable="false"
    >
        <form ref="form"
              :data-url="url"
              @submit.prevent="submitData">

            <div class="row">
                <div class="col-md-12">
                    <app-form-group
                        :label="$t('document_no')"
                        :placeholder="$placeholder('document_no')"
                        v-model="formData.document_no"
                        :error-message="$errorMessage(errors, 'document_no')"
                    />
                </div>
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
            </div>

            <app-form-group
                :label="$t('note')"
                type="textarea"
                :placeholder="$textAreaPlaceHolder('note')"
                v-model="formData.note"
                :required="true"
                :error-message="$errorMessage(errors, 'note')"
            />
        </form>
    </modal>
</template>
<script>

import ModalMixin from "../../../../../../common/Mixin/Global/ModalMixin";
import FormHelperMixins from "../../../../../../common/Mixin/Global/FormHelperMixins";
import {flatObjectWithKey} from "../../../../../../common/Helper/ObjectHelper";
import {formatDateForServer} from "../../../../../../common/Helper/Support/DateTimeHelper";

export default {
    name: "EmployeeDocumentsEditModal",
    mixins: [FormHelperMixins, ModalMixin],
    props: {
        title: {},
        document: {},
        url: {}
    },
    data() {
        return {
            actionType: '',
            formData: {
                __method: 'PATCH',
                type: this.title,
                document_no: '',
                valid_from: '',
                valid_to: '',
                note: '',
            }
        }
    },
    methods: {
        submit() {
            let formData = {...this.formData};

            formData.valid_from = formatDateForServer(this.formData.valid_from);
            formData.valid_to = formatDateForServer(this.formData.valid_to);

            this.fieldStatus.isSubmit = true;
            this.loading = true;
            this.message = '';
            this.errors = {};
            this.save(formData);
        },
        afterSuccess({data}) {
            this.loading = false;
            $('#employee-documents-modal').modal('hide');
            this.$toastr.s('', data.message);
            this.$emit('reload')
        },
    },
    created() {
        this.actionType = this.document.value ? 'edit' : 'add';
        this.formData = flatObjectWithKey(this.document, 'value');
        this.formData._method = 'PATCH';
        this.formData.type = this.title;
    }
}
</script>
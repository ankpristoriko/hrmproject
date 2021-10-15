<template>
    <modal :modal-id="modalId"
                     :title="modalTitle"
                     :preloader="preloader"
                     @submit="submit"
                     @close-modal="closeModal">
        <template slot="body">
            <app-overlay-loader v-if="preloader"/>
            <form class="mb-0"
                  :class="{'loading-opacity': preloader}"
                  ref="form"
                  :data-url='selectedUrl ? `/core_hr/promotions/${inputs.id}` : `/core_hr/promotions`'>
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="inputs_company_id">
                                {{ $t('company') }}
                            </label>
                            <app-input id="inputs_company_id"
                                    type="search-select"
                                    :list="companyLists"
                                    :placeholder="$t('choose_company')"
                                    list-value-field="company_name"
                                    :isAnimatedDropdown="true"
                                    v-model="inputs.company_id"
                                    :required="true"/>
                        </div>

                        <div class="form-group">
                            <label for="inputs_employee_id">
                                {{ $t('employee') }}
                            </label>
                            <app-input id="inputs_employee_id"
                                    type="search-select"
                                    :list="employeeLists"
                                    :placeholder="$t('choose_employee')"
                                    list-value-field="employee_name"
                                    :isAnimatedDropdown="true"
                                    v-model="inputs.employee_id"
                                    :required="true"/>
                        </div>

                        <div class="form-group">
                            <label for="inputs_promotion_title">
                                {{ $t('title') }} <span style="color:red">*</span>
                            </label>
                            <app-input id="inputs_promotion_title"
                                type="text"
                                v-model="inputs.promotion_title"
                                :placeholder="$t('title')"
                                :required="true"/>
                        </div>

                        <div class="form-group">
                            <label for="inputs_promotion_date">
                                {{ $t('promotion_date') }}
                            </label>
                            <app-input id="inputs_promotion_date"
                                    type="date"
                                    v-model="inputs.promotion_date"
                                    :placeholder="$t('select_promotion_date')"/>
                        </div>

                        <div class="form-group">
                            <label for="inputs_description">
                                {{ $t('description') }}
                            </label>
                            <app-input id="inputs_description"
                                type="textarea"
                                v-model="inputs.description"
                                :placeholder="$t('description')"/>
                        </div>
                    </div>
                </div>
                
            </form>
        </template>
    </modal>
</template>

<script>
    import {FormMixin} from '../../../../../core/mixins/form/FormMixin';
    import {ModalMixin} from "../../../Mixins/ModalMixin";
    import * as actions from "../../../../Config/ApiUrl";
    
    export default {
        name: "PromotionModal",
        mixins: [FormMixin, ModalMixin],
        props: {
            tableId: String
        },
        data() {
            return {
                customFile: null,
                customFileName: null,
                preloader: false,
                companyLists: [],
                employeeLists: [],
                inputs: {
                    company_id: '',
                    promotion_title: '',
                    description: '',
                    employee_id: '',
                    promotion_date: ''
                },
                modalId: 'promotion-add-edit-Modal',
                modalTitle: this.$t('add_promotion'),
            }
        },
        created() {
            if (this.selectedUrl) {
                this.modalTitle = this.$t('edit_promotion');
                this.preloader = true;
            }

            this.getCompanies();
        },
        watch: {
            'inputs.company_id': function() {
                this.getEmployees(this.inputs.company_id);
            }
        },
        methods: {
            submit() {
                this.save(this.inputs);
            },
            
            afterSuccess(response) {
                this.$toastr.s(response.data.message);
                this.$hub.$emit('reload-' + this.tableId);
            },

            // getCompanies(){
            //     let url = actions.GET_ALL_COMPANIES;
            //     this.preloader = this.hasData ? true : false;
            //     this.axiosGet(url).then(response => {
            //         this.companyLists = response.data;
            //     }).catch(({response}) => {

            //     }).finally(() => {
            //         this.preloader = false;
            //     });
            // },

            getEmployees(company_id){
                let url = `${actions.EMPLOYEES_LIST}`;
                this.preloader = this.hasData ? true : false;
                this.axiosGet(url).then(response => {
                    this.employeeLists = response.data;
                }).catch(({response}) => {

                }).finally(() => {
                    this.preloader = false;
                });
            },

            afterSuccessFromGetEditData(response) {
                this.inputs = response.data;
                this.preloader = false;
            },

            hideModal() {
                $('#' + this.modalId).modal('hide');
            },
            
            closeModal() {
                this.hideModal();
                this.$emit('closeModal')
            },
        },
    }
</script>

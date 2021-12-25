<template>
    <div>
        <app-overlay-loader v-if="preloader"/>
        <template v-else>
            <div class="row mb-primary" v-for="bankAccount in bankAccounts">
                <div class="col-lg-4">
                    <div class="d-flex align-items-center mb-3 mb-lg-0">
                        <div>
                            <div class="icon-box mr-2">
                                <app-icon name="file-text"/>
                            </div>
                        </div>
                        {{ bankAccount.value.license_name }}
                    </div>
                </div>
                <div class="col-lg-4">
                    <template>
                            {{ bankAccount.value.license_no }}
                    </template>
                    <br />
                    <template>
                            {{ bankAccount.value.license_description }}
                    </template>
                </div>
                <div class="col-lg-3">
                    <div class="text-right mt-3 mt-lg-0">
                        <div class="btn-group btn-group-action" role="group"
                             aria-label="Default action">
                            <button class="btn"
                                    data-toggle="tooltip"
                                    data-placement="top"
                                    :title="$t('edit')"
                                    v-if="$can('update_employee_bank_accounts')"
                                    @click="editModal(bankAccount.id)">
                                <app-icon name="edit"/>
                            </button>
                            <button class="btn"
                                    data-toggle="tooltip"
                                    data-placement="top"
                                    :title="$t('delete')"
                                    v-if="$can('delete_employee_bank_accounts')"
                                    @click="getConfirmations(bankAccount.id)">
                                <app-icon name="trash-2"/>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row align-items-center" v-if="$can('create_employee_bank_accounts')">
                <div class="col-lg-4">
                    <div class="d-flex align-items-center mb-3 mb-lg-0">
                        <div>
                            <div class="icon-box mr-2">
                                <app-icon name="file-plus"/>
                            </div>
                        </div>
                        {{ $t('bank_account') }}
                    </div>
                </div>
                <div class="col-lg-4">
                    <p class="text-muted mb-0">
                        {{ $t('you_can_add_multiple_bank_accounts') }}
                    </p>
                </div>
                <div class="col-lg-3">
                    <div class="text-right">
                        <button class="btn btn-primary" @click="addModal" >
                            {{ $t('add') }}
                        </button>
                    </div>
                </div>
            </div>
        </template>

        <app-employee-bank-account-modal
            v-if="isModalActive"
            v-model="isModalActive"
            @close="isModalActive = false"
            :selected-url="selectedUrl"
            @reload="getBankAccounts"
            :url="url"
        />
        <app-confirmation-modal
            v-if="confirmationModalActive"
            icon="trash-2"
            modal-id="app-confirmation-modal"
            @confirmed="deleteModal"
            @cancelled="cancelled"
            :reload="getBankAccounts()"
        />
    </div>
</template>

<script>
import {axiosGet, axiosDelete} from "../../../../../../common/Helper/AxiosHelper";
import BankAccountsDetails from "./Components/BankAccountDetails";

export default {
    name: "BankAccounts",
    components: {BankAccountsDetails},
    props: ['props'],
    data() {
        return {
            confirmationModalActive: false,
            preloader: true,
            bankAccounts: [],
            isModalActive: false,
            selectedUrl: '',
            deletedUrl: ''
        }
    },
    mounted() {
        this.getBankAccounts();
    },
    methods: {
        getBankAccounts() {
            axiosGet(this.url).then(({data}) => {
                this.bankAccounts = data;
            }).finally(() => {
                this.preloader = false;
            });
        },
        openModal() {
            this.isModalActive = true;
        },
        addModal() {
            this.selectedUrl = '';
            this.openModal();
        },
        editModal(bankAccountId) {
            this.selectedUrl = `${this.url}/${bankAccountId}`;
            this.openModal();
        },
        deleteModal() {
            axiosDelete(this.deletedUrl).then(({data}) => {
                this.$toastr.s('', data.message);
                this.deletedUrl = '';
                this.confirmationModalActive = false;
                // this.$emit('reload');
                this.getBankAccounts();
            }).catch((error) => {
                if (error.response)
                    this.toastException(error.response.data)
            });
        },
        getConfirmations(bankAccountId) {
            this.deletedUrl = `${this.url}/${bankAccountId}`;
            this.confirmationModalActive = true;
        },
        cancelled() {
            this.confirmationModalActive = false;
        },
    },
    computed: {
        url() {
            return `${this.apiUrl.EMPLOYEES}/${this.props.id}/bank-accounts`;
        }
    }
}
</script>
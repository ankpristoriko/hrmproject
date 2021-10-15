<template>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <app-breadcrumb :page-title="$t('promotion')" :directory="$t('datatables')" :icon="'grid'"/>
            </div>
            <div class="col-sm-12 col-md-6 breadcrumb-side-button">
                <div class="float-md-right mb-3 mb-sm-3 mb-md-0">
                    <button type="button"
                            class="btn btn-primary btn-with-shadow"
                            data-toggle="modal"
                            @click="openAddEditModal">
                        {{ $t('add_promotion') }}
                    </button>
                </div>
            </div>
        </div>

        <app-table
            :id="tableId"
            :options="options"
            @action="getListAction"
        />

        <promotion-modal
            v-if="isModalActive"
            :table-id="tableId"
            modal-id="promotion-modal"
            :selected-url="selectedUrl"
            @closeModal="isModalActive = false"
        />

        <app-delete-modal
            v-if="deleteConfirmationModalActive"
            :preloader="deleteLoader"
            modal-id="promotion-delete"
            @confirmed="confirmed"
            @cancelled="cancelled"
        />
    </div>
</template>

<script>
import CoreLibrary from "../../../../../core/helpers/CoreLibrary.js";
import * as actions from "../../../../Config/ApiUrl";
import {PromotionTableHelpers} from "./PromotionTableHelpers";

export default {
    extends: CoreLibrary,
    name: "Promotion",
    mixins: [PromotionTableHelpers],
    props: {
        props: {
            default: ''
        },
        id: {
            type: String
        }
    },
    data() {
        return {
            isModalActive: false,
            deleteConfirmationModalActive: false,
            deleteLoader: false,
            selectedUrl: '',
            tableId: 'promotion-view-table',
            rowData: {},
            options: {
                name: this.$t("promotion_table"),
                url: actions.PROMOTION_DATA,
                showHeader: true,
                columns: [
                    {
                        title: this.$t('promotion_employee'),
                        type: 'object',
                        key: 'promotion_employee',
                        modifier: (value, row) => {
                            return row.employee.first_name + ' ' + row.employee.last_name
                        }
                    },
                    // {
                    //     title: this.$t('company_name'),
                    //     type: 'object',
                    //     key: 'company_name',
                    //     modifier: (value, row) => {
                    //         return row.company.company_name
                    //     }
                    // },
                    {
                        title: this.$t('promotion_title'),
                        type: 'text',
                        key: 'promotion_title',
                    },
                    {
                        title: this.$t('promotion_date'),
                        type: 'text',
                        key: 'promotion_date',
                    },
                ],
                actions: [
                    {
                        title: this.$t('edit'),
                        icon: 'edit',
                        type: 'none',
                        component: 'promotion-modal',
                        modalId: 'promotion-add-edit-Modal',

                    }, {
                        title: this.$t('delete'),
                        icon: 'trash',
                        type: 'none',
                        component: 'app-confirmation-modal',
                        modalId: 'promotion-delete',
                    }
                ],
                filters: [
                    {
                        "title": this.$t('search_and_select_employee'),
                        "type": "drop-down-filter",
                        "key": "search-select-employee",
                        "option": [],
                    },
                    {
                        "title": this.$t('promotion_date_range'),
                        "type": "range-picker",
                        "key": "date",
                        "option": ["today", "thisMonth", "last7Days", "nextYear"]
                    },
                ],
                showFilter: true,
                showSearch: true,
                showCount: true,
                showClearFilter: true,
                paginationType: "pagination",
                responsive: true,
                rowLimit: 10,
                showAction: true,
                orderBy: 'desc',
                actionType: "default",
            }
        }
    },

    mounted() {
        this.$hub.$on('headerButtonClicked-' + this.id, (component) => {
            this.isModalActive = true;
            this.selectedUrl = '';
        })
    },

    created() {
        this.options.columns = [...this.tableColumns, this.actionObj];
        this.searchAndSelectEmployeeOptions();
        // this.searchCompaniesFilterOptions();
    },

    methods: {
        /**
         * for open add edit modal
         */
        openAddEditModal() {
            this.isModalActive = true;
        },
   
        /**
         * for close add edit modal
         */
        closeAddEditModal() {
            $("#promotion-add-edit-Modal").modal('hide');
            this.isModalActive = false;
            this.searchAndSelectEmployeeOptions();
            // this.searchCompaniesFilterOptions();
            this.resetData();
        },

        /**
         * $emit Form datatable action
         */
        getListAction(rowData, actionObj, active) {
            this.rowData = rowData;

            if (actionObj.title == 'Delete') {
                this.openDeleteModal();
            } else if (actionObj.title == this.$t('edit')) {
                this.selectedUrl = `${actions.PROMOTION_DATA}/${rowData.id}`;
                this.openAddEditModal();
            }
        },

        /**
         * for open confirmation modal
         */
        openDeleteModal() {
            this.deleteConfirmationModalActive = true;
        },

        /**
         * confirmed $emit Form confirmation modal
         */
        confirmed() {
            let url = `${actions.PROMOTION_DATA}/${this.rowData.id}`;
            this.deleteLoader = true;
            this.axiosDelete(url)
                .then(response => {
                    this.deleteLoader = false;
                    $("#promotion-delete").modal('hide');
                    this.cancelled();
                    this.$toastr.s(response.data.message);
                    this.searchAndSelectEmployeeOptions();
                    // this.searchCompaniesFilterOptions();
                }).catch(({error}) => {
                //trigger after error
            }).finally(() => {
                this.$hub.$emit('reload-' + this.tableId);
            });
        },

        /**
         * cancelled $emit Form confirmation modal
         */
        cancelled() {
            this.deleteConfirmationModalActive = false;
            this.resetData();
        },

        resetData() {
            this.rowData = {};
            this.selectedUrl = '';
        },

        // searchCompaniesFilterOptions() {
        //     this.axiosGet(actions.GET_ALL_COMPANIES).then(response => {
        //         this.options.filters.push({
        //             "title": this.$t('company_name_filter'),
        //             "type": "checkbox",
        //             "key": "filter-by-company",
        //             "option": [] = response.data.map(company => {
        //                 return {
        //                     id: company.id,
        //                     value: company.company_name
        //                 }
        //             })
        //         })
        //     });
        // },

        searchAndSelectEmployeeOptions() {
            this.axiosGet(actions.PROMOTION_SEARCH_SELECT).then(response => {
                let employee = this.options.filters.find(element => element.title === this.$t('search_and_select_employee'));
                
                employee.option = response.data.map(employee => {
                    return {
                        id: employee.employee_id,
                        value: employee.employee_name
                    }
                });
            });
        }
    },

    beforeDestroy() {
        this.$hub.$off('headerButtonClicked-' + this.id);
    }
}
</script>

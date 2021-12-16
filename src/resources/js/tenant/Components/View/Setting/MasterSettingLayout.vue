<template>
    <div class="content-wrapper">
        <app-breadcrumb :page-title="pageTitle" :icon="pageIcon"/>
        <app-tab :tabs="tabs" :icon="pageIcon"/>
    </div>
</template>

<script>
    export default {
        name: "MasterSettingLayout",
        props: {
            permissions: {}
        },
        data() {
            return {
                pageTitle: 'Master Settings',
                pageIcon: 'grid',
                tabs: [
                    // {
                    //     "name": this.$t('company_type'),
                    //     "title": this.$t('company_type'),
                    //     "component": "company-type-view-table",
                    //     "permission": this.permissions.company_types,
                    //     "headerButton": {
                    //         "label": this.$t('add_company_type'),
                    //         "class": 'btn btn-primary',
                    //     }
                    // },
                    // {
                    //     "name": this.$t('leave_type'),
                    //     "title": this.$t('leave_type'),
                    //     "component": "leave-type-view-table",
                    //     "permission": this.permissions.leave_types,
                    //     "headerButton": {
                    //         "label": this.$t('add_leave_type'),
                    //         "class": 'btn btn-primary',
                    //     }
                    // },
                    // {
                    //     "name": this.$t('expense_type'),
                    //     "title": this.$t('expense_type'),
                    //     "component": "expense-type-view-table",
                    //     "permission": this.permissions.expense_types,
                    //     "headerButton": {
                    //         "label": this.$t('add_expense_type'),
                    //         "class": 'btn btn-primary'
                    //     }
                    // },
                    // {
                    //     "name": this.$t('employee_status'),
                    //     "title": this.$t('employee_status'),
                    //     "component": "employee-status-view-table",
                    //     "permission": this.permissions.employee_statuses,
                    //     "headerButton": {
                    //         "label": this.$t('add_employee_status'),
                    //         "class": 'btn btn-primary'
                    //     }
                    // },
                    {
                        name: this.$t('document_type'),
                        title: this.$t('document_type'),
                        component: "app-document-types",
                        permission: this.$can('view_document_types'),
                        headerButton: {
                            label: this.$t('add_document_type'),
                            class: 'btn btn-primary'
                        }
                    },
                    {
                        name: this.$t('warning_type'),
                        title: this.$t('warning_type'),
                        component: "app-warning-types",
                        permission: this.$can('view_warning_types'),
                        headerButton: {
                            label: this.$t('add_warning_type'),
                            class: 'btn btn-primary'
                        }
                    },
                    {
                        name: this.$t('award_type'),
                        title: this.$t('award_type'),
                        component: "app-award-types",
                        permission: this.$can('view_award_types'),
                        headerButton: {
                            label: this.$t('add_award_type'),
                            class: 'btn btn-primary'
                        }
                    },
                    {
                        name: this.$t('termination_type'),
                        title: this.$t('termination_type'),
                        component: "app-termination-types",
                        permission: this.$can('view_termination_types'),
                        headerButton: {
                            label: this.$t('add_termination_type'),
                            class: 'btn btn-primary'
                        }
                    },
                    {
                        name: this.$t('expense_type'),
                        title: this.$t('expense_type'),
                        component: "app-expense-types",
                        permission: this.$can('view_expense_types'),
                        headerButton: {
                            label: this.$t('add_expense_type'),
                            class: 'btn btn-primary'
                        }
                    },
                    {
                        name: this.$t('training_type'),
                        title: this.$t('training_type'),
                        component: "app-training-types",
                        permission: this.$can('view_training_types'),
                        headerButton: {
                            label: this.$t('add_training_type'),
                            class: 'btn btn-primary'
                        }
                    },
                    {
                        name: this.$t('education_level'),
                        title: this.$t('education_level'),
                        component: "app-education-levels",
                        permission: this.$can('view_education_levels'),
                        headerButton: {
                            label: this.$t('add_education_level'),
                            class: 'btn btn-primary'
                        }
                    },
                    {
                        name: this.$t('educational_institution'),
                        title: this.$t('educational_institution'),
                        component: "app-educational-institutions",
                        permission: this.$can('view_educational_institutions'),
                        headerButton: {
                            label: this.$t('add_educational_institution'),
                            class: 'btn btn-primary'
                        }
                    },
                    {
                        name: this.$t('relationship'),
                        title: this.$t('relationship'),
                        component: "app-relationships",
                        permission: this.$can('view_relationships'),
                        headerButton: {
                            label: this.$t('add_relationship'),
                            class: 'btn btn-primary'
                        }
                    },
                    {
                        name: this.$t('religion'),
                        title: this.$t('religion'),
                        component: "app-religions",
                        permission: this.$can('view_religions'),
                        headerButton: {
                            label: this.$t('add_religion'),
                            class: 'btn btn-primary'
                        }
                    },
                    {
                        name: this.$t('ethnicity'),
                        title: this.$t('ethnicity'),
                        component: "app-ethnicities",
                        permission: this.$can('view_ethnicities'),
                        headerButton: {
                            label: this.$t('add_ethnicity'),
                            class: 'btn btn-primary'
                        }
                    },
                    // {
                    //     "name": this.$t('country'),
                    //     "title": this.$t('country'),
                    //     "component": "country-view-table",
                    //     "permission": this.permissions.countries,
                    //     "headerButton": {
                    //         "label": this.$t('add_country'),
                    //         "class": 'btn btn-primary'
                    //     }
                    // },
                    // {
                    //     "name": this.$t('tax_type'),
                    //     "title": this.$t('tax_type'),
                    //     "component": "tax-type-view-table",
                    //     "permission": this.permissions.tax_types,
                    //     "headerButton": {
                    //         "label": this.$t('add_tax_type'),
                    //         "class": 'btn btn-primary'
                    //     }
                    // },
                    // {
                    //     "name": this.$t('training_type'),
                    //     "title": this.$t('training_type'),
                    //     "component": "training-type-view-table",
                    //     "permission": this.permissions.training_types,
                    //     "headerButton": {
                    //         "label": this.$t('add_training_type'),
                    //         "class": 'btn btn-primary'
                    //     }
                    // },
                ]
            }
        },
    }
</script>

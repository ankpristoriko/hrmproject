<template>
    <div class="content-wrapper">
        <app-page-top-section :title="$t('master_settings')"/>
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
                        permission: this.$have('PERMISSION_VIEW_DOCUMENT_TYPES'),
                        headerButton: this.$have('PERMISSION_CREATE_DOCUMENT_TYPES') ? {
                            label: this.$addLabel('document_type'),
                            class: 'btn btn-primary'
                        } : {}
                    },
                    {
                        name: this.$t('warning_type'),
                        title: this.$t('warning_type'),
                        component: "app-warning-types",
                        permission: this.$have('PERMISSION_VIEW_WARNING_TYPES'),
                        headerButton: this.$have('PERMISSION_CREATE_WARNING_TYPES') ? {
                            label: this.$addLabel('warning_type'),
                            class: 'btn btn-primary'
                        } : {}
                    },
                    {
                        name: this.$t('award_type'),
                        title: this.$t('award_type'),
                        component: "app-award-types",
                        permission: this.$have('PERMISSION_VIEW_AWARD_TYPES'),
                        headerButton: this.$have('PERMISSION_CREATE_AWARD_TYPES') ? {
                            label: this.$addLabel('award_type'),
                            class: 'btn btn-primary'
                        } : {}
                    },
                    {
                        name: this.$t('termination_type'),
                        title: this.$t('termination_type'),
                        component: "app-termination-types",
                        permission: this.$have('PERMISSION_VIEW_TERMINATION_TYPES'),
                        headerButton: this.$have('PERMISSION_CREATE_TERMINATION_TYPES') ? {
                            label: this.$addLabel('termination_type'),
                            class: 'btn btn-primary'
                        } : {}
                    },
                    {
                        name: this.$t('expense_type'),
                        title: this.$t('expense_type'),
                        component: "app-expense-types",
                        permission: this.$have('PERMISSION_VIEW_EXPENSE_TYPES'),
                        headerButton: this.$have('PERMISSION_CREATE_EXPENSE_TYPES') ? {
                            label: this.$addLabel('expense_type'),
                            class: 'btn btn-primary'
                        } : {}
                    },
                    {
                        name: this.$t('training_type'),
                        title: this.$t('training_type'),
                        component: "app-training-types",
                        permission: this.$have('PERMISSION_VIEW_TRAINING_TYPES'),
                        headerButton: this.$have('PERMISSION_CREATE_TRAINING_TYPES') ? {
                            label: this.$addLabel('training_type'),
                            class: 'btn btn-primary'
                        } : {}
                    },
                    {
                        name: this.$t('education_level'),
                        title: this.$t('education_level'),
                        component: "app-education-levels",
                        permission: this.$have('PERMISSION_VIEW_EDUCATION_LEVELS'),
                        headerButton: this.$have('PERMISSION_CREATE_EDUCATION_LEVELS') ? {
                            label: this.$addLabel('education_level'),
                            class: 'btn btn-primary'
                        } : {}
                    },
                    {
                        name: this.$t('educational_institution'),
                        title: this.$t('educational_institution'),
                        component: "app-educational-institutions",
                        permission: this.$have('PERMISSION_VIEW_EDUCATIONAL_INSTITUTIONS'),
                        headerButton: this.$have('PERMISSION_CREATE_EDUCATIONAL_INSTITUTIONS') ? {
                            label: this.$addLabel('educational_institution'),
                            class: 'btn btn-primary'
                        } : {}
                    },
                    {
                        name: this.$t('industry_area'),
                        title: this.$t('industry_area'),
                        component: "app-industry-areas",
                        permission: this.$have('PERMISSION_VIEW_INDUSTRY_AREAS'),
                        headerButton: this.$have('PERMISSION_CREATE_INDUSTRY_AREAS') ? {
                            label: this.$addLabel('industry_area'),
                            class: 'btn btn-primary'
                        } : {}
                    },
                    {
                        name: this.$t('course_category'),
                        title: this.$t('course_category'),
                        component: "app-course-categories",
                        permission: this.$have('PERMISSION_VIEW_COURSE_CATEGORIES'),
                        headerButton: this.$have('PERMISSION_CREATE_COURSE_CATEGORIES') ? {
                            label: this.$addLabel('course_category'),
                            class: 'btn btn-primary'
                        } : {}
                    },
                    {
                        name: this.$t('course_material_category'),
                        title: this.$t('course_material_category'),
                        component: "app-course-material-categories",
                        permission: this.$have('PERMISSION_VIEW_COURSE_MATERIAL_CATEGORIES'),
                        headerButton: this.$have('PERMISSION_CREATE_COURSE_MATERIAL_CATEGORIES') ? {
                            label: this.$addLabel('course_material_category'),
                            class: 'btn btn-primary'
                        } : {}
                    },
                    {
                        name: this.$t('license'),
                        title: this.$t('license'),
                        component: "app-licenses",
                        permission: this.$have('PERMISSION_VIEW_LICENSES'),
                        headerButton: this.$have('PERMISSION_CREATE_LICENSES') ? {
                            label: this.$addLabel('license'),
                            class: 'btn btn-primary'
                        } : {}
                    },
                    {
                        name: this.$t('relationship'),
                        title: this.$t('relationship'),
                        component: "app-relationships",
                        permission: this.$have('PERMISSION_VIEW_RELATIONSHIPS'),
                        headerButton: this.$have('PERMISSION_CREATE_RELATIONSHIPS') ? {
                            label: this.$addLabel('relationship'),
                            class: 'btn btn-primary'
                        } : {}
                    },
                    {
                        name: this.$t('religion'),
                        title: this.$t('religion'),
                        component: "app-religions",
                        permission: this.$have('PERMISSION_VIEW_RELIGIONS'),
                        headerButton: this.$have('PERMISSION_CREATE_RELIGIONS') ? {
                            label: this.$addLabel('religion'),
                            class: 'btn btn-primary'
                        } : {}
                    },
                    {
                        name: this.$t('ethnicity'),
                        title: this.$t('ethnicity'),
                        component: "app-ethnicities",
                        permission: this.$have('PERMISSION_VIEW_ETHNICITIES'),
                        headerButton: this.$have('PERMISSION_CREATE_ETHNICITIES') ? {
                            label: this.$addLabel('ethnicity'),
                            class: 'btn btn-primary'
                        } : {}
                    },
                    {
                        name: this.$t('bank'),
                        title: this.$t('bank'),
                        component: "app-banks",
                        permission: this.$have('PERMISSION_VIEW_BANKS'),
                        headerButton: this.$have('PERMISSION_CREATE_BANKS') ? {
                            label: this.$addLabel('bank'),
                            class: 'btn btn-primary'
                        } : {}
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

import {EDUCATIONAL_INSTITUTIONS} from '../../../Config/ApiUrl'

export default {
    data() {
        return {
            options: {
                name: this.$t('name'),
                url: EDUCATIONAL_INSTITUTIONS,
                showHeader: true,
                tableShadow:false,
                tablePaddingClass:'pt-primary',
                columns: [
                    {
                        title: this.$t('name'),
                        type: 'text',
                        key: 'name',
                        isVisible: true,
                    },
                    {
                        title: this.$t('address'),
                        type: 'text',
                        key: 'address',
                        isVisible: true,
                    },
                ],
                filters: [
                    {
                        title: this.$t('created'),
                        type: "range-picker",
                        key: "date",
                        option: ["today", "thisMonth", "last7Days", "thisYear"]
                    },
                ],
                paginationType: "pagination",
                responsive: true,
                rowLimit: 10,
                showAction: (this.$have('PERMISSION_UPDATE_EDUCATIONAL_INSTITUTION') || this.$have('PERMISSION_DELETE_EDUCATIONAL_INSTITUTION')),
                orderBy: 'desc',
                actionType: "default",
                actions: [
                    {
                        title: this.$t('edit'),
                        icon: 'edit',
                        type: 'modal',
                        component: 'app-educational-institution-modal',
                        modalId: 'educational-institution-modal',
                        url: EDUCATIONAL_INSTITUTIONS,
                        name: 'edit',
                        modifier: () => this.$have('PERMISSION_UPDATE_EDUCATIONAL_INSTITUTION')
                    },
                    {
                        title: this.$t('delete'),
                        name: 'delete',
                        icon: 'trash-2',
                        modalClass: 'warning',
                        url: EDUCATIONAL_INSTITUTIONS,
                        modifier: () => this.$have('PERMISSION_DELETE_EDUCATIONAL_INSTITUTION')
                    },
                ],
            },
            isEducationalInstitutionAddEditModalActive: false,
            isEducationalInstitutionDeleteModalActive: false,
        }
    },

    beforeMount() {
        if (this.$have('PERMISSION_UPDATE_EDUCATIONAL_INSTITUTION') || this.$have('PERMISSION_DELETE_EDUCATIONAL_INSTITUTION')) {
            this.options.columns.push({
                title: this.$t('actions'),
                type: 'action'
            })
        }
    },
}

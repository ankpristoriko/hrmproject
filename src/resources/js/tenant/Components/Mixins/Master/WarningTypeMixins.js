import {WARNING_TYPES} from '../../../Config/ApiUrl'

export default {
    data() {
        return {
            options: {
                name: this.$t('name'),
                url: WARNING_TYPES,
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
                showAction: (this.$have('PERMISSION_UPDATE_WARNING_TYPE') || this.$have('PERMISSION_DELETE_WARNING_TYPE')),
                orderBy: 'desc',
                actionType: "default",
                actions: [
                    {
                        title: this.$t('edit'),
                        icon: 'edit',
                        type: 'modal',
                        component: 'app-warning-type-modal',
                        modalId: 'warning-type-modal',
                        url: WARNING_TYPES,
                        name: 'edit',
                        modifier: () => this.$have('PERMISSION_UPDATE_WARNING_TYPE')
                    },
                    {
                        title: this.$t('delete'),
                        name: 'delete',
                        icon: 'trash-2',
                        modalClass: 'warning',
                        url: WARNING_TYPES,
                        modifier: () => this.$have('PERMISSION_DELETE_WARNING_TYPE')
                    },
                ],
            },
            isWarningTypeAddEditModalActive: false,
            isWarningTypeDeleteModalActive: false,
        }
    },

    beforeMount() {
        if (this.$have('PERMISSION_UPDATE_WARNING_TYPE') || this.$have('PERMISSION_DELETE_WARNING_TYPE')) {
            this.options.columns.push({
                title: this.$t('actions'),
                type: 'action'
            })
        }
    },
}

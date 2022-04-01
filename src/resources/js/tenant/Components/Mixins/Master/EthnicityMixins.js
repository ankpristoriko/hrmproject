import {ETHNICITIES} from '../../../Config/ApiUrl'

export default {
    data() {
        return {
            options: {
                name: this.$t('name'),
                url: ETHNICITIES,
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
                showAction: (this.$have('PERMISSION_UPDATE_ETHNICITY') || this.$have('PERMISSION_DELETE_ETHNICITY')),
                orderBy: 'desc',
                actionType: "default",
                actions: [
                    {
                        title: this.$t('edit'),
                        icon: 'edit',
                        type: 'modal',
                        component: 'app-ethnicity-modal',
                        modalId: 'ethnicity-modal',
                        url: ETHNICITIES,
                        name: 'edit',
                        modifier: () => this.$have('PERMISSION_UPDATE_ETHNICITY')
                    },
                    {
                        title: this.$t('delete'),
                        name: 'delete',
                        icon: 'trash-2',
                        modalClass: 'warning',
                        url: ETHNICITIES,
                        modifier: () => this.$have('PERMISSION_DELETE_ETHNICITY')
                    },
                ],
            },
            isEthnicityAddEditModalActive: false,
            isEthnicityDeleteModalActive: false,
        }
    },

    beforeMount() {
        if (this.$have('PERMISSION_UPDATE_ETHNICITY') || this.$have('PERMISSION_DELETE_ETHNICITY')) {
            this.options.columns.push({
                title: this.$t('actions'),
                type: 'action'
            })
        }
    },
}

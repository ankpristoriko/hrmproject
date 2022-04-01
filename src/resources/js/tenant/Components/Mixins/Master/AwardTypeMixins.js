import {AWARD_TYPES} from '../../../Config/ApiUrl'

export default {
    data() {
        return {
            options: {
                name: this.$t('name'),
                url: AWARD_TYPES,
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
                showAction: (this.$have('PERMISSION_UPDATE_AWARD_TYPE') || this.$have('PERMISSION_DELETE_AWARD_TYPE')),
                orderBy: 'desc',
                actionType: "default",
                actions: [
                    {
                        title: this.$t('edit'),
                        icon: 'edit',
                        type: 'modal',
                        component: 'app-award-type-modal',
                        modalId: 'award-type-modal',
                        url: AWARD_TYPES,
                        name: 'edit',
                        modifier: () => this.$have('PERMISSION_UPDATE_AWARD_TYPE')
                    },
                    {
                        title: this.$t('delete'),
                        name: 'delete',
                        icon: 'trash-2',
                        modalClass: 'warning',
                        url: AWARD_TYPES,
                        modifier: () => this.$have('PERMISSION_DELETE_AWARD_TYPE')
                    },
                ],
            },
            isAwardTypeAddEditModalActive: false,
            isAwardTypeDeleteModalActive: false,
        }
    },

    beforeMount() {
        if (this.$have('PERMISSION_UPDATE_AWARD_TYPE') || this.$have('PERMISSION_DELETE_AWARD_TYPE')) {
            this.options.columns.push({
                title: this.$t('actions'),
                type: 'action'
            })
        }
    },
}
